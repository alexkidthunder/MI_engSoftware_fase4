<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Monolog\Handler\SendGridHandler;
use PhpParser\Node\Stmt\Return_;

class HomeController extends Controller
{
    public function index(){
        session_start();
        if((isset($_SESSION['administrador']) == false) AND (isset($_SESSION['enfermeiroChefe']) == false) 
        AND (isset($_SESSION['enfermeiro']) == false) AND (isset($_SESSION['estagiario']) == false)){
            return view('login');
        }else{
            return redirect()->back();
        }
    }

    public function login(Request $request){
        include("db.php");
        $request -> validate([
            'cpf' => 'required',
            'senha' => 'required'
        ]);
        $result = mysqli_query($connect,"SELECT CPF FROM usuarios WHERE CPF = '$request->cpf' AND Senha = '$request->senha'"); /*Verificando se cpf e senha estão cadastrados no banco de dados*/ 
        $row = mysqli_num_rows($result); /*resultado da verificalçao*/
        /*While percorrendo vetor gerado pela query */
        $sql = "SELECT * FROM usuarios where CPF = '$request->cpf'";
        $query = mysqli_query($connect,$sql);
        while($sql = mysqli_fetch_array($query)){
            $atribuicao = $sql["Atribuicao"];
        }
        if($row == 1){ // verifica se o usuario existe no sistema. $row = 1 significa que sim
            session_start();
            /*Sequência de condicionais que verifica o cargo para reirecionar para o menu correto */
            if($atribuicao == "Administrador"){
                $_SESSION['administrador'] = $request->cpf; // inicia uma sessão de nome usuario com o cpf recuperado
                if($request->senha == 12345){
                    return redirect('/primeiroAcesso')->with('cpf', $request->cpf);
                }
                header("Location: /menuAdm");
                exit();
            }else if($atribuicao == "Enfermeiro Chefe"){
                $_SESSION['enfermeiroChefe'] = $request->cpf; // inicia uma sessão de nome usuario com o cpf recuperado
                if($request->senha == 12345){
                    return redirect('/primeiroAcesso')->with('cpf', $request->cpf);
                }
                header("Location: /menu");
                exit();
            }else if($atribuicao == "Enfermeiro"){
                $_SESSION['enfermeiro'] = $request->cpf; // inicia uma sessão de nome usuario com o cpf recuperado
                if($request->senha == 12345){
                    return redirect('/primeiroAcesso')->with('cpf', $request->cpf);
                }
                header("Location: /menu");
                exit();
            }else if($atribuicao == "Estagiario"){
                $_SESSION['estagiario'] = $request->cpf; // inicia uma sessão de nome usuario com o cpf recuperado
                if($request->senha == 12345){
                    return redirect('/primeiroAcesso')->with('cpf', $request->cpf);
                }
                header("Location: /menu");
                exit();
            }else{
                return redirect() -> back() ->with('msg-error','Funcionario sem cargo, algo esta errado!!!');
            }
        }else{ // caso em que o $row = 0
            return redirect() -> back() ->with('msg-error','Acesso negado para essas credenciais');
        }

    }

    public function menu(){
        VerificaLoginController::verificarLogin();
        return view('/menu');
    }

    public function logout(){
        session_start();
        session_destroy();
        header("Location: /");
        exit();
    }
    
     
    public function acessarPrimeiroAcesso(){
        return view('primeiroAcesso');
    }

    public function primeiroAcesso(Request $request){
        include('conexao.php');
        $cpf = $request->cpf; 
        $senhaDefinida = $request->senha;
        $senhaConfirmacao = $request->confirmacao;

        //se a nova senha desejada for igual a de confimação
        if ($senhaConfirmacao == $senhaDefinida){
            //$senhaCript = Hash::make($senhaConfimacao);         //cria um hash a partir da nova senha 
            dd($cpf);    
            //se existe o cpf no banco de dados
            $update = "UPDATE usuarios SET Senha = $senhaConfirmacao WHERE CPF = '$cpf' ";     //atualiza no banco de dados
            mysqli_query($conn,$update);

            return redirect()->route('index')->with('msg-sucess','Senha cadastrada com sucesso!!');
        //se a nova senha desejada for diferente da confirmada
        }else{
            return redirect()->route('acessarPrimeiroAcesso')->with('cpf',$cpf,'msg-error','A senha de confirmação está diferente da nova senha!!',);
       }
    }

