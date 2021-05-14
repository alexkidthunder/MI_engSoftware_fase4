<?php

namespace App\Http\Controllers;

use App\Models\Medicamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use mysqli;

class EnfChefeController extends Controller
{
    public function menu(){
        VerificaLoginController::verificarLoginEnfC();
        return view('/enfChefe/menu');
    }
    
    public function cadastroPlantonista(){
        VerificaLoginController::verificarLoginEnfC();
        return view('/enfChefe/cadastroPlantonista');
    }

    public function cadastroMedicamento(){          //função para chamar a função salvar medicamento pela view
        VerificaLoginController::verificarLoginEnfC();
        return view('/enfChefe/cadastroMedicamento');
    }

    public function salvarMedicamento(Request $request){
         include('conexao.php');

        //buscar medicamento
        $existeMed = mysqli_query($conn,"SELECT COUNT(*) FROM medicamentos WHERE Nome_Medicam = '$request->fnome'");

        //se não existir o medicamento
        if(mysqli_fetch_assoc($existeMed)['COUNT(*)'] == 0){
            //gera um código aleatório
            $cod = rand (00000, 99999);
            
            //cria medicamento e adiciona
            $novoMed = "INSERT INTO medicamentos (Nome_Medicam, Quantidade, Fabricante, Data_Validade, Codigo) values
            ('$request->fnome', '$request->fquantidade', '$request->ffabricante', '$request->fnascimento', '$cod')";
            mysqli_query($conn,$novoMed);
            
            return redirect()->route('cadastroMedicamento')->with('success', "Novo medicamento adicionado!");
        }else{
            //se existir o medicamento cadastrado
            return redirect()->route('cadastroMedicamento')->with('error', "Medicamento já cadastrado!!");
        }
        
    }

    public function cadastroAgendamento(){
        VerificaLoginController::verificarLoginEnfC();
        return view('/enfChefe/cadastroAgendamento');
    }

    public function listaPlantonistas(){
        VerificaLoginController::verificarLoginEnfC();
        return view('/enfChefe/listagemPlantonistas');
    }

    public function responsaveis(){
        VerificaLoginController::verificarLoginEnfC();
        return view('/enfChefe/listaResponsaveis');
    }

    public function listaAgendamentos(){
        VerificaLoginController::verificarLoginEnfC();
        return view('/enfChefe/agendamentos');
    }

    public function prontuario(){
        VerificaLoginController::verificarLoginEnfC();
        return view('/enfChefe/prontuario');
    }

    public function cadastroLeito(){
        VerificaLoginController::verificarLoginEnfC();
        return view('/enfChefe/cadastroLeito');
    }

}
