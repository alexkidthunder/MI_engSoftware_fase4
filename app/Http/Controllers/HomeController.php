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
        }elseif(isset($_SESSION['administrador'])){
            header("Location: /menuAdm");
            exit();
        }else{
            header("Location: /menu");
            exit();
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
            $ativo = $sql['Ativo'];
        }
        if($row == 1){ // verifica se o usuario existe no sistema. $row = 1 significa que sim
            session_start();
            if($ativo == 1){
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

            }else{
                return redirect() -> back() ->with('msg-error','Conta do funcionario encontrasse desativada');
            }
        }else{ // caso em que o $row = 0
            return redirect() -> back() ->with('msg-error','Acesso negado para essas credenciais');
        }

    }

    public function menu(){
        VerificaLoginController::verificarLogin();
        if(isset($_SESSION['enfermeiro']) or isset($_SESSION['enfermeiroChefe']) or isset($_SESSION['estagiario'])){
            return view('/menu');
        }
        else{
            return redirect()->back();
        }
    }

    public function logout(){
        session_start();
        session_destroy();

        //log
        $ip = $_SERVER["REMOTE_ADDR"];
        $acao = "Logout no sistema";           
        AdminController::salvarLog($acao, $ip);

        header("Location: /");
        exit();
    }
    
     
    public function acessarPrimeiroAcesso(){
        return view('primeiroAcesso');
    }

    public function primeiroAcesso(Request $request){
        include('db.php');

        $cpf = $request->cpf; 
        $senhaDefinida = $request->senha;
        $senhaConfirmacao = $request->confirmacao;

        //se a nova senha desejada for igual a de confimação
        if ($senhaConfirmacao == $senhaDefinida){
            //$senhaCript = Hash::make($senhaConfimacao);         //cria um hash a partir da nova senha 
           // dd($cpf);    

            //atualiza senha no banco de dados
            $update = "UPDATE usuarios SET Senha = '$senhaConfirmacao' WHERE CPF = '$cpf'";
            mysqli_query($connect,$update);
            
            //log
            $ip = $_SERVER["REMOTE_ADDR"];
            $acao = "Novo usuário cadastrou senha";           
            AdminController::salvarLog($acao, $ip);


            //Verificando se cpf está cadastrados no banco de dados
            $result = mysqli_query($connect,"SELECT CPF FROM usuarios WHERE CPF = '$request->cpf'"); 
            $row = mysqli_num_rows($result); 
            
            //resultado da verificação
            $existeUsuario = "SELECT * FROM usuarios where CPF = '$request->cpf'";
            $buscar = mysqli_query($connect,$existeUsuario);
            while($sql = mysqli_fetch_array($buscar)){
                $atribuicao = $sql["Atribuicao"];
            }

            //verifica se o usuario existe no sistema. $row = 1 significa que sim
            if($row == 1){ 
                session_start();
                                            //Sequência de condicionais que verifica o cargo para reirecionar para o menu correto 
                if($atribuicao == "Administrador"){
                    $_SESSION['administrador'] = $request->cpf; // inicia uma sessão de nome usuario com o cpf recuperado
                    
                    //log
                    $ip = $_SERVER["REMOTE_ADDR"];
                    $acao = "Administrador logou no sistema";           
                    AdminController::salvarLog($acao, $ip);
                    
                    header("Location: /menuAdm");
                    exit();
                }else if($atribuicao == "Enfermeiro Chefe"){
                    $_SESSION['enfermeiroChefe'] = $request->cpf; 

                    //log
                    $ip = $_SERVER["REMOTE_ADDR"];
                    $acao = "Enfermeiro chefe logou no sistema";           
                    AdminController::salvarLog($acao, $ip);

                    header("Location: /menu");
                    exit();
                }else if($atribuicao == "Enfermeiro"){
                    $_SESSION['enfermeiro'] = $request->cpf; 

                    //log
                    $ip = $_SERVER["REMOTE_ADDR"];
                    $acao = "Enfermeiro logou no sistema";           
                    AdminController::salvarLog($acao, $ip);

                    header("Location: /menu");
                    exit();
                }else if($atribuicao == "Estagiario"){
                    $_SESSION['estagiario'] = $request->cpf; 

                    //log
                    $ip = $_SERVER["REMOTE_ADDR"];
                    $acao = "Estagiário logou no sistema";           
                    AdminController::salvarLog($acao, $ip);

                    header("Location: /menu");
                    exit();
                }              
            } 
          
        //se a nova senha desejada for diferente da confirmada
        }else{
            return redirect('/primeiroAcesso')->with('cpf', $request->cpf);
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

        //log
        $ip = $_SERVER["REMOTE_ADDR"];
        $acao = "Usuário editou perfil";           
        AdminController::salvarLog($acao, $ip);


        return view('editarPerfil', ['usuario' => $usuario]);
    }
    
    public function alterarSenhaPerfil(Request $request){
        session_start();
        include("db.php");
        if(isset($_SESSION['administrador'])){
            $cpf = $_SESSION['administrador'];
            $sql = "SELECT * FROM usuarios where CPF = '$cpf'";
            $query = mysqli_query($connect,$sql);
            while($sql = mysqli_fetch_array($query)){
                $usuario['senha'] = $sql['Senha'];
            }
            if(($request->senhaAtual == $usuario['senha']) and ($request->senha == $request->confirmacao)){
                $updateSenha = "UPDATE usuarios SET Senha = '$request->senha' WHERE CPF = '$cpf'";
                mysqli_query($connect,$updateSenha);

            }
        }else if(isset($_SESSION['enfermeiroChefe'])){
            $cpf = $_SESSION['enfermeiroChefe'];
            $sql = "SELECT * FROM usuarios where CPF = '$cpf'";
            $query = mysqli_query($connect,$sql);
            while($sql = mysqli_fetch_array($query)){
                $usuario['senha'] = $sql['Senha'];
            }
            if(($request->senhaAtual == $usuario['senha']) and ($request->senha == $request->confirmacao)){
                $updateSenha = "UPDATE usuarios SET Senha = '$request->senha' WHERE CPF = '$cpf'";
                mysqli_query($connect,$updateSenha);
            }
        }else if(isset($_SESSION['enfermeiro'])){
            $cpf = $_SESSION['enfermeiro'];
            $sql = "SELECT * FROM usuarios where CPF = '$cpf'";
            $query = mysqli_query($connect,$sql);
            while($sql = mysqli_fetch_array($query)){
                $usuario['senha'] = $sql['Senha'];
            }
            if(($request->senhaAtual == $usuario['senha']) and ($request->senha == $request->confirmacao)){
                $updateSenha = "UPDATE usuarios SET Senha = '$request->senha' WHERE CPF = '$cpf'";
                mysqli_query($connect,$updateSenha);
            }
        }else{
            $cpf = $_SESSION['estagiario'];
            $sql = "SELECT * FROM usuarios where CPF = '$cpf'";
            $query = mysqli_query($connect,$sql);
            while($sql = mysqli_fetch_array($query)){
                $usuario['senha'] = $sql['Senha'];
            }
            if(($request->senhaAtual == $usuario['senha']) and ($request->senha == $request->confirmacao)){
                $updateSenha = "UPDATE usuarios SET Senha = '$request->senha' WHERE CPF = '$cpf'";
                mysqli_query($connect,$updateSenha);
            }
        }

        //log
        $ip = $_SERVER["REMOTE_ADDR"];
        $acao = "Usuário alterou senha";           
        AdminController::salvarLog($acao, $ip);

        header('Location: /meuPerfil');
        exit();
    }

    public function alterarDados(Request $request){
        session_start();
        include("db.php");
        $cpf = HomeController::obterCpf();
        $updateNome = "UPDATE usuarios SET Nome = '$request->fnome' WHERE CPF = '$cpf'";
        mysqli_query($connect,$updateNome); 
        $updateEmail = "UPDATE usuarios SET Email = '$request->femail' WHERE CPF = '$cpf'";
        mysqli_query($connect,$updateEmail);

        return redirect()->back();

    }

    public function listaPacientes(Request $request){
        VerificaLoginController::verificarLogin();
        // Qual a permissão pra isso? 
        include("db.php");
        $i= 0;
        $p = [];
        $identicador = [];
        $perm = VerificaLoginController::verificaPermissao(18);
        if($perm == "1"){
            if($request->novaAtribuicao == "internado") {
                $sql = "SELECT * FROM pacientes WHERE Estado = 'internado'";
                $query = mysqli_query($connect,$sql);
                while($sql = mysqli_fetch_array($query)){
                    $p[$i] = $sql['Nome_Paciente'];
                    $identicador[$i] = $sql['CPF'];
                    $cpf = $sql['CPF'];
                    $sql1 = "SELECT * FROM prontuarios WHERE Cpfpaciente = '$cpf'";
                    $query1 = mysqli_query($connect,$sql1);
                    while($sql1 = mysqli_fetch_array($query1)){
                        if($sql1['aberto'] == 1){
                            $p['id'.$i] = $sql1['ID'];
                        }
                    }
                    $i = $i+1;
                }
                return view('listaPacientes',['p'=>$p,'identicador'=>$identicador]);
            }else if($request->novaAtribuicao == "alta") {
                $sql = "SELECT * FROM pacientes WHERE Estado = 'alta'";
                $query = mysqli_query($connect,$sql);
                while($sql = mysqli_fetch_array($query)){
                    $p[$i] = $sql['Nome_Paciente'];
                    $identicador[$i] = $sql['CPF'];
                    $cpf = $sql['CPF'];
                    $sql1 = "SELECT * FROM prontuarios WHERE Cpfpaciente = '$cpf'";
                    $query1 = mysqli_query($connect,$sql1);
                    while($sql1 = mysqli_fetch_array($query1)){
                        if($sql1['aberto'] == 0){
                            $p['id'.$i] = $sql1['ID'];
                        }
                    }
                    $i = $i+1;
                }
                return view('listaPacientes',['p'=>$p,'identicador'=>$identicador]);
            }else if($request->novaAtribuicao == "obito") {
                $sql = "SELECT * FROM pacientes WHERE Estado = 'obito'";
                $query = mysqli_query($connect,$sql);
                while($sql = mysqli_fetch_array($query)){
                    $p[$i] = $sql['Nome_Paciente'];
                    $identicador[$i] = $sql['CPF'];
                    $cpf = $sql['CPF'];
                    $sql1 = "SELECT * FROM prontuarios WHERE Cpfpaciente = '$cpf'";
                    $query1 = mysqli_query($connect,$sql1);
                    while($sql1 = mysqli_fetch_array($query1)){
                        if($sql1['aberto'] == 0){
                            $p['id'.$i] = $sql1['ID'];
                        }
                    }
                    $i = $i+1;
                }
                return view('listaPacientes',['p'=>$p,'identicador'=>$identicador]);
            }else{
                return view('listaPacientes');
            }
        }else{
            return redirect()->back();
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
            return view('agendamentosRealizados',['infos' => $infos, 'identificaP'=>$identificaP]);
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
                    if($sql['Realizado'] == 0){
                        $medicamento = $sql['Cod_medicamento'];
                        $prontuario = $sql['ID_prontuario'];
                        $infos['codA'.$i] = $sql['Codigo'];
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
                            $infos['id'.$i] = $sql2['ID'];
                        }
                        $sql3 = "SELECT * FROM pacientes WHERE CPF = '$identificaP'";
                        $query3 = mysqli_query($connect,$sql3);
                        while($sql3 = mysqli_fetch_array($query3)){
                            $infos['paciente'.$i] = $sql3['Nome_Paciente'];
                        }

                        $i++;
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

            return view('meusAgendamentos',['infos' => $infos, 'identificaP'=>$identificaP]);
        }else{
            return redirect()->back()->with('msg-error','Você não tem acesso a essa pagina!!!');
        }
    }

    public function finalizarMeusAgendamentos(Request $request){
        include("db.php");
        session_start();
        $sql = "UPDATE agendamentos SET Realizado = '1' WHERE Codigo = '$request->idA'";
        mysqli_query($connect,$sql);
        return redirect()->back();
    }
        
    
    public function agendamentos(Request $request){
        VerificaLoginController::verificarLogin();
        include("db.php");
        $identificaP = null;
        $perm = VerificaLoginController::verificaPermissao(18);
        if($perm == "1"){
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
                    $infos['codA'.$i] = $sql['Codigo'];
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
                        $infos['id'.$i] = $sql2['ID'];
                    }
                    $sql3 = "SELECT * FROM pacientes WHERE CPF = '$identificaP'";
                    $query3 = mysqli_query($connect,$sql3);
                    while($sql3 = mysqli_fetch_array($query3)){
                        $infos['paciente'.$i] = $sql3['Nome_Paciente'];
                    }
                    $i++;
                }
            }
            return view('agendamentos',['infos' => $infos,'identificaP'=>$identificaP]);
        }else{
            return redirect()->back();
        }
    }

    public function autoCadastroAgendamento(Request $request){
        include("db.php");
        session_start();
        $perm = VerificaLoginController::verificaPermissao(25);
        if($perm == "1"){
            $cpf = HomeController::obterCpf();
            if($cpf!=null){
                $update = "UPDATE agendamentos SET CPF_usuario = '$cpf' WHERE Codigo = '$request->codA'";
                mysqli_query($connect,$update);
                return redirect()->back()->with('msg','Você se adicionou como aplicador do agendamento');
            }
        }else{
            return redirect()->back();
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
        $perm = VerificaLoginController::verificaPermissao(33);
        if($perm == "1"){
            return view('cadastroProntuario');
        }else{
            return redirect()->back();
        }
    }

    public function cadastroPaciente(){
        VerificaLoginController::verificarLogin();
        $resultado = VerificaLoginController::verificaPermissao(17);
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
                $m["nome".$i] = $sql['Nome_Medicam'];
                $m["data".$i] = $sql['Data_Validade'];
                $m["quantidade".$i] = $sql['Quantidade'];
                $m["fabricante".$i] = $sql['Fabricante'];
                $i = $i+1;
            }
            return view('listaMedicamento',['m' => $m]);
        }else{
            return redirect()->back()->with('msg-error','Você não tem acesso a essa pagina!!!');
        }
    }

    public function historicoProntuario(){
        VerificaLoginController::verificarLogin();
        $perm = VerificaLoginController::verificaPermissao(18);
        if($perm == "1"){
            return view('historicoProntuario');
        }else{
            return redirect()->back();
        }
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
            
            $ip = $request->ip();
            $acao = "Cadastrou paciente $request->fnome";           
            AdminController::salvarLog($acao, $ip);

            return redirect()->route('cadastroPaciente')->with('success', "Paciente cadastrado com sucesso!");
        }else{
            //se existir o paciente cadastrado
            return redirect()->route('cadastroPaciente')->with('error', "Paciente já existente no banco de dados!!");
        } 
    }

    public function prontuario(Request $request){
        include("db.php");
        VerificaLoginController::verificarLogin();
        $resultado = VerificaLoginController::verificaPermissao(19);
        $paciente=[];
        $infosA = [];
        $infosM = [];
        $i = 0;
        $j = 0;
        $cpf = $request->cpf;
        if($resultado == "1"){
            /*Inicio dos dados do paciente */
            $sql = "SELECT * FROM pacientes where CPF='$cpf'";
            $query = mysqli_query($connect,$sql);
            while($sql = mysqli_fetch_array($query)){
                $paciente['nome'] = $sql['Nome_Paciente'];
                $paciente['nascimento'] = $sql['Data_Nasc'];
                $paciente['sexo'] = $sql['Sexo'];
                $paciente['sangue'] = $sql['Tipo_Sang'];
                $paciente['estado'] = $sql['Estado'];
                $paciente['cpf'] = $cpf;
            }
            $sql = "SELECT * FROM prontuarios where Cpfpaciente ='$cpf'";
            $query = mysqli_query($connect,$sql);
            while($sql = mysqli_fetch_array($query)){
                    if($sql['ID'] == $request->numero){
                        $paciente['internacao'] = $sql['Data_Internacao'];
                        $paciente['leito'] = $sql['Id_leito'];
                        $paciente['prontuario'] = $sql['ID'];
                    }

            }
            /*fim dos dados do paciente */

            /*inicio dos dados do agendamento */
            if(isset($id)){
                $sql = "SELECT * FROM agendamentos WHERE ID_prontuario = '$id'";
                $query = mysqli_query($connect,$sql);
                while($sql = mysqli_fetch_array($query)){
                    $medicamento = $sql['Cod_medicamento'];
                    if($sql['Realizado'] == 0){
                        $infosA['hora'.$i] = $sql['Hora_Agend'];
                        $infosA['data'.$i] = $sql['Data_Agend'];
                        $infosA['posologia'.$i] = $sql['Posologia'];
                        $sql1 = "SELECT * FROM medicamentos WHERE Codigo = '$medicamento'";
                        $query1 = mysqli_query($connect,$sql1);
                        while($sql1 = mysqli_fetch_array($query1)){
                            $infosA['medicamento'.$i] = $sql1['Nome_Medicam'];
                        }
                        $i++;
                    }else{
                        /*inicio dos dados do medicamento */
                        $sql1 = "SELECT * FROM medicamentos WHERE Codigo = '$medicamento'";
                        $query1 = mysqli_query($connect,$sql1);
                        while($sql1 = mysqli_fetch_array($query1)){
                            $infosM['medicamento'.$j] = $sql1['Nome_Medicam'];
                        }
                        $infosM['hora'.$j] = $sql['Hora_Agend'];
                        $infosM['data'.$j] = $sql['Data_Agend'];
                        $infosM['posologia'.$j] = $sql['Posologia'];
                        $aplicador = $sql["CPF_usuario"];
                        $sql2 = "SELECT * FROM usuarios WHERE CPF = '$aplicador'";
                        $query2 = mysqli_query($connect,$sql2);
                        while($sql2 = mysqli_fetch_array($query2)){
                            $infosM['aplicador'.$j] = $sql2['Nome'];
                        }
                        $j++;
                    }
                }
                /*fim dos dados do agendamento e medicamento */
            }else{
                return redirect()->back()->with('msg-error','Não foi possivel encontrar o prontuario no banco de dados!!!');
            }
            
            return view('prontuario',['paciente' => $paciente, 'infosA' => $infosA, 'infosM' => $infosM]);
        }else{
            return redirect()->back()->with('msg-error','Você não tem acesso a essa pagina!!!');
        }
    }

    public function buscaProntuario(Request $request){
        session_start();
        include("db.php"); // inclusão do banco de dados
        $prontuario = []; // garantia de existência da variavel
        // busca do usuario no banco de dados
        $i = 0;
        $sql = "SELECT * FROM prontuarios where Cpfpaciente = '$request->cpf_user'";
        $query = mysqli_query($connect,$sql);
        while($sql = mysqli_fetch_array($query)){ //percorrendo array de usuarios com determinado cpf
            $sql1 = "SELECT * FROM pacientes where CPF = '$request->cpf_user'";
            $query1 = mysqli_query($connect,$sql1);
            while($sql1 = mysqli_fetch_array($query1)){
                if($sql["aberto"]!= 1){
                    $prontuario["nome".$i] = $sql1["Nome_Paciente"]; 
                    $prontuario["estado".$i] = $sql1["Estado"]; 
                    $prontuario["cpf".$i] = $sql["Cpfpaciente"]; 
                    $prontuario["internacao".$i] = $sql["Data_Internacao"];
                    $prontuario["saida".$i] = $sql["Data_Saida"];  
                    $i++;
                }
            }
        }
        return view('historicoProntuario',['prontuario' => $prontuario]);
    }

    /** Função que busca um paciente para o cadastro de prontuário
     * Também retorna os Leitos disponíveis
     */
    public function buscarPaciente(Request $request)
    {
        session_start();
        include("db.php");
        // ----- BUSCANDO O PACIENTE --- 
        $sql = "SELECT * FROM pacientes WHERE CPF = '$request->cpf_user'";
        $query = mysqli_query($connect, $sql);
        $paciente = mysqli_fetch_array($query);
        
       
        // ----- BUSCANDO OS LEITOS --- 
        $sql = "SELECT * FROM leitos";
        $query = mysqli_query($connect, $sql);
        $i = 0;
        $leitos = null;
        while ($dado = mysqli_fetch_array($query)) {
            if ($dado['Ocupado'] == 0) {
                $leitos[$i] = $dado;
            }

            $i++;
        }
          // ----- FIM BUSCA DOS LEITOS --- 

        if ($paciente == null) {
            return redirect()->back()->with('msg-error', 'Paciente não encontrado');
        } else {

            return view('cadastroProntuario', ['paciente' => $paciente, 'leitos'=>$leitos]);
        }
    }

    public static function estadoPronturio($codigo){
        include("db.php");
        $aberto = null;
        $sql = "SELECT * FROM prontuarios WHERE ID = '$codigo'";
        $query = mysqli_query($connect,$sql);
        while($sql = mysqli_fetch_array($query)){
            $aberto = $sql['aberto'];
        }
        return $aberto;
    }

    public function cadastrarCidProntuario(Request $request){
        session_start();
        include("db.php");
        $perm = VerificaLoginController::verificaPermissao(10);
        if($perm == "1"){
            $cid = null;
            $sql = "SELECT * FROM cid WHERE codCid = '$request->fcid'";
            $query = mysqli_query($connect,$sql);
            while($sql = mysqli_fetch_array($query)){
                $cid = $sql['id'];
            }
            $aberto = HomeController::estadoPronturio($request->prontuario);
            if($cid != null and $aberto == '1'){
                $insert = "INSERT INTO cid_prontuario (id_CID,id_prontuario) VALUES ('$cid','$request->prontuario')";
                mysqli_query($connect,$insert);
                return redirect() -> back() ->with('msg','CID adicionada ao prontuario com sucesso!!!!');
            }else if($aberto == '0' or $aberto == null){
                return redirect() -> back() ->with('msg-error','Não pode mais haver cadastro de cids nesse prontuario pos ele se enconta fechado');
            }else{
                return redirect() -> back() ->with('msg-error','CID digitada não existe na base de dados');
            }
        }else{
            return redirect()->back();
        }
    }

    public static function obterCpf(){
        $cpf = null;
        if(isset($_SESSION['administrador'])){
            $cpf = $_SESSION['administrador'];
        }else if(isset($_SESSION['enfermeiro'])){
            $cpf = $_SESSION['enfermeiro'];
        }else if(isset($_SESSION['enfermeiroChefe'])){
            $cpf = $_SESSION['enfermeiroChefe'];
        }else{
            $cpf = $_SESSION['estagiario'];
        }
        return $cpf;
    }

    public function adicionarOcorrencias(Request $request){
        session_start();
        include("db.php");
        $cod = 0;
        $aberto = HomeController::estadoPronturio($request->prontuario);
        $data = date('Y-m-d');
        $hora = date('H:i:s');
        $nome = null;
        $cpf = HomeController::obterCpf();
        $sql = "SELECT * FROM usuarios WHERE CPF = '$cpf'";
        $query = mysqli_query($connect,$sql);
        while($sql = mysqli_fetch_array($query)){
            $nome = $sql['Nome'];
        }
        if($aberto == '1' and $nome!=null){
            $sql = "SELECT * FROM ocorrencias";
            $query = mysqli_query($connect,$sql);
            while($sql = mysqli_fetch_array($query)){
                $cod = $sql['Codigo'];
            }
            $cod++;
            $insert = "INSERT INTO ocorrencias (Codigo,Data_ocorr,ID_prontuario,Descricao,CPF,Hora) VALUES ('$cod','$data','$request->prontuario','$request->focorrencia','$cpf','$hora')";
            mysqli_query($connect,$insert);
            return redirect() -> back() ->with('msg','Ocorrência adicionada ao prontuario com sucesso!!!!');
        }else if($nome == null){
            return redirect() -> back()->with('msg-error','Seu cpf não foi encontrado na base de dados. Ocorrência não cadastrada');
        }else{
            return redirect() -> back() ->with('msg-error','Prontuario encontrasse fechado');
        }
    }
    
    public function finalizarProntuario(Request $request){
        session_start();
        include("db.php");
        $aberto = HomeController::estadoPronturio($request->prontuario);
        if($aberto == '1'){
            $update = "UPDATE prontuarios SET aberto = '0', Data_Saida = '$request->fsaida' WHERE ID = '$request->prontuario'";
            mysqli_query($connect,$update);
            return redirect() -> back() ->with('msg','Este prontuario foi fechado');
        }else{
            return redirect() -> back() ->with('msg-error','Este prontuario ja encontrasse fechado');
        }
    }

    public function editarProntuario(Request $request){
        session_start();
        include("db.php");
        $ocupado = null;
        $aberto = HomeController::estadoPronturio($request->prontuario);
        if($aberto == '1'){
            /*Inicio dos dados do paciente */
            $update1 = "UPDATE pacientes SET Estado = '$request->fstatus' where CPF='$request->fcpf'";
            mysqli_query($connect,$update1);
            $sql = "SELECT * FROM leitos WHERE Identificacao = '$request->fleito'";
            $query = mysqli_query($connect,$sql);
            while($sql = mysqli_fetch_array($query)){
                $ocupado = $sql['Ocupado'];
            }
            if($ocupado == 0){
                $update1 = "UPDATE leitos SET Ocupado = '0' where Identicacao='$request->leito'";
                mysqli_query($connect,$update1);
                $update2 = "UPDATE leitos SET Ocupado = '1' where Identicacao='$request->fleito'";
                mysqli_query($connect,$update2);
                $update2 = "UPDATE prontuarios SET Id_leito = '$request->fleito' where ID='$request->prontuario'";
                mysqli_query($connect,$update2);
                $update1 = "UPDATE leitos SET Ocupado = '0' where Identicacao='$request->fleito'";
                mysqli_query($connect,$update1);
                return redirect() -> back() ->with('msg','Dados do prontuario foram atualizados!!!');
            }else if($ocupado == 1){
                return redirect() -> back() ->with('msg-error','Um dos seus dados não pode ser alterado. Motivo: Leito informado encontrasse ocupado');
            }else{
                return redirect() -> back() ->with('msg-error','Um dos seus dados não pode ser alterado. Motivo: Leito informado não existe');
            }
        }else{
            return redirect() -> back() ->with('msg-error','Este prontuario ja encontrasse fechado');
        }
    }    
}