    /*public function menu(){
        return view('admin.menu');
    }*/

    public function editPerfil(Request $request){
        VerificaLoginController::verificarLogin();
        include("db.php");
        $usuario = [];
        $cpf = '';
        if(isset($_SESSION['enfermeiroChefe'])){
            $cpf = $_SESSION['enfermeiroChefe'];
            $sql = "SELECT * FROM enfermeiros_chefes where CPF = '$cpf'";
            $query = mysqli_query($connect,$sql);
            while($sql = mysqli_fetch_array($query)){
                $usuario['coren'] = $sql['COREN'];
            }
        }else if(isset($_SESSION['enfermeiro'])){
            $cpf = $_SESSION['enfermeiro'];
            $sql = "SELECT * FROM enfermeiros where CPF = '$cpf'";
            $query = mysqli_query($connect,$sql);
            while($sql = mysqli_fetch_array($query)){
                $usuario['coren'] = $sql['COREN'];
            }
        }else if(isset($_SESSION['estagiario'])){
            $cpf = $_SESSION['estagiario'];
        }else if(isset($_SESSION['administrador'])){
            $cpf = $_SESSION['administrador'];
        }
        $sql = "SELECT * FROM usuarios where CPF = '$cpf'";
        $query = mysqli_query($connect,$sql);
        while($sql = mysqli_fetch_array($query)){
            $usuario['nome'] = $sql['Nome'];
            $usuario['nascimento'] = $sql['Data_Nasc'];
            $usuario['sexo'] = $sql['Sexo'];
            $usuario['email'] = $sql['Email'];
        }
        return view('editarPerfil', ['usuario' => $usuario]);
    }
    

    public function listaPacientes(Request $request){
        VerificaLoginController::verificarLogin();
        // Qual a permissão pra isso? 
        include("db.php");
        $i= 0;
        $p = [];
        if($request->novaAtribuicao == "internado") {
            $sql = "SELECT * FROM pacientes WHERE Estado = 'internado'";
            $query = mysqli_query($connect,$sql);
            while($sql = mysqli_fetch_array($query)){
                $p[$i] = $sql['Nome_Paciente'];
                $p[$i+1] = $sql['CPF'];
                $i = $i+2;
            }
            return view('listaPacientes',['p'=>$p]);
        }else if($request->novaAtribuicao == "alta") {
            $sql = "SELECT * FROM pacientes WHERE Estado = 'alta'";
            $query = mysqli_query($connect,$sql);
            while($sql = mysqli_fetch_array($query)){
                $p[$i] = $sql['Nome_Paciente'];
                $p[$i+1] = $sql['CPF'];
                $i = $i+2;
            }
            return view('listaPacientes',['p'=>$p]);
        }else if($request->novaAtribuicao == "obito") {
            $sql = "SELECT * FROM pacientes WHERE Estado = 'obito'";
            $query = mysqli_query($connect,$sql);
            while($sql = mysqli_fetch_array($query)){
                $p[$i] = $sql['Nome_Paciente'];
                $p[$i+1] = $sql['CPF'];
                $i = $i+2;
            }
            return view('listaPacientes',['p'=>$p]);
        }else{
            return view('listaPacientes');
        }
    }

