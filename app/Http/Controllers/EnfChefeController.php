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
        }else if(isset($_SESSION['enfermeiro'])){
            $sql = "SELECT * FROM permissao_cargo where permissao_id = '14'";
            $query = mysqli_query($connect,$sql);
            while($sql = mysqli_fetch_array($query)){
                if($sql['cargo_id'] == '3'){
                    $resultado = $sql['ativo'];
                }
            }
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
        }else if(isset($_SESSION['estagiario'])){
            $sql = "SELECT * FROM permissao_cargo where permissao_id = '14'";
            $query = mysqli_query($connect,$sql);
            while($sql = mysqli_fetch_array($query)){
                if($sql['cargo_id'] == '4'){
                    $resultado = $sql['ativo'];
                }
            }
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

    public function listaAgendamentos(){ //LISTAGEM DE AGENDAMENTOS E MEDICAMENTOS
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
        }else if(isset($_SESSION['enfermeiro'])){
            $sql = "SELECT * FROM permissao_cargo where permissao_id = '15'";
            $query = mysqli_query($connect,$sql);
            while($sql = mysqli_fetch_array($query)){
                if($sql['cargo_id'] == '3'){
                    $resultado = $sql['ativo'];
                }
            }
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
        }else if(isset($_SESSION['estagiario'])){
            $sql = "SELECT * FROM permissao_cargo where permissao_id = '15'";
            $query = mysqli_query($connect,$sql);
            while($sql = mysqli_fetch_array($query)){
                if($sql['cargo_id'] == '4'){
                    $resultado = $sql['ativo'];
                }
            }
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
                //return view('/enfChefe/cadastroLeito');
            }else{
                return redirect()->back()->with('msg-error','Você não tem acesso a essa página!!!');
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
                //return view('/enfChefe/cadastroLeito');
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
                //return view('/enfChefe/cadastroLeito');
            }else{
                return redirect()->back()->with('msg-error','Você não tem acesso a essa pagina!!!');
            }
        }

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
    }

<<<<<<< Updated upstream
    public function cadastrarLeito(Request $request){
=======
    public function cadastrarLeito(Request $request)
    {               //cadastro de leito
>>>>>>> Stashed changes
        include("db.php");
        $sql = "SELECT * FROM leitos WHERE Identificacao = '$request->Leito'";
        $query = mysqli_query($connect, $sql);
<<<<<<< Updated upstream
        if(mysqli_num_rows($query) == 0){
            $sql1 = "INSERT INTO leitos (Identificacao,Ocupado) values ('$request->Leito','0')";
            $query1 = mysqli_query($connect, $sql1);
        }else{
            return redirect()->route('cadastroLeito')->with('error','Leito já cadastrado!'); 
        }

        return view('/enfChefe/cadastroLeito');
=======

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

>>>>>>> Stashed changes

            //se já estiver cadastrado    
        } else {
            return redirect()->route('cadastroLeito')->with('msg-error', 'Leito já cadastrado!');
        }
    }

    public function removerLeito(Request $request)
    {
        include("db.php");
<<<<<<< Updated upstream
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

=======
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

>>>>>>> Stashed changes
}
