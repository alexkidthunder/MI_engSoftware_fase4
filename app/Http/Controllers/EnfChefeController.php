<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EnfChefeController extends Controller
{
    public function menu(){
        return view('/enfChefe/menu');
    }
    public function cadastroPlantonista(){
        return view('cadastroPlantonista');
    }
    public function listagemPlantonista(){
        return view('listagemPlantonista');
    }

    public function cadastroPaciente(){
        return view('cadastroPaciente');
    }

    public function cadastroMedicamento(){
        return view('cadastroMedicamento');
    }

}
