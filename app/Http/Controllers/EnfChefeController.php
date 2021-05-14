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
        VerificaLoginController::verificarLogin();
        return view('/enfChefe/menu');
    }
    
    public function cadastroPlantonista(){
        include("db.php");
        VerificaLoginController::verificarLogin();
        if(isset($_SESSION['enfermeiroChefe'])){
            $sql = "SELECT * FROM permissao_cargo where permissao_id = '7'";
            $query = mysqli_query($connect,$sql);
            while($sql = mysqli_fetch_array($query)){
                if($sql['cargo_id'] == '2'){
                    $resultado = $sql['ativo'];
                }
            }
            if($resultado == "1"){
                return view('/enfChefe/cadastroPlantonista');
            }else{
                return redirect()->back()->with('msg-error','Você não tem acesso a essa pagina!!!');
            }
        }else if(isset($_SESSION['enfermeiro'])){
            $sql = "SELECT * FROM permissao_cargo where permissao_id = '7'";
            $query = mysqli_query($connect,$sql);
            while($sql = mysqli_fetch_array($query)){
                if($sql['cargo_id'] == '3'){
                    $resultado = $sql['ativo'];
                }
            }
            if($resultado == "1"){
                return view('/enfChefe/cadastroPlantonista');
            }else{
                return redirect()->back()->with('msg-error','Você não tem acesso a essa pagina!!!');
            }
        }else if(isset($_SESSION['estagiario'])){
            $sql = "SELECT * FROM permissao_cargo where permissao_id = '7'";
            $query = mysqli_query($connect,$sql);
            while($sql = mysqli_fetch_array($query)){
                if($sql['cargo_id'] == '4'){
                    $resultado = $sql['ativo'];
                }
            }
            if($resultado == "1"){
                return view('/enfChefe/cadastroPlantonista');
            }else{
                return redirect()->back()->with('msg-error','Você não tem acesso a essa pagina!!!');
            }
        }
       
    }

    public function cadastroMedicamento(){          //função para chamar a função salvar medicamento pela view
        VerificaLoginController::verificarLogin();
        include("db.php");
        if(isset($_SESSION['enfermeiroChefe'])){
            $sql = "SELECT * FROM permissao_cargo where permissao_id = '9'";
            $query = mysqli_query($connect,$sql);
            while($sql = mysqli_fetch_array($query)){
                if($sql['cargo_id'] == '2'){
                    $resultado = $sql['ativo'];
                }
            }
            if($resultado == "1"){
                return view('/enfChefe/cadastroMedicamento');
            }else{
                return redirect()->back()->with('msg-error','Você não tem acesso a essa pagina!!!');
            }
        }else if(isset($_SESSION['enfermeiro'])){
            $sql = "SELECT * FROM permissao_cargo where permissao_id = '9'";
            $query = mysqli_query($connect,$sql);
            while($sql = mysqli_fetch_array($query)){
                if($sql['cargo_id'] == '3'){
                    $resultado = $sql['ativo'];
                }
            }
            if($resultado == "1"){
                return view('/enfChefe/cadastroMedicamento');
            }else{
                return redirect()->back()->with('msg-error','Você não tem acesso a essa pagina!!!');
            }
        }else if(isset($_SESSION['estagiario'])){
            $sql = "SELECT * FROM permissao_cargo where permissao_id = '9'";
            $query = mysqli_query($connect,$sql);
            while($sql = mysqli_fetch_array($query)){
                if($sql['cargo_id'] == '4'){
                    $resultado = $sql['ativo'];
                }
            }
            if($resultado == "1"){
                return view('/enfChefe/cadastroMedicamento');
            }else{
                return redirect()->back()->with('msg-error','Você não tem acesso a essa pagina!!!');
            }
        }

    }

    public function salvarMedicamento(Request $request){
         include('conexao.php');
         session_start();
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
        VerificaLoginController::verificarLogin();
        include("db.php");
        if(isset($_SESSION['enfermeiroChefe'])){
            $sql = "SELECT * FROM permissao_cargo where permissao_id = '12'";
            $query = mysqli_query($connect,$sql);
            while($sql = mysqli_fetch_array($query)){
                if($sql['cargo_id'] == '2'){
                    $resultado = $sql['ativo'];
                }
            }
            if($resultado == "1"){
                return view('/enfChefe/cadastroAgendamento');
            }else{
                return redirect()->back()->with('msg-error','Você não tem acesso a essa pagina!!!');
            }
        }else if(isset($_SESSION['enfermeiro'])){
            $sql = "SELECT * FROM permissao_cargo where permissao_id = '12'";
            $query = mysqli_query($connect,$sql);
            while($sql = mysqli_fetch_array($query)){
                if($sql['cargo_id'] == '3'){
                    $resultado = $sql['ativo'];
                }
            }
            if($resultado == "1"){
                return view('/enfChefe/cadastroAgendamento');
            }else{
                return redirect()->back()->with('msg-error','Você não tem acesso a essa pagina!!!');
            }
        }else if(isset($_SESSION['estagiario'])){
            $sql = "SELECT * FROM permissao_cargo where permissao_id = '12'";
            $query = mysqli_query($connect,$sql);
            while($sql = mysqli_fetch_array($query)){
                if($sql['cargo_id'] == '4'){
                    $resultado = $sql['ativo'];
                }
            }
            if($resultado == "1"){
                return view('/enfChefe/cadastroAgendamento');
            }else{
                return redirect()->back()->with('msg-error','Você não tem acesso a essa pagina!!!');
            }
        }
        
    }

    public function listaPlantonistas(){
        VerificaLoginController::verificarLogin();
        include("db.php");
        if(isset($_SESSION['enfermeiroChefe'])){
            $sql = "SELECT * FROM permissao_cargo where permissao_id = '14'";
            $query = mysqli_query($connect,$sql);
            while($sql = mysqli_fetch_array($query)){
                if($sql['cargo_id'] == '2'){
                    $resultado = $sql['ativo'];
                }
            }
            if($resultado == "1"){
                return view('/enfChefe/listagemPlantonistas');
            }else{
                return redirect()->back()->with('msg-error','Você não tem acesso a essa pagina!!!');
            }
        }else if(isset($_SESSION['enfermeiro'])){
            $sql = "SELECT * FROM permissao_cargo where permissao_id = '14'";
            $query = mysqli_query($connect,$sql);
            while($sql = mysqli_fetch_array($query)){
                if($sql['cargo_id'] == '3'){
                    $resultado = $sql['ativo'];
                }
            }
            if($resultado == "1"){
                return view('/enfChefe/listagemPlantonistas');
            }else{
                return redirect()->back()->with('msg-error','Você não tem acesso a essa pagina!!!');
            }
        }else if(isset($_SESSION['estagiario'])){
            $sql = "SELECT * FROM permissao_cargo where permissao_id = '14'";
            $query = mysqli_query($connect,$sql);
            while($sql = mysqli_fetch_array($query)){
                if($sql['cargo_id'] == '4'){
                    $resultado = $sql['ativo'];
                }
            }
            if($resultado == "1"){
                return view('/enfChefe/listagemPlantonistas');
            }else{
                return redirect()->back()->with('msg-error','Você não tem acesso a essa pagina!!!');
            }
        }
        
    }

    public function responsaveis(){
        VerificaLoginController::verificarLogin();
        include("db.php");
        if(isset($_SESSION['enfermeiroChefe'])){
            $sql = "SELECT * FROM permissao_cargo where permissao_id = '16'";
            $query = mysqli_query($connect,$sql);
            while($sql = mysqli_fetch_array($query)){
                if($sql['cargo_id'] == '2'){
                    $resultado = $sql['ativo'];
                }
            }
            if($resultado == "1"){
                return view('/enfChefe/listaResponsaveis');
            }else{
                return redirect()->back()->with('msg-error','Você não tem acesso a essa pagina!!!');
            }
        }else if(isset($_SESSION['enfermeiro'])){
            $sql = "SELECT * FROM permissao_cargo where permissao_id = '16'";
            $query = mysqli_query($connect,$sql);
            while($sql = mysqli_fetch_array($query)){
                if($sql['cargo_id'] == '3'){
                    $resultado = $sql['ativo'];
                }
            }
            if($resultado == "1"){
                return view('/enfChefe/listaResponsaveis');
            }else{
                return redirect()->back()->with('msg-error','Você não tem acesso a essa pagina!!!');
            }
        }else if(isset($_SESSION['estagiario'])){
            $sql = "SELECT * FROM permissao_cargo where permissao_id = '16'";
            $query = mysqli_query($connect,$sql);
            while($sql = mysqli_fetch_array($query)){
                if($sql['cargo_id'] == '4'){
                    $resultado = $sql['ativo'];
                }
            }
            if($resultado == "1"){
                return view('/enfChefe/listaResponsaveis');
            }else{
                return redirect()->back()->with('msg-error','Você não tem acesso a essa pagina!!!');
            }
        }
    }

    public function listaAgendamentos(){
        VerificaLoginController::verificarLogin();
        include("db.php");
        if(isset($_SESSION['enfermeiroChefe'])){
            $sql = "SELECT * FROM permissao_cargo where permissao_id = '15'";
            $query = mysqli_query($connect,$sql);
            while($sql = mysqli_fetch_array($query)){
                if($sql['cargo_id'] == '2'){
                    $resultado = $sql['ativo'];
                }
            }
            if($resultado == "1"){
                return view('/enfChefe/agendamentos');
            }else{
                return redirect()->back()->with('msg-error','Você não tem acesso a essa pagina!!!');
            }
        }else if(isset($_SESSION['enfermeiro'])){
            $sql = "SELECT * FROM permissao_cargo where permissao_id = '15'";
            $query = mysqli_query($connect,$sql);
            while($sql = mysqli_fetch_array($query)){
                if($sql['cargo_id'] == '3'){
                    $resultado = $sql['ativo'];
                }
            }
            if($resultado == "1"){
                return view('/enfChefe/agendamentos');
            }else{
                return redirect()->back()->with('msg-error','Você não tem acesso a essa pagina!!!');
            }
        }else if(isset($_SESSION['estagiario'])){
            $sql = "SELECT * FROM permissao_cargo where permissao_id = '15'";
            $query = mysqli_query($connect,$sql);
            while($sql = mysqli_fetch_array($query)){
                if($sql['cargo_id'] == '4'){
                    $resultado = $sql['ativo'];
                }
            }
            if($resultado == "1"){
                return view('/enfChefe/agendamentos');
            }else{
                return redirect()->back()->with('msg-error','Você não tem acesso a essa pagina!!!');
            }
        }
        
    }

    public function prontuario(){
        VerificaLoginController::verificarLogin();
        include("db.php");
        if(isset($_SESSION['enfermeiroChefe'])){
            $sql = "SELECT * FROM permissao_cargo where permissao_id = '18'";
            $query = mysqli_query($connect,$sql);
            while($sql = mysqli_fetch_array($query)){
                if($sql['cargo_id'] == '2'){
                    $resultado = $sql['ativo'];
                }
            }
            if($resultado == "1"){
                return view('/enfChefe/prontuario');
            }else{
                return redirect()->back()->with('msg-error','Você não tem acesso a essa pagina!!!');
            }
        }else if(isset($_SESSION['enfermeiro'])){
            $sql = "SELECT * FROM permissao_cargo where permissao_id = '18'";
            $query = mysqli_query($connect,$sql);
            while($sql = mysqli_fetch_array($query)){
                if($sql['cargo_id'] == '3'){
                    $resultado = $sql['ativo'];
                }
            }
            if($resultado == "1"){
                return view('/enfChefe/prontuario');
            }else{
                return redirect()->back()->with('msg-error','Você não tem acesso a essa pagina!!!');
            }
        }else if(isset($_SESSION['estagiario'])){
            $sql = "SELECT * FROM permissao_cargo where permissao_id = '18'";
            $query = mysqli_query($connect,$sql);
            while($sql = mysqli_fetch_array($query)){
                if($sql['cargo_id'] == '4'){
                    $resultado = $sql['ativo'];
                }
            }
            if($resultado == "1"){
                return view('/enfChefe/prontuario');
            }else{
                return redirect()->back()->with('msg-error','Você não tem acesso a essa pagina!!!');
            }
        }
    }

    public function cadastroLeito(){
        VerificaLoginController::verificarLogin();
        include("db.php");
        if(isset($_SESSION['enfermeiroChefe'])){
            $sql = "SELECT * FROM permissao_cargo where permissao_id = '29'";
            $query = mysqli_query($connect,$sql);
            while($sql = mysqli_fetch_array($query)){
                if($sql['cargo_id'] == '2'){
                    $resultado = $sql['ativo'];
                }
            }
            if($resultado == "1"){
                return view('/enfChefe/cadastroLeito');
            }else{
                return redirect()->back()->with('msg-error','Você não tem acesso a essa pagina!!!');
            }
        }else if(isset($_SESSION['enfermeiro'])){
            $sql = "SELECT * FROM permissao_cargo where permissao_id = '29'";
            $query = mysqli_query($connect,$sql);
            while($sql = mysqli_fetch_array($query)){
                if($sql['cargo_id'] == '3'){
                    $resultado = $sql['ativo'];
                }
            }
            if($resultado == "1"){
                return view('/enfChefe/cadastroLeito');
            }else{
                return redirect()->back()->with('msg-error','Você não tem acesso a essa pagina!!!');
            }
        }else if(isset($_SESSION['estagiario'])){
            $sql = "SELECT * FROM permissao_cargo where permissao_id = '29'";
            $query = mysqli_query($connect,$sql);
            while($sql = mysqli_fetch_array($query)){
                if($sql['cargo_id'] == '4'){
                    $resultado = $sql['ativo'];
                }
            }
            if($resultado == "1"){
                return view('/enfChefe/cadastroLeito');
            }else{
                return redirect()->back()->with('msg-error','Você não tem acesso a essa pagina!!!');
            }
        }
        
    }

}
