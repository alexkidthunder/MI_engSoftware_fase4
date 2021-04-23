<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

}
