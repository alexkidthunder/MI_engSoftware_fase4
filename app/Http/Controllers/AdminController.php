<?php

namespace App\Http\Controllers;
use App\Models\Administrador;
use App\Models\Enfermeiro_chefe;
use App\Models\Estagiario;
use App\Models\Usuario;
use App\Models\Enfermeiro;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use mysqli;
use PhpParser\Node\Stmt\ElseIf_;


class AdminController extends Controller
{

    public function menu(){
        VerificaLoginController::verificarLoginAdmin();
        return view('/admin/menu');
    }

    public function log(){   
        //gerar um log
        VerificaLoginController::verificarLoginAdmin();

        include("db.php");                          
        $ip = $_SERVER['REMOTE_ADDR'];              //detecta ip
        $data = date('d/m/Y');                      //detecta data
        $horas = time();                            //detecta hora

        //mudar campo de cpf
        $novoLog = "INSERT INTO log (Data_Log, Hora_Agend, CPF_usuario ,Ip) values ('$data','$horas', 12345, '$ip')";
        mysqli_query($connect,$novoLog);
        return view('/admin/log');
    }

    public function atribuicao()
    {   
        VerificaLoginController::verificarLoginAdmin();
        return view('/admin/atribuicao');
    }


    


    public function permissao(Request $request){
        VerificaLoginController::verificarLoginAdmin();

        include("db.php");
        $atribuicao = $request->atribuicao;
        $p = [];

            if ($atribuicao == "admin") {
                $sql = "";
                $query = null;
                             
               
              
                
                for ($i = 1; $i <= 33; $i++) {          
                $sql = "SELECT * FROM permissao_cargo where permissao_id = $i";
                $query = mysqli_query($connect, $sql);   
                    while($sql = $query->fetch_array()){
                        if($sql['cargo_id'] == 1){
                            $p[$i] = $sql['ativo'] ? 'checked' : 'unchecked';
                        }
                        
                    }
                }
                return view('/admin/permissao',['p'=>$p]);

            }

            else if($atribuicao == 'enfermeiroChefe') {


                $sql = "";
                $query = null;
                             
               
              
                
                for ($i = 1; $i <= 33; $i++) {          
                $sql = "SELECT * FROM permissao_cargo where permissao_id = $i";
                $query = mysqli_query($connect, $sql);   
                    while($sql = $query->fetch_array()){
                        if($sql['cargo_id'] == 2){
                            $p[$i] = $sql['ativo'] ? 'checked' : 'unchecked';
                        }
                        
                    }
                }
                return view('/admin/permissao',['p'=>$p]);

            }


            
            else if($atribuicao == 'enfermeiro'){
                $sql = "";
                $query = null;
                             
               
              
                
                for ($i = 1; $i <= 33; $i++) {          
                $sql = "SELECT * FROM permissao_cargo where permissao_id = $i";
                $query = mysqli_query($connect, $sql);   
                    while($sql = $query->fetch_array()){
                        if($sql['cargo_id'] == 3){
                            $p[$i] = $sql['ativo'] ? 'checked' : 'unchecked';
                        }
                        
                    }
                }
                return view('/admin/permissao',['p'=>$p]);

            }
            else if($atribuicao == 'estagiario'){
                $sql = "";
                $query = null;
                             
                for ($i = 1; $i <= 33; $i++) {          
                $sql = "SELECT * FROM permissao_cargo where permissao_id = $i";
                $query = mysqli_query($connect, $sql);   
                    while($sql = $query->fetch_array()){
                        if($sql['cargo_id'] == 4){
                            $p[$i] = $sql['ativo'] ? 'checked' : 'unchecked';
                        }
                        
                    }
                }
                return view('/admin/permissao',['p'=>$p]);

            }
             else {

                return view('/admin/permissao');
            }

    }


