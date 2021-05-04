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
        
   
        //validação de erro de entrada
        $validator = Validator::make($request->all(), [     
            'fcpf' => 'required|min:14|max:14',
        ]);

        //redirecionando o usuario caso ocorra o erro
        if ($validator->fails()) {
            return redirect()->route('salvarUsuario')->with('error', "Digite um CPF válido!!");   
        }    

        //busca o cpf no banco de dados
        $existeCPF = DB::select('select * from usuarios where CPF = ?', [$request->fcpf]);

        //se já existir o cpf
        if($existeCPF)   
             return redirect()->route('salvarUsuario')->with('error', "CPF já existente!");
       
        //se não existir: insere na tabela usuários
        DB::insert('insert into usuarios (CPF, Nome, Senha, Email, Data_Nasc, Atribuicao, Sexo, Ip) values (?, ?, ?, ?, ?, ?, ?, ?)',
             [$request->fcpf, $request->fnome,'12345', $request->femail, $request->fnascimento, $request->fatribui,$request->fsexo,$request->ip()]);

        //Adiciona usuário em tabelas correspondentes ao cargo
        if ($request->fatribui == 'Administrador'){
            DB::insert('insert into administradores (CPF) values (?)', [$request->fcpf]);
        }else{
            DB::insert('insert into responsaveis (CPF) values (?)', [$request->fcpf]);

            if ($request->fatribui == 'Enfermeiro Chefe') {
                DB::insert('insert into enfermeiros_chefes (CPF,COREN) values (?,?)', [$request->fcpf,'BA 123.456.789']);
            }
            else if ($request->fatribui == 'Enfermeiro') {
                DB::insert('insert into enfermeiros (CPF,COREN,Plantao) values (?,?,?)', [$request->fcpf, 'BA 123.456.789','0']);
            }else if ($request->fatribui == 'Estagiario') {
                DB::insert('insert into estagiarios (CPF,Plantao) values (?,?)', [$request->fcpf,'0']);
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
