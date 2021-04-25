<?php

namespace App\Http\Controllers;

use App\Models\Administrador;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{

    public function menu(){
        return view('/admin/menu');
    }

    public function log(){
        return view('/admin/log');
    }

    public function atribuicao(){
        return view('/admin/atribuicao');
    }

    public function permissao(){
        return view('/admin/permissao');
    }

    public function backup(){
        return view('/admin/backup');
    }

    public function cadastro(){
        return view('/admin/cadastroUsuario');
    }

    public function remocao(){
        return view('/admin/remocaoUsuario');
    }
    
    public function salvarUsuario(Request $request){
        $existeCPF = Usuario::find($request->fcpf);                  //busca de cpf
        
        if($existeCPF)   //se encontrar
             return redirect()->route('salvarUsuario')->with('error', "CPF já existente!");
 
        $validator = Validator::make($request->all(), [   //validação de erro
             'CPF' => 'required|min:11|max:14',
        ]);
 
        if ($validator->fails()) {
            return redirect()->route('salvarUsuario')->with('error', 
            "Verifique se você preencheu todos os campos!");   //redirecionando o usuario após erro 
         }
 
        Usuario::Create([
            'CPF' => $request->fcpf,
            'Nome' => $request->fnome,
            'Senha' => Hash::make('password'),
            'Email' => $request->femail,
            'Data_Nasc' => $request->fnascimento,
            'Atribuicao' => $request->fatribui,
            'Sexo' => $request->fsexo,
            'Ip' =>$request->ip(), 

            ]);

        $atribuicao = $request->fatribui;
        
        if ($atribuicao == 'Administrador'){
            Administrador::Create([
                'CPF' => $request->fcpf,
            ]);
            
        }  
        
             
         
     }
}
