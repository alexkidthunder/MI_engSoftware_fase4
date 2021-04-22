<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EnfChefeController extends Controller
{
    public function menu(){
        return view('/enfChefe/menu');
    }
    
    public function cadastroPlantonista(){
        return view('/enfChefe/cadastroPlantonista');
    }

    public function cadastroMedicamento(){
        return view('/enfChefe/cadastroMedicamento');
    }

    public function cadastroAgendamento(){
        return view('/enfChefe/cadastroAgendamento');
    }

    public function listaPlantonistas(){
        return view('/enfChefe/listagemPlantonistas');
    }

    public function responsaveis(){
        return view('/enfChefe/listaResponsaveis');
    }

    public function listaAgendamentos(){
        return view('/enfChefe/agendamentos');
    }

}
