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

    /**
     * Função que Lista os Plantonistas e opções de manipular os checkbox 
     */
    public function cadastroPlantonista()
    {
        include("db.php");
        VerificaLoginController::verificarLogin();
        $resultado = VerificaLoginController::verificaPermissao(7);
        if ($resultado == "1") {

            // recebendo os plantonistas           
            $sql = "SELECT * FROM enfermeiros";
            $query1 = mysqli_query($connect, $sql);
            $sql1 = "SELECT * FROM estagiarios";
            $query2 = mysqli_query($connect, $sql1);
            $i = 0;
            $plantonistas = null;

            //atualizando plantões dos enfermeiros
            while ($dado = mysqli_fetch_array($query1)) {

                $dado['Plantao'] == 0 ? $dado['Plantao'] = 'unchecked' : $dado['Plantao'] = 'checked';
                $cpfAux = $dado['CPF'];
                $queryAux = mysqli_query($connect, "SELECT * FROM usuarios WHERE CPF = '$cpfAux'");
                $usuario = mysqli_fetch_array($queryAux);
                $dado['Nome'] = $usuario['Nome'];
                $dado['Cargo'] = "Enfermeiro";
                $plantonistas[$i] = $dado;
                $i++;
            }
            //atualizando plantões dos estagiários
            while ($dado = mysqli_fetch_array($query2)) {

                $dado['Plantao'] == 0 ? $dado['Plantao'] = 'unchecked' : $dado['Plantao'] = 'checked';
                $cpfAux = $dado['CPF'];
                $queryAux = mysqli_query($connect, "SELECT * FROM usuarios WHERE CPF = '$cpfAux'");
                $usuario = mysqli_fetch_array($queryAux);
                $dado['Nome'] = $usuario['Nome'];
                $dado['Cargo'] = "Estagiário";

                $plantonistas[$i] = $dado;
                $i++;
            }
            /*
            //log
            $ip = $_SERVER["REMOTE_ADDR"];
            $acao = "Cadastrou plantonista $request->fnome";     //add nome      
            AdminController::salvarLog($acao, $ip);*/

            return view('/enfChefe/cadastroPlantonista', ['plantonistas' => $plantonistas]);
        } else {
            return redirect()->back()->with('msg-error', 'Você não tem acesso a essa pagina!!!');
        }
    }


    /**
     * Função que atualiza o status dos plantonistas
     */
    public function cadastrarPlantonistas(Request $request)
    {
        include("db.php");
        //Buscar os plantonistas do banco
        $sql = "SELECT * FROM enfermeiros";
        $query1 = mysqli_query($connect, $sql);
        $sql1 = "SELECT * FROM estagiarios";
        $query2 = mysqli_query($connect, $sql1);
        // Plantonistas on vindo da view
        $plantonistas = $request->all();

        //setando os enfermeiros
        while ($dado = mysqli_fetch_array($query1)) {
            $cpfPlantonista = $dado['CPF'];
            $cpfView = str_replace('.', '_', $cpfPlantonista);
            //dd(isset($plantonistas[$cpfView])); 
            if (isset($plantonistas[$cpfView])) {

                $update = "UPDATE enfermeiros set Plantao = '1' where CPF = '$cpfPlantonista'";
                mysqli_query($connect, $update);
            } else {
                $update2 = "UPDATE enfermeiros set Plantao = '0' where CPF = '$cpfPlantonista'";
                mysqli_query($connect, $update2);
            }
        }
        // setando os estagiários
        while ($dado = mysqli_fetch_array($query2)) {
            $cpfPlantonista = $dado['CPF'];
            $cpfView = str_replace('.', '_', $cpfPlantonista);
            if (isset($plantonistas[$cpfView])) {
                $update = "UPDATE estagiarios set Plantao = '1' where CPF = '$cpfPlantonista'";
                mysqli_query($connect, $update);
            } else {;
                $update2 = "UPDATE estagiarios set Plantao = '0' where CPF = '$cpfPlantonista'";
                mysqli_query($connect, $update2);
            }
        }

        return redirect()->route('cadastroPlantonista')->with('msg-sucess', "Plantões Alterados com sucesso");
    }

    public function cadastroMedicamento()
    {          //função para chamar a função salvar medicamento pela view
        VerificaLoginController::verificarLogin();
        $resultado = VerificaLoginController::verificaPermissao(9);
        if ($resultado == "1") {
            return view('/enfChefe/cadastroMedicamento');
        } else {
            return redirect()->back()->with('msg-error', 'Você não tem acesso a essa pagina!!!');
        }
    }

    public function salvarMedicamento(Request $request)
    {
        include('db.php');
        session_start();
        //buscar medicamento
        $existeMed = mysqli_query($connect, "SELECT COUNT(*) FROM medicamentos WHERE Nome_Medicam = '$request->fnome'");

        //se não existir o medicamento
        if (mysqli_fetch_assoc($existeMed)['COUNT(*)'] == 0) {

            //gera um código aleatório
            $cod = rand(00000, 9999999999);

            //cria medicamento e adiciona
            $novoMed = "INSERT INTO medicamentos (Nome_Medicam, Quantidade, Fabricante, Data_Validade, Codigo) values
            ('$request->fnome', '$request->fquantidade', '$request->ffabricante', '$request->fvalidade', '$cod')";
            mysqli_query($connect, $novoMed);

            //log
            $ip = $_SERVER["REMOTE_ADDR"];
            $acao = "Cadastrou medicamento $request->fnome";
            AdminController::salvarLog($acao, $ip);

            return redirect()->route('cadastroMedicamento')->with('success', "Novo medicamento adicionado!");
        } else {
            //se existir o medicamento cadastrado
            return redirect()->route('cadastroMedicamento')->with('error', "Medicamento já cadastrado!!");
        }
    }

    public function cadastroAgendamento()
    {
        VerificaLoginController::verificarLogin();
        $resultado = VerificaLoginController::verificaPermissao(12);
        if ($resultado == "1") {

            /*
            //log
            $ip = $_SERVER["REMOTE_ADDR"];
            $acao = "Criou um agendamento de medicamento";           
            AdminController::salvarLog($acao, $ip);
            */

            return view('/enfChefe/cadastroAgendamento');
        } else {
            return redirect()->back()->with('msg-error', 'Você não tem acesso a essa pagina!!!');
        }
    }

    /**
     * Método que busca um paciente para o cadastro de agendamento
     */
    public function buscarPacienteAg(Request $request){
        include("db.php");
        VerificaLoginController::verificarLogin();
        $resultado = VerificaLoginController::verificaPermissao(12);
        
        if ($resultado == "1") {

        // pacientes e prontuários
        $sql = "SELECT * FROM prontuarios WHERE Cpfpaciente = '$request->cpf_user'";
        $sql1 = "SELECT * FROM pacientes WHERE CPF = '$request->cpf_user'";
        $query = mysqli_query($connect, $sql); //prontuarios
        $query1 = mysqli_query($connect, $sql1); // pacientes     
       
        
          // verifica se o paciente existe     
        if(mysqli_num_rows($query1) > 0 ){  
            $paciente2 = mysqli_fetch_array($query1); 
        }else{
            return redirect()->back()->with('msg-error', 'Paciente não encontrado');
        }              


        // VERIFICAR SE EXISTE UM PRONTUÁRIO ABERTO PARA O PACIENTE
        while($dado = mysqli_fetch_array($query)){
            
            if($dado['aberto'] == 1 ){ // caso tenha prontuários em aberto
                // PREPARAR DADOS DO PACIENTE PARA A VIEW
                $dado['Nome_Paciente'] = $paciente2['Nome_Paciente'];
                $paciente = $dado; 
                // FIM DADOS DO PACIENTE

        // COMO O PACIENTE EXISTE, AGORA PREPARA OS PLANTONISTAS PARA SER ENVIADS JUNTOS AO PACIENTE PARA A VIEW
               $sql2 = "SELECT * FROM enfermeiros WHERE Plantao = '1'";
               $sql21 = "SELECT * FROM estagiarios WHERE Plantao = '1'";      
               $sql3 = "SELECT * FROM usuarios WHERE Atribuicao = 'Enfermeiro' OR 'Estagiario'";
               
               $query2 = mysqli_query($connect, $sql2);
               $query21 = mysqli_query($connect, $sql21);
               $query3 = mysqli_query($connect, $sql3);
               $i = 0;
               
               // SELECIONANDO PLANTONISTAS COM ESTADO: EM PLANTÃO = 1
               while($dado = mysqli_fetch_array($query2)){                              
                    $plantonistas[$i] = $dado;
                    $i++;                   
               }

               while($dado = mysqli_fetch_array($query21)){                              
                $plantonistas[$i] = $dado;
                $i++;                   
              }

               

               $i = 0;       
               //agrupando usuários
               while($aux =  mysqli_fetch_array($query3) ){
                   $usuarios[$i] = $aux;
                   $i++;
               }
       
               // passando o nome dos usuarios para Plantonistas
               $i = 0;
                foreach($plantonistas as $plantonista){

                   foreach($usuarios as $usuario){ 
                       if(strcmp($plantonista['CPF'], $usuario['CPF'] ) == 0 ){ // se o cpf bater pega o nome                        
                        $plantonista['Nome_Plantonista'] = $usuario['Nome'];
                        $plantonistas[$i] = $plantonista;
                        $i++;                        
                       }
                   }

               }
              
               //FIM AGRUPAMENTOS DOS PLANTONISTAS
              
            // RECEBER OS MEDICAMENTOS
            $sql5 = "SELECT * FROM medicamentos";
            $query5 = mysqli_query($connect, $sql5);
            $medicamentos = null;
            $i = 0;
            while($medicamento = mysqli_fetch_array($query5)){
             $medicamentos[$i] = $medicamento;
             $i++;
            }
               
            return view('/enfChefe/cadastroAgendamento',['paciente' => $paciente, 'plantonistas'=>$plantonistas,
               'medicamentos'=>$medicamentos]);
            }

        }

        return redirect()->back()->with('msg-error', 'Não existe prontuário em aberto para esse paciente!');
        
        }else {
            return redirect()->back()->with('msg-error', 'Você não tem acesso a essa pagina!!!');
        }
    
}


    /**
     * Método que CADASTRA um agendamento
     */
    public function cadastrarAgendamento(Request $request){
        include('db.php');
        VerificaLoginController::verificarLogin();
        $resultado = VerificaLoginController::verificaPermissao(12);
        if($resultado == 1){   
        
        
        // verificar se medicamento existe
        $sql = "SELECT * FROM medicamentos WHERE Nome_Medicam = '$request->medicamento_agendamento'";
        $query1 = mysqli_query($connect,$sql);
     
        if(mysqli_num_rows($query1) == 0){ // medicamento n existe
            return redirect()->back()->with('msg-error', 'Medicamento não cadastrado em nosso sistema, verifique se digitou corretamente!');   
        }
        $medicamento = mysqli_fetch_array($query1);
   
          
      
        
        // buscar os agendamentos do aplicador para checar o choque de horários
        if($request->aplicador_agendamento != null){
        // buscar dados do aplicador
        $sql2 = "SELECT * FROM usuarios WHERE Nome= '$request->aplicador_agendamento'";
        $query2 = mysqli_query($connect, $sql2); 
        if(mysqli_num_rows($query2) == 0){
            return redirect()->back()->with('msg-error', 'Aplicador não encontrado');            
        }    
        $usuario = mysqli_fetch_array($query2);
        

        $Cpf_Aplicador = $usuario['CPF'];
        $str_hora = "$request->horario_agendamento:00";
        $sql3 = "SELECT * FROM agendamentos WHERE CPF_usuario = '$Cpf_Aplicador'";
        $query3 = mysqli_query($connect, $sql3);
        while($agendamento = mysqli_fetch_array($query3)){
            if($agendamento['Realizado'] == 0){
                if(strtotime($agendamento['Data_Agend']) == strtotime($request->data_agendamento)){                     
                   if( (abs(strtotime($agendamento['Hora_Agend']) - strtotime($str_hora) ) / 60)  <= 5 ){ 
                       // se a diferença de tempo das datas for em um intervalo de 5 minutos retorna choque de horários                    
                      return redirect()->back()->with('msg-error', 'O aplicador já possui um agendamento nessa data e horário');
                   }
                }
            }
        }

    }else{
        $usuario = null;
    }

        // Pegar o prontuário do paciente
         $sql4 = "SELECT * FROM prontuarios WHERE Cpfpaciente = '$request->Cpf_Paciente'";
         $query4 = mysqli_query($connect, $sql4);
         $prontuario = null;
         while($dado = mysqli_fetch_array($query4)){
            if($dado['aberto']){
                $prontuario = $dado;
            }
         }
         

        //dados para o cadastro do agendamento
         $str_hora = "$request->horario_agendamento:00";       
         $id_prontuario = $prontuario['ID'];
         $codigo_medicamento = $medicamento['Codigo'];
         //verificar se o agendamento não está duplicado
         $sql6 = "SELECT * FROM agendamentos WHERE ID_Prontuario = '$id_prontuario'";
         $query6 = mysqli_query($connect, $sql6);
         while($agnd = mysqli_fetch_array($query6)){
             if($agnd['Cod_medicamento'] == $codigo_medicamento && $agnd['Data_Agend'] == $request->data_agendamento
                && $agnd['Hora_Agend'] == $str_hora && $agnd['Posologia'] == $request->posologia_agendamento){
                    return redirect()->back()->with('msg-error', 'Já existe um agendamento idêntico a esse para essa date e horário');
                }
         }



         // verifica se o agendamento é em aberto ou possuí aplicador
         if($usuario != null){
         $cpf_usuario = $usuario['CPF'];
         $sql5 = "INSERT INTO `agendamentos` (`Codigo`, `Posologia`, `Data_Agend`, `Realizado`, `Hora_Agend`, `ID_prontuario`, `CPF_usuario`, `Cod_medicamento`) VALUES (NULL, '$request->posologia_agendamento', '$request->data_agendamento', '0'  , '$str_hora' , '$id_prontuario' , '$cpf_usuario', '$codigo_medicamento' ) "; 
         }else{
             $cpf_usuario = NULL;
             $sql5 = "INSERT INTO `agendamentos` (`Codigo`, `Posologia`, `Data_Agend`, `Realizado`, `Hora_Agend`, `ID_prontuario`, `CPF_usuario`, `Cod_medicamento`) VALUES (NULL, '$request->posologia_agendamento', '$request->data_agendamento', '0'  , '$str_hora' , '$id_prontuario' , NULL, '$codigo_medicamento' ) "; 
         }         
      
   
        $query5 = mysqli_query($connect, $sql5);
         
        if($query5 == true){
            return redirect()->route('cadastroAgendamento')->with('msg-sucess', 'Agendamento cadastrado com sucesso!');
        }else{
            return redirect()->back()->with('msg-error', 'ocorreu algum erro com o banco de dados ao efetuar o cadastro');
        }
        
     }else{    
            return redirect()->back()->with('msg-error', 'Você não tem acesso a essa pagina!!!');
     }
    }

    public function listaPlantonistas() //listagem dos plantonistas ativos
    {
        VerificaLoginController::verificarLogin();
        $resultado = VerificaLoginController::verificaPermissao(14); // checando se enfermeiro chefe tem permissão de acesso
        include("db.php");
        if ($resultado == "1") { //se sim procura por todos os enfermeiros e estagiario de planta(Coluna Plantao = 1)
            //primeira busca e adicção de enfermeiro ao vetor de plantonistas
            $sql = "SELECT * FROM enfermeiros where Plantao = '1'";
            $query = mysqli_query($connect, $sql);
            $i = 0;
            while ($sql = mysqli_fetch_array($query)) {
                $cpf = $sql['CPF'];
                $sql1 = "SELECT * FROM usuarios where CPF = '$cpf'";
                $query1 = mysqli_query($connect, $sql1);
                while ($sql1 = mysqli_fetch_array($query1)) {
                    $plantonista['nome' . $i] = $sql1['Nome'];
                    $plantonista['cargo' . $i] = $sql1['Atribuicao'];
                }
                $i++;
            }
            //Depois estagiario 
            $sql = "SELECT * FROM estagiarios where Plantao = '1'";
            $query = mysqli_query($connect, $sql);
            while ($sql = mysqli_fetch_array($query)) {
                $cpf = $sql['CPF'];
                $sql1 = "SELECT * FROM usuarios where CPF = '$cpf'";
                $query1 = mysqli_query($connect, $sql1);
                while ($sql1 = mysqli_fetch_array($query1)) {
                    $plantonista['nome' . $i] = $sql1['Nome'];
                    $plantonista['cargo' . $i] = $sql1['Atribuicao'];
                }
                $i++;
            }
            return view('/enfChefe/listagemPlantonistas', ['plantonista' => $plantonista]); // retorna vetor com nome e cargo dos platonistas para view 
        } else {
            return redirect()->back()->with('msg-error', 'Você não tem acesso a essa pagina!!!'); // se não tiver acesso volta para pagina anterior
        }
    }

    public function responsaveis() // listagem de responsaveis pela aplicação do medicamento
    {
        VerificaLoginController::verificarLogin(); // verifica se usuario esta logado 
        include("db.php");
        $resultado = VerificaLoginController::verificaPermissao(16);  // verifica se usuario tem permissão 
        if ($resultado == "1") {
            $i = 0;
            $infos = [];
            $sql = "SELECT * FROM agendamentos";
            $query = mysqli_query($connect, $sql); // se sim obtem os dados dos agendamentos do baco 
            $verificaN = mysqli_num_rows($query); 
            if ($verificaN > 0) { // verifica se encontrou algum 
                while ($sql = mysqli_fetch_array($query)) {
                    if ($sql['CPF_usuario'] != null) { // verifica se tem alguem responsavel pelo agendamento 
                        //Pegando dados necessarios 
                        $medicamento = $sql['Cod_medicamento'];
                        $prontuario = $sql['ID_prontuario'];
                        $responsavel = $sql['CPF_usuario'];
                        $infos['hora' . $i] = $sql['Hora_Agend'];
                        $infos['data' . $i] = $sql['Data_Agend'];
                        $infos['posologia' . $i] = $sql['Posologia'];
                        //usando codigo do medicamento nos agendmentos para obter o nome do mesmo 
                        $sql1 = "SELECT * FROM medicamentos WHERE Codigo = '$medicamento'";
                        $query1 = mysqli_query($connect, $sql1);
                        while ($sql1 = mysqli_fetch_array($query1)) {
                            $infos['medicamento' . $i] = $sql1['Nome_Medicam'];
                        }
                        // usando id do prontuario dos agendamento para obter leito e o cpf do paciente para qual o agendamento foi indicado
                        $sql2 = "SELECT * FROM prontuarios WHERE ID = '$prontuario'";
                        $query2 = mysqli_query($connect, $sql2);
                        while ($sql2 = mysqli_fetch_array($query2)) {
                            $identificaP = $sql2['Cpfpaciente'];
                            $infos['leito' . $i] = $sql2['Id_leito'];
                            $infos['id' . $i] = $sql2['ID'];
                        }
                        //Usando cpf do paciente para obter nome do mesmo
                        $sql3 = "SELECT * FROM pacientes WHERE CPF = '$identificaP'";
                        $query3 = mysqli_query($connect, $sql3);
                        while ($sql3 = mysqli_fetch_array($query3)) {
                            $infos['paciente' . $i] = $sql3['Nome_Paciente'];
                        }
                        // usando cpf do responsavel para obter nome do mesmo
                        $sql4 = "SELECT * FROM usuarios WHERE CPF = '$responsavel'";
                        $query4 = mysqli_query($connect, $sql4);
                        while ($sql4 = mysqli_fetch_array($query4)) {
                            $infos['responsavel' . $i] = $sql4['Nome'];
                        }
                        $i++;
                    }
                }
                return view('/enfChefe/listaResponsaveis', ['infos' => $infos, 'identificaP' => $identificaP]); // retorna vetor com dados necessarios e o cpf do paciente para view respectivamente
            }else {
                return redirect()->back()->with('msg-error', 'Nenhuma informação encontrada na base de dados!!!'); // msg caso não exista dados cadastrados
            }
        } else {
            return redirect()->back()->with('msg-error', 'Você não tem acesso a essa pagina!!!'); // msg caso você não tnha permissão 
        }
    }

    public function listaAgendamentos()
    {            //LISTAGEM DE AGENDAMENTOS E MEDICAMENTOS
        VerificaLoginController::verificarLogin(); // verifica se ta logado 
        include("db.php");
        $resultado = VerificaLoginController::verificaPermissao(15); // verifica se tem permissão 
        if ($resultado == "1") {
            $i = 0;
            $infos = [];
            $sql = "SELECT * FROM agendamentos";
            $query = mysqli_query($connect, $sql);
            $verificaN = mysqli_num_rows($query);
            //Obtem todos os agendamentos do banco 
            if ($verificaN > 0) { // verifica se existiam cadastrados 
                while ($sql = mysqli_fetch_array($query)) {
                    //obtem informações necessarias percorrendo as tabelas
                    $medicamento = $sql['Cod_medicamento'];
                    $prontuario = $sql['ID_prontuario'];
                    $infos['hora' . $i] = $sql['Hora_Agend'];
                    $infos['data' . $i] = $sql['Data_Agend'];
                    $infos['posologia' . $i] = $sql['Posologia'];
                    $sql1 = "SELECT * FROM medicamentos WHERE Codigo = '$medicamento'";
                    $query1 = mysqli_query($connect, $sql1);
                    while ($sql1 = mysqli_fetch_array($query1)) {
                        $infos['medicamento' . $i] = $sql1['Nome_Medicam'];
                    }
                    $sql2 = "SELECT * FROM prontuarios WHERE ID = '$prontuario'";
                    $query2 = mysqli_query($connect, $sql2);
                    while ($sql2 = mysqli_fetch_array($query2)) {
                        $identificaP = $sql2['Cpfpaciente'];
                        $infos['leito' . $i] = $sql2['Id_leito'];
                        $infos['id' . $i] = $sql2['ID'];
                    }
                    $sql3 = "SELECT * FROM pacientes WHERE CPF = '$identificaP'";
                    $query3 = mysqli_query($connect, $sql3);
                    while ($sql3 = mysqli_fetch_array($query3)) {
                        $infos['paciente' . $i] = $sql3['Nome_Paciente'];
                    }
                    $infos['identificaP' . $i] = $identificaP;
                    $i++;
                }
                return view('/enfChefe/agendamentos', ['infos' => $infos]); //retorna dados para view 
            }else {
                return redirect()->back()->with('msg-error', 'Nenhuma informação encontrada na base de dados!!!'); // caso não exista nada cadastrado
            }
        } else {
            return redirect()->back()->with('msg-error', 'Você não tem acesso a essa pagina!!!'); // caso não tenha permissão
        }
    }

    public function cadastroLeito()
    {                        //exibe os leitos na página
        VerificaLoginController::verificarLogin();
        include("db.php");
        $resultado = VerificaLoginController::verificaPermissao(29);

        // buscar leitos para exibir na página
        if ($resultado == "1") {
            $sql = "SELECT * FROM leitos";
            $query = mysqli_query($connect, $sql);
            $i = 0;

            //preenche array de leitos
            while ($dado = mysqli_fetch_array($query)) {
                if ($dado["Ocupado"] == 0) {
                    $dado["Ocupado"] = "Vazio";
                } else {
                    $dado["Ocupado"] = "Ocupado";
                }
                $leitos[$i] = $dado;
                $i++;
            }
            return view('/enfChefe/cadastroLeito', ['leitos' => $leitos]);
        } else {
            return redirect()->back()->with('msg-error', 'Você não tem acesso a essa pagina!!!');
        }
    }


    public function cadastrarLeito(Request $request)
    {               //cadastro de leito

        VerificaLoginController::verificarLogin();
        include("db.php");
        $resultado = VerificaLoginController::verificaPermissao(29);

        if($resultado == 1){
     

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


    }else{
        return redirect()->back()->with('msg-error', 'Você não tem acesso a essa pagina!!!'); 
    }
    }

    public function removerLeito(Request $request)
    {
        session_start();
        include("db.php");

        $perm = VerificaLoginController::verificaPermissao(30);
        if ($perm == "1") {
            $sql = "SELECT * FROM leitos WHERE Identificacao = '$request->focorrencia'";
            $query = mysqli_query($connect, $sql);
            if (mysqli_num_rows($query) == 1) {

                  // verifica se o leito está ocupado
                $leito = mysqli_fetch_array($query);
                if($leito['Ocupado'] == 1){
                    return redirect()->back()->with('msg-error', 'Você não pode remover um leito ocupado');
                }

                // Query de remoção SQL
                $sql1 = "DELETE FROM leitos WHERE Identificacao = '$request->focorrencia'";
                $query1 = mysqli_query($connect, $sql1);
                if ($query1 == 1) {
                    // se sucesso ao deletar
                    return redirect()->route('cadastroLeito')->with('msg-sucess', 'Leito removido com sucesso!');
                } else {
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

    public function verificarPermissao($cargoId, $permissaoId)
    {
        include('db.php');

        //busca no banco de dados
        $sql = "SELECT *FROM permissao_cargo WHERE permissao_id = permissaoId";
        $query = mysqli_query($connect, $sql);

        if ($cargoId == 2) {
            while ($sql = mysqli_fetch_array($query)) {
                if ($sql['Cargo_id'] = '2') {
                    $resultado = $sql['ativo'];
                }
            }
            $resultado == 1 ? $saida = 2 : $saida = 0;
        } else if ($cargoId == 3) {
            while ($sql = mysqli_fetch_array($query)) {
                if ($sql['Cargo_id'] = '3') {
                    $resultado = $sql['ativo'];
                }
            }
            $resultado == 1 ? $saida = 3 : $saida = 0;
        } else if ($cargoId == 4) {
            while ($sql = mysqli_fetch_array($query)) {
                if ($sql['Cargo_id'] = '4') {
                    $resultado = $sql['ativo'];
                }
            }
            $resultado == 1 ? $saida = 4 : $saida = 0;
        }
        return $saida;
    }
}
