<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function menu(){
        return view('menu-adm');
    }

    public function log(){
        return view('log');
    }

    public function atribuicao(){
        return view('atribuicao');
    }

    public function permissao(){
        return view('permissao');
    }

    public function backup(){
        return view('backup');
    }

    public function cadastro(){
        return view('cadastroUsuario');
    }

    public function remocao(){
        return view('remocaoUsuario');
    }

}