    public function alterarPermissao(Request $request)
    {
        session_start();
        $array = explode("=",$_SERVER['HTTP_REFERER']);
        $atribuicao = $array[count($array)-1];

        include("db.php");
        if ($atribuicao != "admin") {
            if ($atribuicao == 'enfermeiroChefe') {
                for ($i = 7; $i <= 33; $i++) {
                    if (isset($_GET['p'.$i])) {
                        $update = "UPDATE permissao_cargo set ativo = '1' where id = $i";
                        mysqli_query($connect, $update);
                    } else {
                        $update = "UPDATE permissao_cargo set ativo = '0' where id = $i";
                        mysqli_query($connect, $update);
                    }
                }
                return redirect()->back()->with('msg',"Permissões alteradas!!!!");
            }

            else if ($atribuicao == 'enfermeiro') {
                for ($i = 34; $i < 60; $i++) {
                    if (isset($_GET['p'.($i-27)])) {
                        $update = "UPDATE permissao_cargo set ativo = '1' where id = $i";
                        mysqli_query($connect, $update);
                    } else {
                        $update = "UPDATE permissao_cargo set ativo = '0' where id = $i";
                        mysqli_query($connect, $update);
                    }
                }
                return redirect()->back()->with('msg',"Permissões alteradas!!!!");
            } else if ($atribuicao == 'estagiario') {
                for ($i = 61; $i < 87; $i++) {
                    if (isset($_GET['p'.($i-54)])) {
                        $update = "UPDATE permissao_cargo set ativo = '1' where id = $i";
                        mysqli_query($connect, $update);

                    } else {
                        $update = "UPDATE permissao_cargo set ativo = '0' where id = $i";
                        mysqli_query($connect, $update);
                    }
                }
                return redirect()->back()->with('msg',"Permissões alteradas!!!!");
            }
        }
           
         else {
            return redirect()->back()->with('msg-error', 'Você não pode alterar permissões de Administradores');
        }

    }


    public function backup()
    {
        VerificaLoginController::verificarLoginAdmin();
        return view('/admin/backup');
    }

    public function remocao()
    {  
        
        VerificaLoginController::verificarLoginAdmin();
        include('..\app\Http\Controllers\db.php'); 
        if (isset($_GET['cpf'])) {
            $cpf = $_GET['cpf'];
            //$atr = $_GET['atr'];    
            $query ="DELETE FROM usuarios WHERE CPF = '$cpf'";
            $status = mysqli_query($connect, $query);            
                    
            return view('/admin/remocaoUsuario',['status'=>$status]);
        } else {
            return view('/admin/remocaoUsuario');
        }       
      
    }
    