    public function agendamentosRealizados(){
        VerificaLoginController::verificarLogin();
        $resultado = VerificaLoginController::verificaPermissao(22);
        include("db.php");
        $infos = [];
        $i = 0;
        if($resultado == "1"){
            if(isset($_SESSION['enfermeiro'])){
                $cpf = $_SESSION['enfermeiro'];
                $sql = "SELECT * FROM agendamentos WHERE CPF_usuario = '$cpf'";
                $query = mysqli_query($connect,$sql);
                while($sql = mysqli_fetch_array($query)){
                    if($sql['Realizado'] == 1){
                        $medicamento = $sql['Cod_medicamento'];
                        $prontuario = $sql['ID_prontuario'];
                        $infos['hora'.$i] = $sql['Hora_Agend'];
                        $infos['data'.$i] = $sql['Data_Agend'];
                        $infos['posologia'.$i] = $sql['Posologia'];
                        $sql1 = "SELECT * FROM medicamentos WHERE Codigo = '$medicamento'";
                        $query1 = mysqli_query($connect,$sql1);
                        while($sql1 = mysqli_fetch_array($query1)){
                            $infos['medicamento'.$i] = $sql1['Nome_Medicam'];
                        }
                        $sql2 = "SELECT * FROM prontuarios WHERE ID = '$prontuario'";
                        $query2 = mysqli_query($connect,$sql2);
                        while($sql2 = mysqli_fetch_array($query2)){
                            $identificaP = $sql2['Cpfpaciente'];
                            $infos['leito'.$i] = $sql2['Id_leito'];
                        }
                        $sql3 = "SELECT * FROM pacientes WHERE CPF = '$identificaP'";
                        $query3 = mysqli_query($connect,$sql3);
                        while($sql3 = mysqli_fetch_array($query3)){
                            $infos['paciente'.$i] = $sql3['Nome_Paciente'];
                        }

                        $i++;
                    }
                }
            }else if(isset($_SESSION['estagiario'])){
                $cpf = $_SESSION['estagiario'];
                $sql = "SELECT * FROM agendamentos WHERE CPF_usuario = '$cpf'";
                $query = mysqli_query($connect,$sql);
                while($sql = mysqli_fetch_array($query)){
                    if($sql['Realizado'] == 1){
                        $medicamento = $sql['Cod_medicamento'];
                        $prontuario = $sql['ID_prontuario'];
                        $infos['hora'.$i] = $sql['Hora_Agend'];
                        $infos['data'.$i] = $sql['Data_Agend'];
                        $infos['posologia'.$i] = $sql['Posologia'];
                        $sql1 = "SELECT * FROM medicamentos WHERE Codigo = '$medicamento'";
                        $query1 = mysqli_query($connect,$sql1);
                        while($sql1 = mysqli_fetch_array($query1)){
                            $infos['medicamento'.$i] = $sql1['Nome_Medicam'];
                        }
                        $sql2 = "SELECT * FROM prontuarios WHERE ID = '$prontuario'";
                        $query2 = mysqli_query($connect,$sql2);
                        while($sql2 = mysqli_fetch_array($query2)){
                            $identificaP = $sql2['Cpfpaciente'];
                            $infos['leito'.$i] = $sql2['Id_leito'];
                        }
                        $sql3 = "SELECT * FROM pacientes WHERE CPF = '$identificaP'";
                        $query3 = mysqli_query($connect,$sql3);
                        while($sql3 = mysqli_fetch_array($query3)){
                            $infos['paciente'.$i] = $sql3['Nome_Paciente'];
                        }

                        $i++;
                    }
                }
            }
            return view('agendamentosRealizados',['infos' => $infos]);
        }else{
            return redirect()->back()->with('msg-error','Você não tem acesso a essa pagina!!!');
        }
    }

