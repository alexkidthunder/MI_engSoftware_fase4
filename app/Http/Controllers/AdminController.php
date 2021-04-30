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
        
        //busca o cpf
        $existeCPF = DB::table('usuarios')->where('CPF', $request->fcpf)->first();    
           
        //se já existir o cpf
        if($existeCPF)   
             return redirect()->route('salvarUsuario')->with('error', "CPF já existente!");
       
        //validação de erro
        $validator = Validator::make($request->all(), [     
            'CPF' => 'required|min:14|max:14',
       ]);
        
       //redirecionando o usuario após erro 
        if ($validator->fails()) {
           return redirect()->route('salvarUsuario')->with('error', "Digite um CPF válido!!");   
         }      
         
        //se não existir cpf, cria usuário
         Usuario::Create([
            'CPF' => $request->fcpf,
            'Nome' => $request->fnome,
            'Senha' => '12345',                                 //exemplo de senha
            //'Senha' => bcrypt($request->fsenha);               // PARA ALTERAR A SENHA, NÃO SALVAR COMO RECEBE
            //Hash::make('password'),                                               VERIFICAR TAMANHO DE SENHA
            'Email' => $request->femail,
            'Data_Nasc' => $request->fnascimento,
            'Atribuicao' => $request->fatribui,
            'Sexo' => $request->fsexo,
            'Ip' => $request->ip(), 
            ]);        
         
        //Adiciona usuário em tabelas correspondentes ao cargo
        if ($request->fatribui == 'Administrador'){
            Administrador::Create([
                'CPF' => $request->fcpf,
            ]);
        }else{
            Responsavel::Create([
                'CPF' => $request->fcpf,
            ]);
            
            if ($request->fatribui == 'Enfermeiro Chefe') {
                Enfermeiro_chefe::Create([
                    'CPF' => $request->fcpf,
                    'COREN' => '01-AC00024',   //TROCAR ISSO
                ]);
            }
            else if ($request->fatribui == 'Enfermeiro') {
                Enfermeiro::Create([
                    'CPF' => $request->fcpf,
                    'COREN' => '01-SP00100',   //TROCAR ISSO
                    'Plantao' => '1',           //TROCAR ISSO
                ]); 
            }else if ($request->fatribui == 'Estagiario') {
                Estagiario::Create([
                    'CPF' => $request->fcpf,
                    'Plantao' => '0',           //TROCAR ISSO
                ]);
            }   
        }         
         
        return redirect()->route('salvarUsuario')->with('success','Usuário cadastrado com sucesso!!');
     }

    public function busca(Request $request)
    {

        $user = DB::table('usuarios')->where('CPF', $request->cpf_user)->first();

        return view('/admin/remocaoUsuario', ['user' => $user]);
    }
}
