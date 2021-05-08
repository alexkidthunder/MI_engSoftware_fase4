<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            
            /*Sequência de condicionais que verifica o cargo para reirecionar para o menu correto */
            if($atribuicao == "Administrador"){
                return redirect() -> intended('menu');
            }else if($atribuicao == "Enfermeiro Chefe"){
                return redirect() -> intended('menuEnfermeiroChefe');
            }else if($atribuicao == "Enfermeiro"){
                return redirect() -> intended('menuEnfermeiro');
            }else if($atribuicao == "Estagiario"){
                return redirect() -> intended('menuEstagiario');
            }else{
                return redirect() -> back() ->with('msg','Funcionario sem cargo, algo esta errado!!!');
            }
        }else{ // caso em que o $row = 0
            return redirect() -> back() ->with('msg','Acesso negado para essas credenciais');
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
    
    public function primeiroAcesso(){
        return view('primeiroAcesso');
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
}
