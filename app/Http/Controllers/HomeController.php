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
            session_start();
            /*Sequência de condicionais que verifica o cargo para reirecionar para o menu correto */
            if($atribuicao == "Administrador"){
                $_SESSION['administrador'] = $request->cpf; // inicia uma sessão de nome usuario com o cpf recuperado
                header("Location: /menu");
                exit();
            }else if($atribuicao == "Enfermeiro Chefe"){
                $_SESSION['enfermeiroChefe'] = $request->cpf; // inicia uma sessão de nome usuario com o cpf recuperado
                header("Location: /menuEnfermeiroChefe");
                exit();
            }else if($atribuicao == "Enfermeiro"){
                $_SESSION['enfermeiro'] = $request->cpf; // inicia uma sessão de nome usuario com o cpf recuperado
                header("Location: /menuEnfermeiro");
                exit();
            }else if($atribuicao == "Estagiario"){
                $_SESSION['estagiario'] = $request->cpf; // inicia uma sessão de nome usuario com o cpf recuperado
                header("Location: /menuEstagiario");
                exit();
            }else{
                return redirect() -> back() ->with('msg-error','Funcionario sem cargo, algo esta errado!!!');
            }
        }else{ // caso em que o $row = 0
            return redirect() -> back() ->with('msg-error','Acesso negado para essas credenciais');
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
        VerificaLoginController::verificarLogin();
        return view('editarPerfil');
    }
    

    public function listaPacientes(){
        VerificaLoginController::verificarLogin();
        return view('listaPacientes');
    }

    public function agendamentosRealizados(){
        VerificaLoginController::verificarLogin();
        return view('agendamentosRealizados');
    }

    public function meusAgendamentos(){
        VerificaLoginController::verificarLogin();
        return view('meusAgendamentos');
    }
    
    public function agendamentos(){
        VerificaLoginController::verificarLogin();
        return view('agendamentos');
    }

    public function cadastroAgendamentos(){
        VerificaLoginController::verificarLogin();
        return view('cadastroAgendamentos');
    }

    public function cadastroProntuario(){
        VerificaLoginController::verificarLogin();
        return view('cadastroProntuario');
    }

    public function cadastroPaciente(){
        VerificaLoginController::verificarLogin();
        return view('cadastroPaciente');
    }

    public function esqueciSenha(){
        return view('esqueciSenha');
    }
    
    public function listaMedicamento(){
        VerificaLoginController::verificarLogin();
        return view('listaMedicamento');
    }

    public function historicoProntuario(){
        VerificaLoginController::verificarLogin();
        return view('historicoProntuario');
    }

    public function salvarPaciente(Request $request){
        VerificaLoginController::verificarLogin();
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
