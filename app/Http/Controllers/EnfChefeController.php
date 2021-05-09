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
        include('conexao.php');

        //buscar medicamento
        $existeMed = mysqli_query($conn,"SELECT COUNT(*) FROM medicamentos WHERE Nome_Medicam = '$request->fnome'");
     
        //se não existir o medicamento
        if($medicamento = mysqli_fetch_assoc($existeMed)){
            $cod = rand ( 00000, 99999);
             $novoMed = "INSERT INTO medicamentos (Nome_Medicam, Quantidade, Fabricante, Data_Validade, Codigo) values
             ('$request->fnome', '$request->fquantidade', '$request->ffabricante', '$request->fnascimento', '$cod')";
            mysqli_query($conn,$novoMed);
            
            //return redirect()->route('cadastroMedicamento')->with('error', "Nova quantidade do medicamento adicionada!");
        }else{
            $buscaMed = mysqli_query($conn,"SELECT * FROM medicamentos WHERE Nome_Medicam LIKE: '$request->fnome'");
            dd($buscaMed);
        }

        
       


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

    public function historicoEntradaSaida(){
        return view('/enfChefe/historicoEntradaSaida');
    }

}
