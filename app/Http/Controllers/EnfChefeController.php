<?php

namespace App\Http\Controllers;

use App\Models\Medicamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class EnfChefeController extends Controller
{
    public function menu(){
        return view('/enfChefe/menu');
    }
    
    public function cadastroPlantonista(){
        return view('/enfChefe/cadastroPlantonista');
    }

    public function cadastroMedicamento(Request $request){
/*
        //buscao medicamento
        $existeMed = DB::table('medicamentos')->where('Nome_Medicam', $request->fnome)->first();    
           
        //se já existir o cpf
        if($existeMed){


            
            return redirect()->route('cadastroMedicamento')->with('error', "Nova quantidade do medicamento adicionada!");
        }
        
        Medicamento::Create([
            'Nome_Medicam' => $request->fnome,
            'Quantidade' => $request->fquantidade,
            'Fabricante' => $request->ffabricante,
            'Data_Validade' => $request->fnascimento,
            'Codigo' => $request->fnascimento,
            ]);        
             
 */
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

    public function prontuario(){
        return view('/enfChefe/prontuario');
    }

    public function cadastroLeito(){
        return view('/enfChefe/cadastroLeito');
    }

}
