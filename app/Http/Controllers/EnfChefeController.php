<?php

namespace App\Http\Controllers;

use App\Models\Medicamento;
use App\Http\Controller\HomeController;
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
            
            // recebendo os plantonistas           
            $sql = "SELECT * FROM enfermeiros";
            $query1 = mysqli_query($connect, $sql);
            $sql1 = "SELECT * FROM estagiarios";            
            $query2 = mysqli_query($connect, $sql1);


            /*
            //log
            $ip = $_SERVER["REMOTE_ADDR"];
            $acao = "Cadastrou plantonista $request->fnome";     //add nome      
            AdminController::salvarLog($acao, $ip);
*/


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
         include('db.php');
         session_start();
        //buscar medicamento
        $existeMed = mysqli_query($connect,"SELECT COUNT(*) FROM medicamentos WHERE Nome_Medicam = '$request->fnome'");

        //se não existir o medicamento
        if(mysqli_fetch_assoc($existeMed)['COUNT(*)'] == 0){

            //gera um código aleatório
            $cod = rand (00000, 9999999999);

            //cria medicamento e adiciona
            $novoMed = "INSERT INTO medicamentos (Nome_Medicam, Quantidade, Fabricante, Data_Validade, Codigo) values
            ('$request->fnome', '$request->fquantidade', '$request->ffabricante', '$request->fvalidade', '$cod')";
            mysqli_query($connect,$novoMed);
            
            //log
            $ip = $_SERVER["REMOTE_ADDR"];
            $acao = "Cadastrou medicamento $request->fnome";           
            AdminController::salvarLog($acao, $ip);

            
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



            /*
            //log
            $ip = $_SERVER["REMOTE_ADDR"];
            $acao = "Criou um agendamento de medicamento";           
            AdminController::salvarLog($acao, $ip);
            */

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
            $i = 0;
        $infos = [];
        $sql = "SELECT * FROM agendamentos";
        $query = mysqli_query($connect,$sql);
        while($sql = mysqli_fetch_array($query)){
            if($sql['CPF_usuario'] != null){
                $medicamento = $sql['Cod_medicamento'];
                $prontuario = $sql['ID_prontuario'];
                $responsavel = $sql['CPF_usuario'];
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
                    $infos['id'.$i] = $sql2['ID'];
                }
                $sql3 = "SELECT * FROM pacientes WHERE CPF = '$identificaP'";
                $query3 = mysqli_query($connect,$sql3);
                while($sql3 = mysqli_fetch_array($query3)){
                    $infos['paciente'.$i] = $sql3['Nome_Paciente'];
                }
                $sql4 = "SELECT * FROM usuarios WHERE CPF = '$responsavel'";
                $query4 = mysqli_query($connect,$sql4);
                while($sql4 = mysqli_fetch_array($query4)){
                    $infos['responsavel'.$i] = $sql4['Nome'];
                }
                $i++;
            }
        }
            return view('/enfChefe/listaResponsaveis',['infos' => $infos, 'identificaP'=>$identificaP]);
        }else{
            return redirect()->back()->with('msg-error','Você não tem acesso a essa pagina!!!');
        }
    }

    public function listaAgendamentos(){            //LISTAGEM DE AGENDAMENTOS E MEDICAMENTOS
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
                    $infos['id'.$i] = $sql2['ID'];
                }
                $sql3 = "SELECT * FROM pacientes WHERE CPF = '$identificaP'";
                $query3 = mysqli_query($connect,$sql3);
                while($sql3 = mysqli_fetch_array($query3)){
                    $infos['paciente'.$i] = $sql3['Nome_Paciente'];
                }
                $infos['identificaP'.$i] = $identificaP;
                $i++;
            }
            return view('/enfChefe/agendamentos',['infos' => $infos]);
        }else{
            return redirect()->back()->with('msg-error','Você não tem acesso a essa pagina!!!');
        }
              
    }

    public function cadastroLeito(){                        //exibe os leitos na página
        VerificaLoginController::verificarLogin();
        include("db.php");
        $resultado = VerificaLoginController::verificaPermissao(29);

        // buscar leitos para exibir na página
        if($resultado == "1"){
           $sql = "SELECT * FROM leitos";
           $query = mysqli_query($connect, $sql);          
           $i = 0;

           //preenche array de leitos
           while($dado = mysqli_fetch_array($query)){                               
                if($dado["Ocupado"] == 0){
                    $dado["Ocupado"] = "Vazio";
                }else{
                    $dado["Ocupado"] = "Ocupado";
                }                
                $leitos[$i] = $dado; 
                $i++;
           }           
           return view('/enfChefe/cadastroLeito', ['leitos'=> $leitos]);
        } 
        else{
            return redirect()->back()->with('msg-error','Você não tem acesso a essa pagina!!!');
        }       
    }


    public function cadastrarLeito(Request $request){               //cadastro de leito

        include("db.php");

        //busca no banco de dados
        $sql = "SELECT * FROM leitos WHERE Identificacao = '$request->Leito'";
        $query = mysqli_query($connect, $sql);

        //caso não esteja já cadastrado no sistema
        if (mysqli_num_rows($query) == 0) {
            $sql1 = "INSERT INTO leitos (Identificacao,Ocupado) values ('$request->Leito','0')";
            $query1 = mysqli_query($connect, $sql1);
            if ($query1 == 1) {
                // cadastrado com sucesso
                //log
                $ip = $_SERVER["REMOTE_ADDR"];
                $acao = "Cadastrou novo leito";
                AdminController::salvarLog($acao, $ip);

                return redirect()->route('cadastroLeito')->with('msg-sucess', 'Leito cadastrado com sucesso!');
            } else {
                // erro no BD
                return redirect()->route('cadastroLeito')->with('msg-error', 'Ocorreu um erro, tente novamente'); 
            }

            //se já estiver cadastrado    
        } else {
            return redirect()->route('cadastroLeito')->with('msg-error', 'Leito já cadastrado!');
        }
    }

    public function removerLeito(Request $request)
    {
        include("db.php");

        $perm = VerificaLoginController::verificaPermissao(30);
        if ($perm == "1") {
            $sql = "SELECT * FROM leitos WHERE Identificacao = '$request->focorrencia'";
            $query = mysqli_query($connect, $sql);
            if (mysqli_num_rows($query) == 1) {
                $sql1 = "DELETE FROM leitos WHERE Identificacao = '$request->focorrencia'";
                $query1 = mysqli_query($connect, $sql1);
                if($query1 == 1 ){
                    // se sucesso ao deletar
                    return redirect()->route('cadastroLeito')->with('msg-sucess', 'Leito removido com sucesso!');
                }else{
                    // erro no banco de dados
                    return redirect()->route('cadastroLeito')->with('msg-error', 'Ocorreu um erro, tente novamente');
                }
                
            } else {
                // se não existir o leito
                return redirect()->route('cadastroLeito')->with('msg-error', 'Leito não encontrado!');
            }
        } else {
            return redirect()->back();
        }
    }

    public function verificarPermissao($cargoId, $permissaoId){
        include('db.php');

        //busca no banco de dados
        $sql="SELECT *FROM permissao_cargo WHERE permissao_id = permissaoId";
        $query = mysqli_query($connect,$sql);
  
        if($cargoId == 2){
            while($sql=mysqli_fetch_array($query)){
            if($sql['Cargo_id']='2'){
                $resultado= $sql['ativo'];
            }
        }
        $resultado == 1?$saida=2:$saida=0;
        }
        else if($cargoId == 3){
            while($sql=mysqli_fetch_array($query)){
                if($sql['Cargo_id']='3'){
                $resultado= $sql['ativo'];
            }
        }
        $resultado == 1?$saida=3:$saida=0;
        }
        else if($cargoId == 4){
            while($sql=mysqli_fetch_array($query)){
                if($sql['Cargo_id']='4'){
                    $resultado= $sql['ativo'];
                }
            }
            $resultado == 1?$saida=4:$saida=0;
        }
        return $saida;
        }

}
