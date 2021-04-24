<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function menu()
    {
        return view('/admin/menu-adm');
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

    public function busca(Request $request)
    {

        $user = DB::table('usuarios')->where('CPF', $request->cpf_user)->first();

        return view('/admin/remocaoUsuario', ['user' => $user]);
    }
}
