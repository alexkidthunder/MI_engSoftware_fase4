<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Monolog\Handler\SendGridHandler;
use PhpParser\Node\Stmt\Return_;
use Dompdf\Dompdf;
use Dompdf\Options;
use Mpdf\Mpdf;

class HomeController extends Controller
{

    //função de página inicial
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


    //função de login
    public function login(Request $request){
        include("db.php");
        $request -> validate([
            'cpf' => 'required',
            'senha' => 'required'
        ]);
        $result = mysqli_query($connect,"SELECT CPF FROM usuarios WHERE CPF = '$request->cpf' AND Senha = '$request->senha'"); /*Verificando se cpf e senha estão cadastrados no banco de dados*/ 
        $row = mysqli_num_rows($result); /*resultado da verificação*/
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

                    //log
                    $ip = $_SERVER["REMOTE_ADDR"];
                    $acao = "Administrador logou";           
                    AdminController::salvarLog($acao, $ip);

                    header("Location: /menuAdm");
                    exit();

                }else if($atribuicao == "Enfermeiro Chefe"){
                    $_SESSION['enfermeiroChefe'] = $request->cpf; // inicia uma sessão de nome usuario com o cpf recuperado
                    if($request->senha == 12345){
                        return redirect('/primeiroAcesso')->with('cpf', $request->cpf);
                    }

                    //log
                    $ip = $_SERVER["REMOTE_ADDR"];
                    $acao = "Enfermeiro chefe logou";           
                    AdminController::salvarLog($acao, $ip);

                    header("Location: /menu");
                    exit();

                }else if($atribuicao == "Enfermeiro"){
                    $_SESSION['enfermeiro'] = $request->cpf; // inicia uma sessão de nome usuario com o cpf recuperado
                    if($request->senha == 12345){
                        return redirect('/primeiroAcesso')->with('cpf', $request->cpf);
                    }

                    //log
                    $ip = $_SERVER["REMOTE_ADDR"];
                    $acao = "Enfermeiro logou";           
                    AdminController::salvarLog($acao, $ip);


                    header("Location: /menu");
                    exit();

                }else if($atribuicao == "Estagiario"){
                    $_SESSION['estagiario'] = $request->cpf; // inicia uma sessão de nome usuario com o cpf recuperado
                    if($request->senha == 12345){
                        return redirect('/primeiroAcesso')->with('cpf', $request->cpf);
                    }

                    //log
                    $ip = $_SERVER["REMOTE_ADDR"];
                    $acao = "Estagiário logou";           
                    AdminController::salvarLog($acao, $ip);

                    header("Location: /menu");
                    exit();

                }else{
                    return redirect() -> back() ->with('msg-error','Funcionário sem cargo, algo está errado!!!');
                }

            }else{
                return redirect() -> back() ->with('msg-error','Conta do funcionário encontra-se desativada');
            }
        }else{ // caso em que o $row = 0
            return redirect() -> back() ->with('msg-error','Acesso negado para essas credenciais!');
        }

    }


    //função de menu, exceto do adm
    public function menu(){
        VerificaLoginController::verificarLogin();
        if(isset($_SESSION['enfermeiro']) or isset($_SESSION['enfermeiroChefe']) or isset($_SESSION['estagiario'])){
            return view('/menu');
        }
        else{
            return redirect()->back();
        }
    }


    //função de logout
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
    

    //função de chamada de view de primeiro acesso  
    public function acessarPrimeiroAcesso(){
        return view('primeiroAcesso');
    }

    public function primeiroAcesso(Request $request){       //função de processar o primeiro acesso 
        include('db.php');

        $cpf = $request->cpf; 
        $senhaDefinida = $request->senha;
        $senhaConfirmacao = $request->confirmacao;

        //se a nova senha desejada for igual a de confimação
        if ($senhaConfirmacao == $senhaDefinida){
           //$senhaCript = md5($senhaConfirmacao);         //cria um hash a partir da nova senha 
           //dd($senhaCript);    

           //$buscaSenha = "SELECT * FROM usuarios where CPF = '$request->cpf' AND Senha = '$senhaCript";
          // $senhaDescript = AES_DECRYPT() 

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
                    // inicia uma sessão de nome usuario com o cpf recuperado
                    $_SESSION['administrador'] = $request->cpf; 
                    
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


    //função de editar perfil
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
    

    //função de alterar senha 
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


    //função de alterar dados 
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


    //função de listar pacientes 
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
                //busca pacientes no banco com o status internado
                $sql = "SELECT * FROM pacientes WHERE Estado = 'internado'";
                $query = mysqli_query($connect,$sql);

                //preenche array para ser exibido
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
                //busca no banco pacientes com o status de alta
                $sql = "SELECT * FROM pacientes WHERE Estado = 'alta'";
                $query = mysqli_query($connect,$sql);

                //preenche array para ser exibido
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
                //busca no banco pacientes com status de óbito
                $sql = "SELECT * FROM pacientes WHERE Estado = 'obito'";
                $query = mysqli_query($connect,$sql);

                //preenche array para ser exibido
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

                //log
                $ip = $_SERVER["REMOTE_ADDR"];
                $acao = "Visualizou lista de pacientes";           
                AdminController::salvarLog($acao, $ip);
                
                return view('listaPacientes',['p'=>$p,'identicador'=>$identicador]);
            }else{
                return view('listaPacientes');
            }
        }else{
            return redirect()->back();
        }
    }


    //função de agendamentos realizados
    public function agendamentosRealizados(){
        VerificaLoginController::verificarLogin();
        $resultado = VerificaLoginController::verificaPermissao(22);
        include("db.php");
        $infos = [];
        $identificaP = null;
        $i = 0;
        if($resultado == "1"){
            $cpf = HomeController::obterCpf();
            $sql = "SELECT * FROM agendamentos WHERE CPF_usuario = '$cpf'";
            $query = mysqli_query($connect,$sql);
            while($sql = mysqli_fetch_array($query)){
                if($sql['Realizado'] == 1){
                    $medicamento = $sql['Cod_medicamento'];
                    $prontuario = $sql['ID_prontuario'];
                    $infos['hora'.$i] = $sql['Hora_Agend'];
                    $infos['data'.$i] = $sql['Data_Agend'];
                    $infos['posologia'.$i] = $sql['Posologia'];
                    $infos['id'.$i] = $sql['Codigo'];
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
                    $infos['identificaP'.$i] = $identificaP;
                     $i++;
                }
            }

            //log
            $ip = $_SERVER["REMOTE_ADDR"];
            $acao = "Visualizou lista de agendamentos realizados";           
            AdminController::salvarLog($acao, $ip);
     
            return view('agendamentosRealizados',['infos' => $infos]);
        }else{
            return redirect()->back()->with('msg-error','Você não tem acesso a essa pagina!!!');
        }
    }


    //função de visualizar meus agendamentos
    public function meusAgendamentos(){
        VerificaLoginController::verificarLogin();
        $resultado = VerificaLoginController::verificaPermissao(23);
        include("db.php");
        $infos = [];
        $i = 0;
        $identificaP = null;
        if($resultado == "1"){
            $cpf = HomeController::obterCpf();
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
                    $infos['identificaP'.$i] = $identificaP;
                    $i++;
                }
            }


            //log
            $ip = $_SERVER["REMOTE_ADDR"];
            $acao = "Visualizou lista de meus agendamentos";           
            AdminController::salvarLog($acao, $ip);

            return view('meusAgendamentos',['infos' => $infos]);

        }else{
            return redirect()->back()->with('msg-error','Você não tem acesso a essa pagina!!!');
        }
    }


    //função de finalizar meus agendamentos
    public function finalizarMeusAgendamentos(Request $request){
        include("db.php");
        session_start();
        $sql = "UPDATE agendamentos SET Realizado = '1' WHERE Codigo = '$request->idA'";
        mysqli_query($connect,$sql);

        //log
        $ip = $_SERVER["REMOTE_ADDR"];
        $acao = "Finalizou um agendamento de medicamento";           
        AdminController::salvarLog($acao, $ip);

        return redirect()->back();
    }
        

    //função de ver agendamentos
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
                    $infos['identificaP'.$i] = $identificaP;
                    $i++;
                }
            }


            //log
            $ip = $_SERVER["REMOTE_ADDR"];
            $acao = "Visualizou lista de agendamentos";           
            AdminController::salvarLog($acao, $ip);

            return view('agendamentos',['infos' => $infos]);

        }else{
            return redirect()->back();
        }
    }


    //função auto cadastro em agendamentos
    public function autoCadastroAgendamento(Request $request){
        include("db.php");
        session_start();
        $perm = VerificaLoginController::verificaPermissao(25);
        if($perm == "1"){
            $cpf = HomeController::obterCpf();
            if($cpf!=null){
                $update = "UPDATE agendamentos SET CPF_usuario = '$cpf' WHERE Codigo = '$request->codA'";
                mysqli_query($connect,$update);

                //log
                $ip = $_SERVER["REMOTE_ADDR"];
                $acao = "Auto cadastrou como aplicador de um agendamento";           
                AdminController::salvarLog($acao, $ip);

                return redirect()->back()->with('msg','Você se adicionou como aplicador do agendamento');
            }
        }else{
            return redirect()->back();
        }
    }


    //função para permissão de cadastro de agendamentos
    public function cadastroAgendamentos(){
        VerificaLoginController::verificarLogin();
        $resultado = VerificaLoginController::verificaPermissao(12);
        if($resultado == "1"){
            return view('cadastroAgendamentos');
        }else{
            return redirect()->back()->with('msg-error','Você não tem acesso a essa pagina!!!');
        } 
    }


    //função para permissão de cadastro de prontuário
    public function cadastroProntuario(){
        VerificaLoginController::verificarLogin();
        $perm = VerificaLoginController::verificaPermissao(33);
        if($perm == "1"){
            return view('cadastroProntuario');
        }else{
            return redirect()->back();
        }
    }


    //função para permissão de cadastro de paciente
    public function cadastroPaciente(){
        VerificaLoginController::verificarLogin();
        $resultado = VerificaLoginController::verificaPermissao(17);
        if($resultado == "1"){
            return view('cadastroPaciente');
        }else{
            return redirect()->back()->with('msg-error','Você não tem acesso a essa pagina!!!');
        }

    }


    //função de esqueci a senha
    public function esqueciSenha(){



        return view('esqueciSenha');
    }
    

    //função de listagem de medicamentos
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

            //log
            $ip = $_SERVER["REMOTE_ADDR"];
            $acao = "Visualizou lista de medicamentos";           
            AdminController::salvarLog($acao, $ip);

            return view('listaMedicamento',['m' => $m]);
        }else{
            return redirect()->back()->with('msg-error','Você não tem acesso a essa pagina!!!');
        }
    }


    //função de permissão de histórico de prontuário
    public function historicoProntuario(){
        VerificaLoginController::verificarLogin();
        $perm = VerificaLoginController::verificaPermissao(18);
        if($perm == "1"){
            return view('historicoProntuario');
        }else{
            return redirect()->back();
        }
    }


    //função de salvar paciente no banco de dados
    public function salvarPaciente(Request $request){
        session_start();
        include('db.php');

        //buscar paciente
        $existePac = mysqli_query($connect,"SELECT COUNT(*) FROM pacientes WHERE CPF = '$request->fcpf'");

        //se não existir o paciente
        if(mysqli_fetch_assoc($existePac)['COUNT(*)'] == 0){

            //cria paciente e adiciona
            $novoPac = "INSERT INTO pacientes (Nome_Paciente, Sexo, Data_Nasc, CPF, Tipo_Sang) values
            ('$request->fnome', '$request->fsexo', '$request->fnascimento', '$request->fcpf', '$request->fsanguineo')";
            mysqli_query($connect,$novoPac);
            
            $ip = $request->ip();
            $acao = "Cadastrou paciente $request->fnome";           
            AdminController::salvarLog($acao, $ip);

            return redirect()->route('cadastroPaciente')->with('success', "Paciente cadastrado com sucesso!");
        }else{
            //se existir o paciente cadastrado
            return redirect()->route('cadastroPaciente')->with('error', "Paciente já existente no banco de dados!!");
        } 
    }


    //função de permissão de acesso ao prontuário
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
            $sql = "SELECT * FROM prontuarios where ID ='$request->numero'";
            $query = mysqli_query($connect,$sql);
            while($sql = mysqli_fetch_array($query)){
                $paciente['internacao'] = $sql['Data_Internacao'];
                $paciente['leito'] = $sql['Id_leito'];
                $paciente['prontuario'] = $sql['ID'];
                $id = $paciente['prontuario'];
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

            //log
            $ip = $_SERVER["REMOTE_ADDR"];
            $acao = "Visualizou prontuário de paciente";           
            AdminController::salvarLog($acao, $ip);

                /*inicio das ocorrências */
                $infosO = [];
                $k = 0;
                $sql3 = "SELECT * FROM ocorrencias WHERE ID_prontuario = '$request->numero'";
                $query3 = mysqli_query($connect,$sql3);
                while($sql3 = mysqli_fetch_array($query3)){
                    $infosO['data'.$k] = $sql3['Data_ocorr'];
                    $infosO['ocorrencia'.$k] = $sql3['Descricao'];
                    $infosO['hora'.$k] = $sql3['Hora_ocorr'];
                    $fun = $sql3['CPF'];
                    $sql4 = "SELECT * FROM usuarios where CPF = '$fun'";
                    $query4 = mysqli_query($connect,$sql4);
                    while($sql4 = mysqli_fetch_array($query4)){
                        $infosO['aplicador'.$k] = $sql4['Nome'];
                    }
                    $k++;
                }

                $infosC = [];
                $l = 0;
                $sql4 = "SELECT * FROM cid_prontuario WHERE id_prontuario = '$request->numero'";
                $query4 = mysqli_query($connect,$sql4);
                while($sql4 = mysqli_fetch_array($query4)){
                    $idcid = $sql4['id_CID'];
                    $sql5 = "SELECT * FROM cid WHERE id = $idcid";
                    $query5 = mysqli_query($connect,$sql5);
                    while($sql5 = mysqli_fetch_array($query5)){
                        $infosC['cid'.$l] = $sql5['codCid'];
                    }
                    $l++;
                }
            }else{
                return redirect()->back()->with('msg-error','Não foi possivel encontrar o prontuario no banco de dados!!!');
            }
            
            return view('prontuario',['paciente' => $paciente, 'infosA' => $infosA, 'infosM' => $infosM, 'infosO' => $infosO, 'infosC' => $infosC]);
        }else{
            return redirect()->back()->with('msg-error','Você não tem acesso a essa pagina!!!');
        }
    }

    public function cadastrarProntuario(Request $request){
        include("db.php");
        $sql = "SELECT * FROM leitos where Identificacao = '$request->Leito'";
        $query = mysqli_query($connect, $sql);
        $temp = mysqli_fetch_array($query);  
             
        //caso o Leito não esteja mais disponível
        if($temp['Ocupado'] == 1){
            return redirect()->back()->with('msg-error', 'O Leito não está mais disónível, tente novamente.');
        }
        // caso o Leito esteja disponível

        // verificar se o Paciente já pertence a um prontuário aberto
        $sql3 = "SELECT * FROM prontuarios WHERE Cpfpaciente = '$request->CPF_Paciente'";
        $query3 = mysqli_query($connect, $sql3);
       
        while( $dado = mysqli_fetch_array($query3)){
            
            if($dado['aberto'] == 1){
                return redirect()->back()->with('msg-error', 'O paciente já possuí um prontuário em aberto no sistema'); 
            }
            
        }

        
        // ocupar o leito
       $sql1 = "UPDATE leitos SET Ocupado = '1' WHERE Identificacao = '$request->Leito'";
       $query1 = mysqli_query($connect, $sql1);

       //cadastrar o prontuário
       $sql2 = "INSERT INTO prontuarios (aberto, Data_Internacao, Id_leito, Cpfpaciente) VALUES
                        ('1', '$request->data_internacao', '$request->Leito', '$request->CPF_Paciente')";
       $query2 = mysqli_query($connect, $sql2);
       if($query2 == 1){
           // se cadastrou com sucesso
           return redirect()->route('cadastroProntuario')->with('msg-sucess', 'Prontuário cadastrado com sucesso');
       }else{
           //caso não cadastre erro no bd
           return redirect()->back()->with('msg-error', 'Ocorreu um erro com o Banco de Dados tente novamente');
       }
      

    }


    //função de buscar prontuário
    public function buscaProntuario(Request $request){
        session_start();
        include("db.php");                  // inclusão do banco de dados
        $prontuario = [];                   // garantia de existência da variavel
        
        // busca do usuario no banco de dados
        $i = 0;
        $sql = "SELECT * FROM prontuarios where Cpfpaciente = '$request->cpf_user'";
        $query = mysqli_query($connect,$sql);
        while($sql = mysqli_fetch_array($query)){ //percorrendo array de usuarios com determinado cpf
            $sql1 = "SELECT * FROM pacientes where CPF = '$request->cpf_user'";
            $query1 = mysqli_query($connect,$sql1);
            while($sql1 = mysqli_fetch_array($query1)){
                if($sql["aberto"]!= 1){
                    $prontuario["id".$i] = $sql['ID'];
                    $prontuario["nome".$i] = $sql1["Nome_Paciente"]; 
                    $prontuario["estado".$i] = $sql1["Estado"]; 
                    $prontuario["cpf".$i] = $sql["Cpfpaciente"]; 
                    $prontuario["internacao".$i] = $sql["Data_Internacao"];
                    $prontuario["saida".$i] = $sql["Data_Saida"];  
                    $i++;
                }
            }
        }

        //log
        $ip = $_SERVER["REMOTE_ADDR"];
        $acao = "Buscou prontuário do paciente";           
        AdminController::salvarLog($acao, $ip);

        return view('historicoProntuario',['prontuario' => $prontuario]);
    }


    //Função que busca um paciente para o cadastro de prontuário e também retorna os leitos disponíveis
    public function buscarPaciente(Request $request)
    {
        session_start();
        include("db.php");
        // BUSCANDO O PACIENTE
        $sql = "SELECT * FROM pacientes WHERE CPF = '$request->cpf_user'";
        $query = mysqli_query($connect, $sql);
        $paciente = mysqli_fetch_array($query);
        
       
        // BUSCANDO OS LEITOS
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
          //FIM BUSCA DOS LEITOS

        if ($paciente == null) {
            return redirect()->back()->with('msg-error', 'Paciente não encontrado');
        } else {

            return view('cadastroProntuario', ['paciente' => $paciente, 'leitos'=>$leitos]);
        }
    }

    //função de mudar estado de prontuário
    public static function estadoPronturio($codigo){
        include("db.php");
        $aberto = null;

        //busca no banco de dados
        $sql = "SELECT * FROM prontuarios WHERE ID = '$codigo'";
        $query = mysqli_query($connect,$sql);
        while($sql = mysqli_fetch_array($query)){
            $aberto = $sql['aberto'];
        }
        return $aberto;
    }


    //função de cadastrar cid em prontuário
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

                //log
                $ip = $_SERVER["REMOTE_ADDR"];
                $acao = "Cadastrou CID $cid ao prontuário nº $request->prontuario";           
                AdminController::salvarLog($acao, $ip);

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


    //função de obter cpf
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


    //função de adicionar ocorrencias em prontuário
    public function adicionarOcorrencias(Request $request){
        session_start();
        include("db.php");
        $cod = 0;
        $aberto = HomeController::estadoPronturio($request->prontuario);
        date_default_timezone_set('America/Sao_Paulo');
        $data = date('d-m-Y');
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
            $insert = "INSERT INTO ocorrencias (Codigo,Data_ocorr,Hora_ocorr,ID_prontuario,Descricao,CPF) VALUES ('$cod','$data','$hora','$request->prontuario','$request->focorrencia','$cpf')";
            mysqli_query($connect,$insert);

            //log
            $ip = $_SERVER["REMOTE_ADDR"];
            $acao = "Adicionou ocorrência ao prontuário nº $request->prontuario";           
            AdminController::salvarLog($acao, $ip);

            return redirect() -> back() ->with('msg','Ocorrência adicionada ao prontuário com sucesso!!!!');
        }else if($nome == null){
            return redirect() -> back()->with('msg-error','Seu cpf não foi encontrado na base de dados. Ocorrência não cadastrada');
        }else{
            return redirect() -> back() ->with('msg-error','Prontuário encontra-se fechado');
        }
    }
    
    //função de finalizar prontuário
    public function finalizarProntuario(Request $request){
        session_start();
        include("db.php");
        $aberto = HomeController::estadoPronturio($request->prontuario);
        if($aberto == '1'){
            $update = "UPDATE prontuarios SET aberto = '0', Data_Saida = '$request->fsaida' WHERE ID = '$request->prontuario'";
            mysqli_query($connect,$update);

            //log
            $ip = $_SERVER["REMOTE_ADDR"];
            $acao = "Finalizou prontuário nº $request->prontuario";           
            AdminController::salvarLog($acao, $ip);

            return redirect() -> back() ->with('msg','Este prontuario foi fechado');
        }else{
            return redirect() -> back() ->with('msg-error','Este prontuario ja encontrasse fechado');
        }
    }


    //função de baixar arquivos
    public function baixarArquivos(Request $request){ 
        session_start();
        include("db.php");
        $cpf = HomeController::obterCpf();

        $testa = "SELECT * from usuarios where CPF = '$cpf'";
        $test = mysqli_query($connect,$testa);
        while($testa = mysqli_fetch_array($test)){
            $nome = $testa['Nome'];
        };
        date_default_timezone_set('America/Sao_Paulo');
        $data_a = date('d-m-y - h:i:s');
        $mpdf =  new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal']);
        //$mpdf->WriteHTML($css,\Mpdf\HTMLParserMode::HEADER_CSS);
        $mpdf->WriteHTML('<body>
        <header class="container-personal-data">
            <div class="container-header">
                <h2><span>Nome Hospital  </span><span>'.$nome. '</span><span>'.$data_a.'</span></h2> <!--Nome do nosso Hospital-->
            </div>
        </header>
        <hr>
        <section>
            <div class="container-header"> 
                <h1>Pacientes e Prontuários</h1> <!--De onde saiu a lista-->
            </div>
            <hr>
            <div class="container-listagem">
                <div>
                    <h2>Listagem 1 Exemplo</h2> <!--Nome da Listagem--> <!--Se precisar ser mais específico-->
                </div>
                <div class="container-item-list"> <!--Tudo que contem em um item da lista e seus campos--> <!--Isso que deve ser posto dentro de um while/for/do while-->
                    <div class="Overflow-hidden"> <!--Caso Precise adicionar mais um campo a essa listagem, criar uma div nova, como essa-->
                        <p>Maria de Fátima Cerqueira Santana Silva              Internada</p>
                    </div>
                </div>
                <div class="container-item-list"> <!--Tudo que contem em um item da lista e seus campos--> <!--Isso que deve ser posto dentro de um while/for/do while-->
                    <div class="Overflow-hidden"> <!--Caso Precise adicionar mais um campo a essa listagem, criar uma div nova, como essa-->
                        <p>Pedro Paulo Matos</p>
                    </div>
                    <div> <!--Campo de Status (Opcional, poderia ser outro campo aqui)-->
                        <p>Óbito</p>
                    </div>
                </div>
                <div class="container-item-list"> <!--Tudo que contem em um item da lista e seus campos--> <!--Isso que deve ser posto dentro de um while/for/do while-->
                    <div class="Overflow-hidden"> <!--Caso Precise adicionar mais um campo a essa listagem, criar uma div nova, como essa-->
                        <p>Fernando Alex Costa Moreira</p>
                    </div>
                    <div> <!--Campo de Status (Opcional, poderia ser outro campo aqui)-->
                        <p>Liberado</p>
                    </div>
                </div>
            </div>
            <div class="container-listagem">
                <div>
                    <h2>Listagem 2 Exemplo</h2> <!--Nome da Listagem--> <!--Se precisar ser mais específico-->
                </div>
                <div class="container-item-list"> <!--Tudo que contem em um item da lista e seus campos--> <!--Isso que deve ser posto dentro de um while/for/do while-->
                    <div class="Overflow-hidden"> <!--Caso Precise adicionar mais um campo a essa listagem, criar uma div nova, como essa-->
                        <p>Maria de Fátima Cerqueira Santana Silva</p>
                    </div>
                    <div> <!--Campo de Status (Opcional, poderia ser outro campo aqui)-->
                        <p>Internada</p>
                    </div>
                </div>
                <div class="container-item-list"> <!--Tudo que contem em um item da lista e seus campos--> <!--Isso que deve ser posto dentro de um while/for/do while-->
                    <div class="Overflow-hidden"> <!--Caso Precise adicionar mais um campo a essa listagem, criar uma div nova, como essa-->
                        <p>Pedro Paulo Matos</p>
                    </div>
                    <div> <!--Campo de Status (Opcional, poderia ser outro campo aqui)-->
                        <p>Óbito</p>
                    </div>
                </div>
                <div class="container-item-list"> <!--Tudo que contem em um item da lista e seus campos--> <!--Isso que deve ser posto dentro de um while/for/do while-->
                    <div class="Overflow-hidden"> <!--Caso Precise adicionar mais um campo a essa listagem, criar uma div nova, como essa-->
                        <p>Fernando Alex Costa Moreira</p>
                    </div>
                    <div> <!--Campo de Status (Opcional, poderia ser outro campo aqui)-->
                        <p>Liberado</p>
                    </div>
                </div>
            </div>
        </section>
        <footer style="position: absolute; bottom: 0;">
            <p id="Copyright">Informações para o Footer da página</p> <!--Caso queira deixar alguma informação no Footer-->
        </footer>
    </body>' );
        $mpdf->Output();
    } 
}
