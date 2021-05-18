<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Monolog\Handler\SendGridHandler;


class HomeController extends Controller
{
    public function index(){
        return view('login');
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
            $_SESSION['usuario'] = $request->cpf; // inicia uma sessão de nome usuario com o cpf recuperado
            
            $cpf=$request->cpf;
            
            /*Sequência de condicionais que verifica o cargo para reirecionar para o menu correto */
            if($atribuicao == "Administrador"){
                if($request->senha == "12345"){
                  // header("Location: /primeiroAcesso.$cpf");
                 //  exit();
                   return redirect('/primeiroAcesso')->with('cpf', $request->cpf);

                }
                return redirect() -> intended('menu');
            }else if($atribuicao == "Enfermeiro Chefe"){
                if($request->senha == "12345"){
                    return redirect('/primeiroAcesso')->with('cpf', $request->cpf);
                }    
                return redirect() -> intended('menuEnfermeiroChefe');
            }else if($atribuicao == "Enfermeiro"){
                if($request->senha == "12345"){
                    return redirect('/primeiroAcesso')->with('cpf', $request->cpf);
                }   
                return redirect() -> intended('menuEnfermeiro');
            }else if($atribuicao == "Estagiario"){
                if($request->senha == "12345"){
                    return redirect('/primeiroAcesso')->with('cpf', $request->cpf);
                }   
                return redirect() -> intended('menuEstagiario');
            }else{
                return redirect() -> back() ->with('msg','Funcionário sem cargo, algo está errado!!!');
            }
        }else{ // caso em que o $row = 0
            return redirect() -> back() ->with('msg','Acesso negado para essas credenciais!!');
        }

    }

    public function verificarLoguin(){
        include('db.php');
        session_start();
        if(!$_SESSION['usuario']){
            return view('../login.php');
        }
    }

    public function logout(){
        session_start();
        session_destroy();
        return view('login');
    }
    
     
    public function acessarPrimeiroAcesso(){
        return view('primeiroAcesso');
    }

    public function primeiroAcesso(Request $request){
        include('conexao.php');
        $senhaDefinida = $request->senha;
        $senhaConfirmacao = $request->confirmacao;
        //dd($request->cpf);
        //se a nova senha desejada for igual a de confimação
        if ($senhaConfirmacao == $senhaDefinida){
            //$senhaCript = Hash::make($senhaConfimacao);         //cria um hash a partir da nova senha 

            $cpf = $request->cpf;          
            $select = "SELECT * FROM usuarios where CPF = '$cpf'";
            mysqli_query($conn,$select);
            //dd($select);

            //se existe o cpf no banco de dados
            $update = "UPDATE usuarios SET Senha = '$senhaConfirmacao' WHERE CPF = '$cpf'";     //atualiza no banco de dados
            mysqli_query($conn,$update);

            return redirect()->route('index')->with('success','Senha cadastrada com sucesso!!');

        //se a nova senha desejada for diferente da confirmada
        }else{
            return redirect()->route('acessarPrimeiroAcesso')->with('error','A senha de confirmação está diferente da nova senha!!');
       }

    }


    public function menu(){
        return view('admin.menu');
    }
    public function editPerfil(){
        return view('editarPerfil');
    }

    public function listaPacientes(){
        return view('listaPacientes');
    }

    public function agendamentosRealizados(){
        return view('agendamentosRealizados');
    }

    public function meusAgendamentos(){
        return view('meusAgendamentos');
    }
    
    public function agendamentos(){
        return view('agendamentos');
    }

    public function cadastroAgendamentos(){
        return view('cadastroAgendamentos');
    }

    public function cadastroProntuario(){
        return view('cadastroProntuario');
    }

    public function cadastroPaciente(){
        return view('cadastroPaciente');
    }

    public function esqueciSenha(){
        return view('esqueciSenha');
    }

    public function mensagens(){
        return view('mensagens');
    }
  
    public function listaMedicamento(){
        return view('listaMedicamento');
    }

    public function salvarPaciente(Request $request){
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

}