    public function meusAgendamentos(){
        VerificaLoginController::verificarLogin();
        $resultado = VerificaLoginController::verificaPermissao(23);
        include("db.php");
        $infos = [];
        $i = 0;
        if($resultado == "1"){
            if(isset($_SESSION['enfermeiro'])){
                $cpf = $_SESSION['enfermeiro'];
                $sql = "SELECT * FROM agendamentos WHERE CPF_usuario = '$cpf'";
                $query = mysqli_query($connect,$sql);
                while($sql = mysqli_fetch_array($query)){
                    $medicamento = $sql['Cod_medicamento'];
                    $prontuario = $sql['ID_prontuario'];
                    $infos['hora'.$i] = $sql['Hora_Agend'];
                    $infos['data'.$i] = $sql['Data_Agend'];
                    $infos['posologia'.$i] = $sql['Posologia'];
                    $sql1 = "SELECT * FROM medicamentos WHERE Codigo = '$medicamento'";
                    $query1 = mysqli_query($connect,$sql1);
                    while($sql1 = mysqli_fetch_array($query1)){
                        $infos['medicamento'.$i] = $sql1['Nome_Medicam'];
                    }
                    $sql2 = "SELECT * FROM prontuarios WHERE ID = '$prontuario'";
                    $query2 = mysqli_query($connect,$sql2);
                    while($sql2 = mysqli_fetch_array($query2)){
                        $identificaP = $sql2['Cpfpaciente'];
                        $infos['leito'.$i] = $sql2['Id_leito'];
                    }
                    $sql3 = "SELECT * FROM pacientes WHERE CPF = '$identificaP'";
                    $query3 = mysqli_query($connect,$sql3);
                    while($sql3 = mysqli_fetch_array($query3)){
                        $infos['paciente'.$i] = $sql3['Nome_Paciente'];
                    }

                    $i++;
                }
            }else if(isset($_SESSION['estagiario'])){
                $cpf = $_SESSION['estagiario'];
                $sql = "SELECT * FROM agendamentos WHERE CPF_usuario = '$cpf'";
                $query = mysqli_query($connect,$sql);
                while($sql = mysqli_fetch_array($query)){
                    $medicamento = $sql['Cod_medicamento'];
                    $prontuario = $sql['ID_prontuario'];
                    $infos['hora'.$i] = $sql['Hora_Agend'];
                    $infos['data'.$i] = $sql['Data_Agend'];
                    $infos['posologia'.$i] = $sql['Posologia'];
                    $sql1 = "SELECT * FROM medicamentos WHERE Codigo = '$medicamento'";
                    $query1 = mysqli_query($connect,$sql1);
                    while($sql1 = mysqli_fetch_array($query1)){
                        $infos['medicamento'.$i] = $sql1['Nome_Medicam'];
                    }
                    $sql2 = "SELECT * FROM prontuarios WHERE ID = '$prontuario'";
                    $query2 = mysqli_query($connect,$sql2);
                    while($sql2 = mysqli_fetch_array($query2)){
                        $identificaP = $sql2['Cpfpaciente'];
                        $infos['leito'.$i] = $sql2['Id_leito'];
                    }
                    $sql3 = "SELECT * FROM pacientes WHERE CPF = '$identificaP'";
                    $query3 = mysqli_query($connect,$sql3);
                    while($sql3 = mysqli_fetch_array($query3)){
                        $infos['paciente'.$i] = $sql3['Nome_Paciente'];
                    }

                    $i++;
                }
            }
            HomeController::autoCadastroAgendamento($prontuario);

            return view('meusAgendamentos',['infos' => $infos]);
        }else{
            return redirect()->back()->with('msg-error','Você não tem acesso a essa pagina!!!');
        }
    }
        
    
    public function agendamentos(Request $request){
        VerificaLoginController::verificarLogin();
        include("db.php");
        $i = 0;
        $infos = [];
        $sql = "SELECT * FROM agendamentos";
        $query = mysqli_query($connect,$sql);
        while($sql = mysqli_fetch_array($query)){
            if($sql['CPF_usuario'] == null){
                $medicamento = $sql['Cod_medicamento'];
                $prontuario = $sql['ID_prontuario'];
                $infos['hora'.$i] = $sql['Hora_Agend'];
                $infos['data'.$i] = $sql['Data_Agend'];
                $infos['posologia'.$i] = $sql['Posologia'];
                $sql1 = "SELECT * FROM medicamentos WHERE Codigo = '$medicamento'";
                $query1 = mysqli_query($connect,$sql1);
                while($sql1 = mysqli_fetch_array($query1)){
                    $infos['medicamento'.$i] = $sql1['Nome_Medicam'];
                }
                $sql2 = "SELECT * FROM prontuarios WHERE ID = '$prontuario'";
                $query2 = mysqli_query($connect,$sql2);
                while($sql2 = mysqli_fetch_array($query2)){
                    $identificaP = $sql2['Cpfpaciente'];
                    $infos['leito'.$i] = $sql2['Id_leito'];
                }
                $sql3 = "SELECT * FROM pacientes WHERE CPF = '$identificaP'";
                $query3 = mysqli_query($connect,$sql3);
                while($sql3 = mysqli_fetch_array($query3)){
                    $infos['paciente'.$i] = $sql3['Nome_Paciente'];
                }
                $i++;
            }
        }
        return view('agendamentos',['infos' => $infos]);
    }

