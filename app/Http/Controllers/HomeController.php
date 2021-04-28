<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view('login');
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

    public function cadastroPaciente(){
        return view('cadastroPaciente');
    }

    public function esqueciSenha(){
        return view('esqueciSenha');
    }
}
