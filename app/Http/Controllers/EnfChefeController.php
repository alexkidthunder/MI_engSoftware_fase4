<?php

namespace App\Http\Controllers;

use App\Models\Medicamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use mysqli;

class EnfChefeController extends Controller
{
   /* public function menu(){
        VerificaLoginController::verificarLogin();
        return view('/enfChefe/menu');
    }*/
    
    public function cadastroPlantonista(){
        include("db.php");
        VerificaLoginController::verificarLogin();
        $resultado = VerificaLoginController::verificaPermissao(7);
        if($resultado == "1"){
            return view('/enfChefe/cadastroPlantonista');
        }else{
            return redirect()->back()->with('msg-error','Você não tem acesso a essa pagina!!!');
        }
       
    }

    public function cadastroMedicamento(){          //função para chamar a função salvar medicamento pela view
        VerificaLoginController::verificarLogin();
        $resultado = VerificaLoginController::verificaPermissao(9);
        if($resultado == "1"){
            return view('/enfChefe/cadastroMedicamento');
        }else{
            return redirect()->back()->with('msg-error','Você não tem acesso a essa pagina!!!');
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
        $resultado = VerificaLoginController::verificaPermissao(12);
        if($resultado == "1"){
            return view('/enfChefe/cadastroAgendamento');
        }else{
            return redirect()->back()->with('msg-error','Você não tem acesso a essa pagina!!!');
        }
        
    }

    public function listaPlantonistas(){
        VerificaLoginController::verificarLogin();
        $resultado = VerificaLoginController::verificaPermissao(14);
        include("db.php");
        if($resultado == "1"){
            $sql = "SELECT * FROM enfermeiros where Plantao = '1'";
            $query = mysqli_query($connect,$sql);
            $i = 0;
            while($sql = mysqli_fetch_array($query)){
                $cpf = $sql['CPF'];
                $sql1 = "SELECT * FROM usuarios where CPF = '$cpf'";
                $query1 = mysqli_query($connect,$sql1);
                while($sql1 = mysqli_fetch_array($query1)){
                    $plantonista['nome'.$i] = $sql1['Nome'];
                    $plantonista['cargo'.$i] = $sql1['Atribuicao'];
                }
                $i++;
            }
            $sql = "SELECT * FROM estagiarios where Plantao = '1'";
            $query = mysqli_query($connect,$sql);
            while($sql = mysqli_fetch_array($query)){
                $cpf = $sql['CPF'];
                $sql1 = "SELECT * FROM usuarios where CPF = '$cpf'";
                $query1 = mysqli_query($connect,$sql1);
                while($sql1 = mysqli_fetch_array($query1)){
                    $plantonista['nome'.$i] = $sql1['Nome'];
                    $plantonista['cargo'.$i] = $sql1['Atribuicao'];
                }
                $i++;
            }
            return view('/enfChefe/listagemPlantonistas',['plantonista' => $plantonista]);
        }else{
            return redirect()->back()->with('msg-error','Você não tem acesso a essa pagina!!!');
        }
        
    }

    public function responsaveis(){
        VerificaLoginController::verificarLogin();
        include("db.php");
        $resultado = VerificaLoginController::verificaPermissao(16);
        if($resultado == "1"){
            return view('/enfChefe/listaResponsaveis');
        }else{
            return redirect()->back()->with('msg-error','Você não tem acesso a essa pagina!!!');
        }
    }

    public function listaAgendamentos(){ //LISTAGEM DE AGENDAMENTOS E MEDICAMENTOS
        VerificaLoginController::verificarLogin();
        include("db.php");
        $resultado = VerificaLoginController::verificaPermissao(15);
        if($resultado == "1"){
            $i = 0;
            $infos = [];
            $sql = "SELECT * FROM agendamentos";
            $query = mysqli_query($connect,$sql);
            while($sql = mysqli_fetch_array($query)){
                $medicamento = $sql['Cod_medicamento'];
                $prontuario = $sql['ID_prontuario'];
                $infos['hora'.$i] = $sql['Hora_Agend'];
                $infos['data'.$i] = $sql['Data_Agend'];
                $infos['posologia'.$i] = $sql['Posologia'];
                $sql1 = "SELECT * FROM medicamentos WHERE Codigo = '$medicamento'";
                $query1 = mysqli_query($connect,$sql1);
                while($sql1 = mysqli_fetch_array($query1)){
                    $infos['medicamento'.$i] = $sql1['Nome_Medicam'];
                }
                $sql2 = "SELECT * FROM prontuarios WHERE ID = '$prontuario'";
                $query2 = mysqli_query($connect,$sql2);
                while($sql2 = mysqli_fetch_array($query2)){
                    $identificaP = $sql2['Cpfpaciente'];
                    $infos['leito'.$i] = $sql2['Id_leito'];
                }
                $sql3 = "SELECT * FROM pacientes WHERE CPF = '$identificaP'";
                $query3 = mysqli_query($connect,$sql3);
                while($sql3 = mysqli_fetch_array($query3)){
                    $infos['paciente'.$i] = $sql3['Nome_Paciente'];
                }

                $i++;
            }
            return view('/enfChefe/agendamentos',['infos' => $infos]);
        }else{
            return redirect()->back()->with('msg-error','Você não tem acesso a essa pagina!!!');
        }
              
    }

    public function cadastroLeito(){
        VerificaLoginController::verificarLogin();
        include("db.php");
        $resultado = VerificaLoginController::verificaPermissao(29);
        // buscar leitos para exibir na página
        if($resultado == "1"){
           $sql = "SELECT * FROM leitos";
           $query = mysqli_query($connect, $sql);          
           $i = 0;
           while($dado = mysqli_fetch_array($query)){
                $leitos[$i] = $dado["Identificacao"];
                if($dado["Ocupado"] == 0){
                    $statusLeito[$i] = "Vazio";
                }else{
                    $statusLeito[$i] = "Ocupado";
                }
                
                $i++;
           }
           return view('/enfChefe/cadastroLeito', ['leitos'=> $leitos, 'statusLeito'=>$statusLeito]);
        } 
        else{
            return redirect()->back()->with('msg-error','Você não tem acesso a essa pagina!!!');
        }       
    }

    public function cadastrarLeito(Request $request){
        include("db.php");
        $sql = "SELECT * FROM leitos WHERE Identificacao = '$request->Leito'";
        $query = mysqli_query($connect, $sql);
        if(mysqli_num_rows($query) == 0){
            $sql1 = "INSERT INTO leitos (Identificacao,Ocupado) values ('$request->Leito','0')";
            $query1 = mysqli_query($connect, $sql1);
        }else{
            return redirect()->route('cadastroLeito')->with('error','Leito já cadastrado!'); 
        }

        return view('/enfChefe/cadastroLeito');

    }

    public function removerLeito(Request $request){
        include("db.php");
        $sql = "SELECT * FROM leitos WHERE Identificacao = '$request->focorrencia'";
        $query = mysqli_query($connect, $sql);
        if(mysqli_num_rows($query) == 1){
            $sql1 = "DELETE FROM WHERE Identificacao = '$request->focorrencia'";
            $query1 = mysqli_query($connect, $sql1);
        }else{
            return redirect()->route('cadastroLeito')->with('error','Leito não encontrado!'); 
        }
        
        return view('/enfChefe/cadastroLeito'); 
    }

    Public function verificarPermissao(cargoId, permissaoId){

    Include('db.php');
    $sql="SELECT *FROM permissao_cargo WHERE permissao_id = permissaoId";
    $query = mysqli_query($connect,$sql);

    if(cargoId == 2){
       While($sql=mysql_fetch_array($query){
       if($sql['Cargo_id']='2'){
          $resultado= $sql['ativo'];
        }
       }
       $resultado == 1?$saida=2:$saida=0;
    }
    else if(cargoId == 3){
       While($sql=mysql_fetch_array($query){
            if($sql['Cargo_id']='3'){
              $resultado= $sql['ativo'];
            }
       }
       $resultado == 1?$saida=3:$saida=0;
    }
    else if(cargoId == 4){
        While($sql=mysql_fetch_array($query){
            if($sql['Cargo_id']='4'){
                $resultado= $sql['ativo'];
            }
        }
        $resultado == 1?$saida=4:$saida=0;
    }
    return $saida;
    }

}