    public function alterarAtribuicao(Request $request){
        session_start();
        include("db.php"); // Importando BD
        $request -> validate([
            'novaAtribuicao' => 'required' // Verificação de preenchimento de campo 
        ]);
        $cpf = $request->cpf;  // Obtenndo CPF
        /*--------Query para obter usuario com o CPF */
        $sql = "SELECT * FROM usuarios where CPF='$cpf'";
        $query = mysqli_query($connect,$sql);
        while($sql = mysqli_fetch_array($query)){ //Percorrendo array com todos os usuarios com determinado cpf
            $atribuicao = $sql["Atribuicao"]; // Obtem array de uma posição
            if($atribuicao != "Estagiario"){
                if($atribuicao == "Enfermeiro"){
                    $sql2 = "SELECT * FROM enfermeiros where CPF='$cpf'";
                    $query2 = mysqli_query($connect,$sql2);
                    while($sql2 = mysqli_fetch_array($query2)){
                        $coren = $sql2["COREN"];
                    }
                }else if($atribuicao == "Enfermeiro Chefe"){
                    $sql2 = "SELECT * FROM enfermeiros_chefes where CPF='$cpf'";
                    $query2 = mysqli_query($connect,$sql2);
                    while($sql2 = mysqli_fetch_array($query2)){
                        $coren = $sql2["COREN"];
                    }
                }else{
                    $coren = null;
                }
                
            }else{
                $coren = null;
            }
        }
        // Encontra a qual tabela o usuario pertence desde que não seja administrador

        if($atribuicao != "Administrador"){
            if ($atribuicao == 'Enfermeiro Chefe') {
                if($request->novaAtribuicao == "Enfermeiro"){
                    $delete = "DELETE FROM enfermeiros_chefes WHERE CPF='$cpf'";
                    mysqli_query($connect,$delete); // Deleta usuarios
                    $update = "UPDATE usuarios SET Atribuicao = 'Enfermeiro' WHERE CPF='$cpf'";
                    mysqli_query($connect,$update); // atualiza a atribuicao no BD
                    $insert = "INSERT INTO enfermeiros (CPF,COREN,Plantao) VALUES ('$cpf','$coren','false')";
                    mysqli_query($connect,$insert); // Adicioa usuario a novo cargo
                    return redirect() -> back() ->with('msg','Cargo alterado com sucesso!!!!'); //Redireciona para pagina anterior e mostra mensagem de erro
                }else{
                    return redirect() -> back() ->with('msg-error','Cargo selecionado invalido'); //Redireciona para pagina anterior e mostra mensagem de erro

                }
            }
            else if($atribuicao == 'Enfermeiro'){
                if($request->novaAtribuicao == "Enfermeiro Chefe"){
                    $delete = "DELETE FROM enfermeiros WHERE CPF='$cpf'";
                    mysqli_query($connect,$delete); // Deleta usuarios
                    $update = "UPDATE usuarios SET Atribuicao = 'Enfermeiro Chefe' WHERE CPF='$cpf'";
                    mysqli_query($connect,$update); // atualiza a atribuicao no BD
                    $insert = "INSERT INTO enfermeiros_chefes (CPF,COREN) VALUES ('$cpf','$coren')";
                    mysqli_query($connect,$insert);// Adicioa usuario a novo cargo
                    return redirect() -> back() ->with('msg','Cargo alterado com sucesso!!!!'); //Redireciona para pagina anterior e mostra mensagem de erro
                }else{
                    return redirect() -> back() ->with('msg-error','Cargo selecionado invalido'); //Redireciona para pagina anterior e mostra mensagem de erro
                }
            }
            else if($atribuicao == 'Estagiario'){
                if($request->novaAtribuicao == "Enfermeiro"){
                    $delete = "DELETE FROM estagiarios WHERE CPF='$cpf'";
                    mysqli_query($connect,$delete); // Deleta usuarios
                    $update = "UPDATE usuarios SET Atribuicao = 'Estagiario' WHERE CPF='$cpf'";
                    mysqli_query($connect,$update); // atualiza a atribuicao no BD
                    $insert = "INSERT INTO enfermeiros (CPF,COREN,Plantao) VALUES ('$cpf','$request->fcoren','false')";
                    mysqli_query($connect,$insert);// Adicioa usuario a novo cargo
                    return redirect() -> back() ->with('msg','Cargo alterado com sucesso!!!!'); //Redireciona para pagina anterior e mostra mensagem de erro
                }else if($request->novaAtribuicao == "Enfermeiro Chefe"){
                    $delete = "DELETE FROM estagiarios WHERE CPF='$cpf'";
                    mysqli_query($connect,$delete); // Deleta usuarios
                    $update = "UPDATE usuarios SET Atribuicao = 'Enfermeiro Chefe' WHERE CPF='$cpf'";
                    mysqli_query($connect,$update); // atualiza a atribuicao no BD
                    $insert = "INSERT INTO enfermeiros_chefes (CPF,COREN) VALUES ('$cpf','$request->fcoren')";
                    mysqli_query($connect,$insert);// Adicioa usuario a novo cargo
                    return redirect() -> back() ->with('msg','Cargo alterado com sucesso!!!!'); //Redireciona para pagina anterior e mostra mensagem de erro
                }else{
                    return redirect() -> back() ->with('msg-error','Cargo selecionado invalido'); //Redireciona para pagina anterior e mostra mensagem de erro
                }
            }
        }else{       
            return redirect() -> back() ->with('msg-error','Você não pode alterar o cargo de administradores!!!'); //Redireciona para pagina anterior e mostra mensagem de erro
        }

    }

    public function lupinha(Request $request){
        session_start();
        include("db.php"); // inclusão do banco de dados
        $user = null; // garantia de existência da variavel
        // busca do usuario no banco de dados
        $sql = "SELECT * FROM usuarios where CPF = '$request->cpf_user'";
        $query = mysqli_query($connect,$sql);
        while($sql = mysqli_fetch_array($query)){ //percorrendo array de usuarios com determinado cpf
            $user = $sql; //retorno do usuario
        }
        /*garantido que usuario foi pego na busca*/
        if($user != null){
            if($user["Atribuicao"] == "Enfermeiro Chefe"){
                $sql2 = "SELECT * FROM enfermeiros_chefes where CPF = '$request->cpf_user'";
                $query2 = mysqli_query($connect,$sql2);
                while($sql2 = mysqli_fetch_array($query2)){ //percorrendo array de usuarios com determinado cpf
                    $user2 = $sql2; //retorno do usuario
                    return view('/admin/atribuicao', ['user' => $user],['user2' => $user2]); // se encontrou retorna usuario para view 
                }
            }elseif($user["Atribuicao"] == "Enfermeiro"){
                $sql2 = "SELECT * FROM enfermeiros where CPF = '$request->cpf_user'";
                $query2 = mysqli_query($connect,$sql2);
                while($sql2 = mysqli_fetch_array($query2)){ //percorrendo array de usuarios com determinado cpf
                    $user2 = $sql2; //retorno do usuario
                    return view('/admin/atribuicao', ['user' => $user], ['user2' => $user2]); // se encontrou retorna usuario para view 
                }
            }else{
                return view('/admin/atribuicao', ['user' => $user]); // se encontrou retorna usuario para view 
            }
           
        }
        else{
            return redirect() -> back() ->with('msg-error','CPF não cadastrado no sistema!!'); //Redireciona para pagina anterior e mostra mensagem de erro
        }
    }
        