    public static function autoCadastroAgendamento($codigo){
        session_start();
        include("db.php");
        if(isset($_SESSION['enfermeiro'])){
            $cpf = $_SESSION['enfermeiro'];
            $update = "UPDATE agendamentos SET CPF_usuario = '$cpf' WHERE Codigo = '$codigo'";
            mysqli_query($connect,$update);
            $sql = "SELECT * FROM usuarios where CPF = '$cpf'";
            $query = mysqli_query($connect,$sql);
            while($sql = mysqli_fetch_array($query)){
                $user = $sql["CPF"];
            }
            return $user;
        }else if(isset($_SESSION['estagiario'])){
            $cpf = $_SESSION['estagiario'];
            $update = "UPDATE agendamentos SET CPF_usuario = '$cpf' WHERE Codigo = '$codigo'";
            mysqli_query($connect,$update);
            $sql = "SELECT * FROM usuarios where CPF = '$cpf'";
            $query = mysqli_query($connect,$sql);
            while($sql = mysqli_fetch_array($query)){
                $user = $sql["CPF"];
            }
            return $user;
        }else{
            return null;
        }
    }

    public function cadastroAgendamentos(){
        VerificaLoginController::verificarLogin();
        $resultado = VerificaLoginController::verificaPermissao(12);
        if($resultado == "1"){
            return view('cadastroAgendamentos');
        }else{
            return redirect()->back()->with('msg-error','Você não tem acesso a essa pagina!!!');
        } 
    }

    public function cadastroProntuario(){
        VerificaLoginController::verificarLogin();


        
        return view('cadastroProntuario');
    }

    public function cadastroPaciente(){
        VerificaLoginController::verificarLogin();
        $resultado = VerificaLoginController::verificaPermissao(23);
        if($resultado == "1"){
            return view('cadastroPaciente');
        }else{
            return redirect()->back()->with('msg-error','Você não tem acesso a essa pagina!!!');
        }

    }

    public function esqueciSenha(){
        return view('esqueciSenha');
    }
    
    public function listaMedicamento(){
        VerificaLoginController::verificarLogin();
        include("db.php");
        $resultado = VerificaLoginController::verificaPermissao(21);
        if($resultado == "1"){
            $i = 0;
            $m = [];
            $sql = "SELECT * FROM medicamentos";
            $query = mysqli_query($connect,$sql);
            while($sql = mysqli_fetch_array($query)){
                $m[$i] = $sql['Nome_Medicam'];
                $m[$i+1] = $sql['Data_Validade'];
                $m[$i+2] = $sql['Quantidade'];
                $m[$i+3] = $sql['Fabricante'];
                $i = $i+4;
            }
            return view('listaMedicamento',['m' => $m]);
        }else{
            return redirect()->back()->with('msg-error','Você não tem acesso a essa pagina!!!');
        }
    }

    public function historicoProntuario(){
        VerificaLoginController::verificarLogin();
        return view('historicoProntuario');
    }

    public function salvarPaciente(Request $request){
        session_start();
        include('conexao.php');

        //buscar paciente
        $existePac = mysqli_query($conn,"SELECT COUNT(*) FROM pacientes WHERE CPF = '$request->fcpf'");

        //se não existir o paciente
        if(mysqli_fetch_assoc($existePac)['COUNT(*)'] == 0){

            //cria paciente e adiciona
            $novoPac = "INSERT INTO pacientes (Nome_Paciente, Sexo, Data_Nasc, CPF, Tipo_Sang) values
            ('$request->fnome', '$request->fsexo', '$request->fnascimento', '$request->fcpf', '$request->fsanguineo')";
            mysqli_query($conn,$novoPac);
            
            return redirect()->route('cadastroPaciente')->with('success', "Paciente cadastrado com sucesso!");
        }else{
            //se existir o paciente cadastrado
            return redirect()->route('cadastroPaciente')->with('error', "Paciente já existente no banco de dados!!");
        } 
    }

    public function prontuario(){
        VerificaLoginController::verificarLogin();
        $resultado = VerificaLoginController::verificaPermissao(18);
        if($resultado == "1"){
            return view('prontuario');
        }else{
            return redirect()->back()->with('msg-error','Você não tem acesso a essa pagina!!!');
        }
    }
}
