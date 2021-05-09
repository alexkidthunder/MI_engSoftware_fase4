<?php

namespace App\Http\Controllers;

use App\Models\Administrador;
use App\Models\Enfermeiro_chefe;
use App\Models\Estagiario;
use App\Models\Responsavel;
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
        return view('/admin/menu');
    }

    public function log()
    {
        return view('/admin/log');
    }

    public function atribuicao()
    {
        return view('/admin/atribuicao');
    }

    public function permissao()
    {      
        return view('/admin/permissao');         
    }
    

    public function alterarPermissao()
    {
        return view('/admin/permissao');
    }


    public function backup()
    {
        return view('/admin/backup');
    }

    public function cadastro()
    {
        return view('/admin/cadastroUsuario');
    }

    public function remocao()
    {
        
        if (isset($_GET['usuario'])) {
            $cpf = $_GET['usuario'];            
            DB::table('usuarios')->where('CPF', $cpf)->delete();
            echo ("<script> alert('Removido com Sucesso'); </script>");            
            return view('/admin/remocaoUsuario');
        } else {
            return view('/admin/remocaoUsuario');
        }
    }
    
    public function salvarUsuario(Request $request){
        include("conexao.php");
   
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
    
      //se não existe cpf
      if($usuario = mysqli_fetch_assoc($existeCPF)){

        $ip = $request->ip();

       //insere na trabela usuário
        $novoUsuario = "INSERT INTO usuarios (CPF, Nome, Senha, Email, Data_Nasc, Atribuicao, Sexo, Ip) values ('$request->fcpf', 
        '$request->fnome', 12345, '$request->femail', '$request->fnascimento', '$request->fatribui','$request->fsexo','$ip')";
        mysqli_query($conn,$novoUsuario);
        
        if ($request->fatribui == 'Administrador'){
            //insere na tabela de administrador
            $novoAdm = "INSERT INTO administradores (CPF) values ('$request->fcpf')";
            mysqli_query($conn,$novoAdm);

        }else{
            //insere na tabela de responsáveis
            $novoRespon = "INSERT INTO responsaveis (CPF) values ('$request->fcpf')";
            mysqli_query($conn,$novoRespon);

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
        //FINALIZAR AQUI
        return redirect()->route('salvarUsuario')->with('success','Usuário cadastrado com sucesso!!');

        }
        else{
            //FINALIZAR AQUI


                //return redirect()->route('salvarUsuario')->with('error','Usuário já cadastrado no sistema!!');
                //return redirect() -> back() ->with('msg','Você não pode alterar o cargo de administradores!!!');

                return redirect()->route('salvarUsuario')->with('error','Erro ao cadastrar usuário!!');
        }
      }
     
    


    public function busca(Request $request)
    {

        $user = DB::table('usuarios')->where('CPF', $request->cpf_user)->first();

        return view('/admin/remocaoUsuario', ['user' => $user]);
    }
}