    public function cadastro()              //função para chamar a função salvar usuário pela view
    {
        VerificaLoginController::verificarLoginAdmin();
        return view('/admin/cadastroUsuario');
    }


    public function salvarUsuario(Request $request){
        include("conexao.php");
        session_start();
        //validação de erro de entrada
        $validator = Validator::make($request->all(), [     
            'fcpf' => 'required|min:14|max:14',
        ]);
            
        //redirecionando o usuario caso ocorra o erro
        if ($validator->fails()) {
            return redirect()->route('salvarUsuario')->with('error', "Digite um CPF válido!!");   
        }    
 
        //busca de cpf no banco  
        $existeCPF = mysqli_query($conn,"SELECT COUNT(*) FROM usuarios WHERE CPF = '$request->fcpf'");

        if(mysqli_fetch_assoc($existeCPF)['COUNT(*)'] == 0){
            $ip = $request->ip();

            //insere na trabela usuário
            $novoUsuario = "INSERT INTO usuarios (CPF, Nome, Senha, Email, Data_Nasc, Atribuicao, Sexo, Ip) values ('$request->fcpf', 
            '$request->fnome', 12345, '$request->femail', '$request->fnascimento', '$request->fatribui','$request->fsexo','$ip')";
            mysqli_query($conn,$novoUsuario);
            
           
            //insere na tabela de administrador
            if ($request->fatribui == 'Administrador'){             
                $novoAdm = "INSERT INTO administradores (CPF) values ('$request->fcpf')";
                mysqli_query($conn,$novoAdm);

            }else{  
                //insere na tabela de enfermeiro chefe
                if ($request->fatribui == 'Enfermeiro Chefe') {
                    $novoEnfChefe = "INSERT INTO enfermeiros_chefes (CPF,COREN) values ('$request->fcpf','$request->fcoren')";
                    mysqli_query($conn,$novoEnfChefe);
                }
                //insere na tabela de enfermeiro
                else if ($request->fatribui == 'Enfermeiro') {
                    $novoEnf = "INSERT INTO enfermeiros (CPF,COREN,Plantao) values ('$request->fcpf', '$request->fcoren','false')";
                    mysqli_query($conn,$novoEnf);
                }
                //insere na tabela de estagiario
                else if ($request->fatribui == 'Estagiário') {
                    $novoEst = "INSERT INTO estagiarios (CPF,Plantao) values ('$request->fcpf','false')";
                    mysqli_query($conn,$novoEst);
                }   
            }         
            return redirect()->route('cadastrarUsuario')->with('success','Usuário cadastrado com sucesso!!');
            }
            else{
                //se o usuário já existir
                return redirect()->route('cadastrarUsuario')->with('error','Usuário já cadastrado!!');
            }
      }
     

    public function busca(Request $request)
    {          
        session_start();
        include('..\app\Http\Controllers\db.php');        
        $query = "SELECT * FROM usuarios WHERE CPF= '$request->cpf_user'";
        $result = mysqli_query($connect, $query);       
        $user = mysqli_fetch_array($result);
        
        
        if ($user == null) {
            $user = 0;
            $atribuicao = 0;
        }

        if($user != 0){
            if(strcmp($user['Atribuicao'],"Enfermeiro") == 0){
                $enfermeiro = mysqli_query($connect, "SELECT * FROM enfermeiros WHERE CPF= '$request->cpf_user'");
                $atribuicao = mysqli_fetch_array($enfermeiro);  
            }else if(strcmp($user['Atribuicao'], "Enfermeiro Chefe") == 0){
                $enfermeiro_Chefe = mysqli_query($connect, "SELECT * FROM enfermeiros_chefes WHERE CPF= '$request->cpf_user'");   
                $atribuicao = mysqli_fetch_array($enfermeiro_Chefe);   
            }else{
                $atribuicao = 0;
            }
        }
        return view('/admin/remocaoUsuario', ['user' => $user, 'atribuicao'=> $atribuicao]);
        
    }
}
