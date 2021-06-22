<?php

namespace App\Http\Controllers;

use App\Models\Administrador;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\ElseIf_;
use PhpParser\Node\Stmt\Return_;

use function PHPUnit\Framework\isEmpty;

/**
 * Classe AdminController
 */
class AdminController extends Controller
{
  
    /**
     * Função de chamada de menu de adm
     *
     * @return view 
     */
    public function menu()
    {
        VerificaLoginController::verificarLoginAdmin();
        return view('/admin/menu');
    }

   
    /**
     * Função para listar log
     *
     * @return view 
     */
    public function log()
    {
        VerificaLoginController::verificarLoginAdmin();
        include("db.php");

        //busca logs para exibir na página
        $existeLog = "SELECT * FROM logs";
        $query = mysqli_query($connect, $existeLog);
        $i = 0;
        $logs = [];

        //preenche o array log com o elemento
        while ($elemento = mysqli_fetch_array($query)) {
            $logs[$i] = $elemento;
            $i++;
        }

        return view('/admin/log', ['logs' => $logs]);
    }

 
    /**
     * Função para salvar log  
     *
     * @param  mixed $acao
     * @param  mixed $ip
     * @return void
     */
    public static function salvarLog($acao, $ip)
    {
        include("db.php");

        date_default_timezone_set('America/Sao_Paulo');     //padrão de fuso horário
        $data = date('Y-m-d');                              //detecta data
        $horas = date('H:i:s');                               //detecta hora

        //insere no banco de dados
        $cpf = HomeController::obterCpf();
        $novoLog = "INSERT INTO logs (CPF,Data_Log, Hora_Agend, Ip, Acao) values ('$cpf','$data', '$horas', '$ip', '$acao')";
        mysqli_query($connect, $novoLog);
    }

  
    /**
     * Função para chamada de view de atribuição
     *
     * @return view
     */
    public function atribuicao()
    {
        VerificaLoginController::verificarLoginAdmin();
        return view('/admin/atribuicao');
    }


    /**
     * Função marcar as para permissões na tela    
     *
     * @param  mixed $request
     * @return view
     */
    public function permissao(Request $request)
    {
        VerificaLoginController::verificarLoginAdmin(); //verifica se o usuario tem permissão de acesso a pagina de acordo com o seu cargo

        include("db.php");
        $atribuicao = $request->atribuicao; // Obter atribuição da qual deseja mudar as permissões
        $p = [];
        //Sequencia de verificações de atribuições que executam os seguines passos em ordem
        if ($atribuicao == "admin") {
            $sql = "";
            $query = null;

            for ($i = 1; $i <= 35; $i++) { // repetição com o limite igual ao numero de permissões do bd
                $sql = "SELECT * FROM permissao_cargo where permissao_id = $i"; // sql para pegar permissão com determinado id
                $query = mysqli_query($connect, $sql); //pegando as permissões
                while ($sql = $query->fetch_array()) { // Percorre as tabelas como se fosse um array
                    if ($sql['cargo_id'] == 1) { // verificando se a permissão tem a mesma atribuição equivalente a atribuição obtida da view
                        $p[$i] = $sql['ativo'] ? 'checked' : 'unchecked'; // Operador ternario que ao ler permissão no bd se o ativo estiver marcado como true manda um comando para marcar a checkbox na view e se tiver como falso manda desmarcar
                    }
                }
            }
            return view('/admin/permissao', ['p' => $p]); //retorna o vetor de posições para a pagina com as checkbox detevidamente marcadas
        
        } elseif ($atribuicao == 'enfermeiroChefe') {
            $sql = "";
            $query = null;

            for ($i = 1; $i <= 35; $i++) {
                $sql = "SELECT * FROM permissao_cargo where permissao_id = $i";
                $query = mysqli_query($connect, $sql);
                while ($sql = $query->fetch_array()) {
                    if ($sql['cargo_id'] == 2) {
                        $p[$i] = $sql['ativo'] ? 'checked' : 'unchecked';
                    }
                }
            }
            return view('/admin/permissao', ['p' => $p]);
        
        } elseif ($atribuicao == 'enfermeiro') {
            $sql = "";
            $query = null;

            for ($i = 1; $i <= 35; $i++) {
                $sql = "SELECT * FROM permissao_cargo where permissao_id = $i";
                $query = mysqli_query($connect, $sql);
                while ($sql = $query->fetch_array()) {
                    if ($sql['cargo_id'] == 3) {
                        $p[$i] = $sql['ativo'] ? 'checked' : 'unchecked';
                    }
                }
            }
            return view('/admin/permissao', ['p' => $p]);

        } elseif ($atribuicao == 'estagiario') {
            $sql = "";
            $query = null;

            for ($i = 1; $i <= 35; $i++) {
                $sql = "SELECT * FROM permissao_cargo where permissao_id = $i";
                $query = mysqli_query($connect, $sql);
                while ($sql = $query->fetch_array()) {
                    if ($sql['cargo_id'] == 4) {
                        $p[$i] = $sql['ativo'] ? 'checked' : 'unchecked';
                    }
                }
            }
            return view('/admin/permissao', ['p' => $p]);

        } else {
            return view('/admin/permissao'); //caso não tenha nada selecionado retorna a view em branco
        }
    }
 
    /**
     * função para alterar permissão
     *
     * @param  mixed $request
     * @return redirect()->back()->with()
     */
    public function alterarPermissao(Request $request)
    {
        session_start(); //indica que existe uma sessão

        //pega atribuição exibida no link da pagina transformandoa num vetor
        $array = explode("=", $_SERVER['HTTP_REFERER']);
        $atribuicao = $array[count($array) - 1];

        include("db.php");
        //Sequencia de verificações de cargos
        if ($atribuicao != "admin") {// se o usuario não for um administrador
            if ($atribuicao == 'enfermeiroChefe') { // verifica o cargo que petence para saber qual é o id da primeira e da ultima permissão pertensente a ele.
                for ($i = 7; $i <= 35; $i++) {
                    if (isset($_GET['p' . $i])) { //verificando existencia de permissão no vetor
                        $update = "UPDATE permissao_cargo set ativo = '1' where id = $i"; //alterando estado da checkbox para cheked
                        mysqli_query($connect, $update);
                    } else {
                        $update = "UPDATE permissao_cargo set ativo = '0' where id = $i"; //alterando estado da checkbox para uncheked
                        mysqli_query($connect, $update);
                    }
                }

                //log
                $ip = $_SERVER["REMOTE_ADDR"];
                $acao = "Alterou permissões do enfermeiro chefe";
                AdminController::salvarLog($acao, $ip);

                return redirect()->back()->with('msg', "Permissões alteradas!!!!"); // retorna mensagem de sucesso na alteração de permissões

            } elseif ($atribuicao == 'enfermeiro') {
                for ($i = 36; $i < 65; $i++) {
                    if (isset($_GET['p' . ($i - 29)])) {
                        $update = "UPDATE permissao_cargo set ativo = '1' where id = $i";
                        mysqli_query($connect, $update);
                    } else {
                        $update = "UPDATE permissao_cargo set ativo = '0' where id = $i";
                        mysqli_query($connect, $update);
                    }
                }

                //log
                $ip = $_SERVER["REMOTE_ADDR"];
                $acao = "Alterou permissões do enfermeiro";
                AdminController::salvarLog($acao, $ip);

                return redirect()->back()->with('msg', "Permissões alteradas!!!!");

            } elseif ($atribuicao == 'estagiario') {
                for ($i = 65; $i < 94; $i++) {
                    if (isset($_GET['p' . ($i - 58)])) {
                        $update = "UPDATE permissao_cargo set ativo = '1' where id = $i";
                        mysqli_query($connect, $update);
                    } else {
                        $update = "UPDATE permissao_cargo set ativo = '0' where id = $i";
                        mysqli_query($connect, $update);
                    }
                }

                //log
                $ip = $_SERVER["REMOTE_ADDR"];
                $acao = "Alterou permissões do estagiário";
                AdminController::salvarLog($acao, $ip);

                return redirect()->back()->with('msg', "Permissões alteradas!!!!");
            }
        } else {
            return redirect()->back()->with('msg-error', 'Você não pode alterar permissões de administradores'); // caso tente alterar permissão de um administrador exibi mensagem de erro pois ela não pode ser alterada
        }
    }

   
    /**
     * Função para redirecionar para pagina de backup e mostrar os agendados
     *
     * @return view()
     */
    public function backup()
    {
        include("db.php");
        VerificaLoginController::verificarLoginAdmin(); // verificando se é um administrador que esta logado
        $info = [];
        $i = 0;
        $sql = "SELECT * FROM backups_agendados"; // comando para acessar tabela de backups agendados
        $query = mysqli_query($connect, $sql); //obtendo dados a partir da conexão com o banco
        while ($sql = mysqli_fetch_array($query)) { // percorre tabela como vetor
            //Trecho que obtem id, data, hora e se o backup é automatico alem do ip do usuario que o solicitou para exibir na pagina
            $info["id" . $i] = $sql['ID'];
            $info["data" . $i] = $sql['Data_backup'];
            $info["hora" . $i] = $sql['Hora_backup'];
            $info["ip" . $i] = $sql['ip'];
            $info["auto" . $i] = $sql['Automatico'];
            $i++;
        }
        return view('/admin/backup', ['info' => $info]); // retorna o vetor com os dados da pagina
    }


    /**
     * Função que remove um usuario do sistema
     *
     * @return view()
     */
    public function remocao()
    {
        include("db.php");

        VerificaLoginController::verificarLoginAdmin();

        if (isset($_GET['cpf'])) {
            $cpf = $_GET['cpf'];
            if (strcmp($_SESSION['administrador'], $cpf) == 0) {
                return redirect()->back()->with('msg-error', 'Você não pode remover sua própria conta!!');
            }

            $query = "DELETE FROM usuarios WHERE CPF = '$cpf'";

            $status = mysqli_query($connect, $query);

            $ip = $_SERVER["REMOTE_ADDR"];
            $acao = "Removeu usuário do sistema";
            AdminController::salvarLog($acao, $ip);

            return view('/admin/remocaoUsuario', ['status' => $status]);
        } else {
            return view('/admin/remocaoUsuario');
        }
    }

 
    /**
     * Função para alterar atribuição
     *
     * @param  mixed $request
     * @return redirect()->back()->with()
     */
    public function alterarAtribuicao(Request $request)
    {
        session_start();
        include("db.php");                      // Importando BD
        $request->validate([
            'novaAtribuicao' => 'required'      // Verificação de preenchimento de campo
        ]);
        $cpf = $request->cpf;                   // Obtendo CPF

        //Query para obter usuario com o CPF
        $sql = "SELECT * FROM usuarios where CPF='$cpf'";
        $query = mysqli_query($connect, $sql);


        //Percorrendo array com todos os usuarios com determinado cpf
        while ($sql = mysqli_fetch_array($query)) {
            $atribuicao = $sql["Atribuicao"];     // Obtem a atribuição do funcionario
            if ($atribuicao != "Estagiario") { // verifica se a atribuição selecionada na pagina é diferente de estagiario pois estagiario não tem coren
                //verifica para bter coren
                if ($atribuicao == "Enfermeiro") {
                    $sql2 = "SELECT * FROM enfermeiros where CPF='$cpf'"; //busca o funcionario na tabela de cargos equivalente ao dele
                    $query2 = mysqli_query($connect, $sql2);
                    while ($sql2 = mysqli_fetch_array($query2)) {
                        $coren = $sql2["COREN"]; // obtem o corem do funcionario
                    }
                } elseif ($atribuicao == "Enfermeiro Chefe") {
                    $sql2 = "SELECT * FROM enfermeiros_chefes where CPF='$cpf'";
                    $query2 = mysqli_query($connect, $sql2);
                    while ($sql2 = mysqli_fetch_array($query2)) {
                        $coren = $sql2["COREN"];
                    }
                    //para qualquer caso alem de enfermeiro ou enfemeiro chefe o coren é declarado como nulo para evitar falhas
                } else {
                    $coren = null;
                }
            } else {
                $coren = null;
            }
        }

        // Encontra a qual tabela o usuario pertence desde que não seja administrador
        if ($atribuicao != "Administrador") {
            if ($atribuicao == 'Enfermeiro Chefe') {
                if ($request->novaAtribuicao == "Enfermeiro") { // verifica para qual atribuição vai ser mudada
                    $delete = "DELETE FROM enfermeiros_chefes WHERE CPF='$cpf'";
                    mysqli_query($connect, $delete); // Deleta usuarios da tabela do cargo antigo
                    $update = "UPDATE usuarios SET Atribuicao = 'Enfermeiro' WHERE CPF='$cpf'";
                    mysqli_query($connect, $update); // atualiza a atribuicao no BD na tabela de usuarios
                    $insert = "INSERT INTO enfermeiros (CPF,COREN,Plantao) VALUES ('$cpf','$coren','false')";
                    mysqli_query($connect, $insert); // Adiciona usuario a tabela do novo cargo

                    //log
                    $ip = $_SERVER["REMOTE_ADDR"];
                    $acao = "Alterou cargo do enfermeiro para enfermeiro";
                    AdminController::salvarLog($acao, $ip);

                    return redirect()->back()->with('msg', 'Cargo alterado com sucesso!!!!'); //Redireciona para pagina anterior e mostra mensagem de erro
                } else {
                    return redirect()->back()->with('msg-error', 'Cargo selecionado invalido'); //Redireciona para pagina anterior e mostra mensagem de erro
                }
            } elseif ($atribuicao == 'Enfermeiro') {
                if ($request->novaAtribuicao == "Enfermeiro Chefe") {
                    $delete = "DELETE FROM enfermeiros WHERE CPF='$cpf'";
                    mysqli_query($connect, $delete); // Deleta usuarios
                    $update = "UPDATE usuarios SET Atribuicao = 'Enfermeiro Chefe' WHERE CPF='$cpf'";
                    mysqli_query($connect, $update); // atualiza a atribuicao no BD
                    $insert = "INSERT INTO enfermeiros_chefes (CPF,COREN) VALUES ('$cpf','$coren')";
                    mysqli_query($connect, $insert); // Adicioa usuario a novo cargo

                    //log
                    $ip = $_SERVER["REMOTE_ADDR"];
                    $acao = "Alterou cargo de enfermeiro para enfermeiro chefe";
                    AdminController::salvarLog($acao, $ip);

                    return redirect()->back()->with('msg', 'Cargo alterado com sucesso!!'); //Redireciona para pagina anterior e mostra mensagem de erro
                } else {
                    return redirect()->back()->with('msg-error', 'Cargo selecionado inválido!!'); //Redireciona para pagina anterior e mostra mensagem de erro
                }
            } elseif ($atribuicao == 'Estagiario') {
                if ($request->novaAtribuicao == "Enfermeiro") {
                    $delete = "DELETE FROM estagiarios WHERE CPF='$cpf'";
                    mysqli_query($connect, $delete); // Deleta usuarios
                    $update = "UPDATE usuarios SET Atribuicao = 'Enfermeiro' WHERE CPF='$cpf'";
                    mysqli_query($connect, $update); // atualiza a atribuicao no BD
                    $insert = "INSERT INTO enfermeiros (CPF,COREN,Plantao) VALUES ('$cpf','$request->fcoren','false')";
                    mysqli_query($connect, $insert); // Adicioa usuario a novo cargo

                    //log
                    $ip = $_SERVER["REMOTE_ADDR"];
                    $acao = "Alterou cargo de estagiário para enfermeiro";
                    AdminController::salvarLog($acao, $ip);

                    return redirect()->back()->with('msg', 'Cargo alterado com sucesso!!!'); //Redireciona para pagina anterior e mostra mensagem de erro
                } elseif ($request->novaAtribuicao == "Enfermeiro Chefe") {
                    $delete = "DELETE FROM estagiarios WHERE CPF='$cpf'";
                    mysqli_query($connect, $delete); // Deleta usuarios
                    $update = "UPDATE usuarios SET Atribuicao = 'Enfermeiro Chefe' WHERE CPF='$cpf'";
                    mysqli_query($connect, $update); // atualiza a atribuicao no BD
                    $insert = "INSERT INTO enfermeiros_chefes (CPF,COREN) VALUES ('$cpf','$request->fcoren')";
                    mysqli_query($connect, $insert); // Adicioa usuario a novo cargo


                    //log
                    $ip = $_SERVER["REMOTE_ADDR"];
                    $acao = "Alterou cargo de estagiário para enfermeiro chefe";
                    AdminController::salvarLog($acao, $ip);

                    return redirect()->back()->with('msg', 'Cargo alterado com sucesso!!!'); //Redireciona para pagina anterior e mostra mensagem de erro
                } else {
                    return redirect()->back()->with('msg-error', 'Cargo selecionado inválido!!'); //Redireciona para pagina anterior e mostra mensagem de erro
                }
            }
        } else {
            return redirect()->back()->with('msg-error', 'Você não pode alterar o cargo de administradores!!!'); //Redireciona para pagina anterior e mostra mensagem de erro
        }
    }
    
    /**
     * Função de busca
     *
     * @param  mixed $request
     * @return view
     */
    public function lupinha(Request $request)
    {
        session_start();
        include("db.php");                              // inclusão do banco de dados
        $user = null;                                   // garantia de existência da variavel

        // busca do usuario no banco de dados
        $sql = "SELECT * FROM usuarios where CPF = '$request->cpf_user'";
        $query = mysqli_query($connect, $sql);
        while ($sql = mysqli_fetch_array($query)) {       //percorrendo array de usuarios com determinado cpf
            $user = $sql;                               //retorno do usuario
        }

        /*garantido que usuario foi pego na busca*/
        if ($user != null) {
            if ($user["Atribuicao"] == "Enfermeiro Chefe") {
                $sql2 = "SELECT * FROM enfermeiros_chefes where CPF = '$request->cpf_user'";
                $query2 = mysqli_query($connect, $sql2);
                while ($sql2 = mysqli_fetch_array($query2)) { //percorrendo array de usuarios com determinado cpf
                    $user2 = $sql2;                         //retorno do usuario
                    return view('/admin/atribuicao', ['user' => $user], ['user2' => $user2]); // se encontrou retorna usuario para view
                }
            } elseif ($user["Atribuicao"] == "Enfermeiro") {
                $sql2 = "SELECT * FROM enfermeiros where CPF = '$request->cpf_user'";
                $query2 = mysqli_query($connect, $sql2);
                while ($sql2 = mysqli_fetch_array($query2)) { //percorrendo array de usuarios com determinado cpf
                    $user2 = $sql2;                         //retorno do usuario
                    return view('/admin/atribuicao', ['user' => $user], ['user2' => $user2]); // se encontrou retorna usuario para view
                }
            } else {
                return view('/admin/atribuicao', ['user' => $user]); // se encontrou retorna usuario para view
            }
        } else {
            return redirect()->back()->with('msg-error', 'CPF não cadastrado no sistema!!'); //Redireciona para pagina anterior e mostra mensagem de erro
        }
    }

   
    /**
     * Função para chamar a função salvar usuário pela view
     *
     * @return view()
     */
    public function cadastro()
    {
        VerificaLoginController::verificarLoginAdmin();
        return view('/admin/cadastroUsuario');
    }
    
    /**
     * Função para salvar usuário
     *
     * @param  mixed $request
     * @return redirect()->route()
     */
    public function salvarUsuario(Request $request)
    {
        session_start();
        include("db.php");

        //validação de erro de entrada
        $validator = Validator::make($request->all(), [
            'fcpf' => 'required|min:14|max:14',
        ]);

        //redirecionando o usuario caso ocorra o erro
        if ($validator->fails()) {
            return redirect()->route('salvarUsuario')->with('error', "Digite um CPF válido!!");
        }

        //busca de cpf no banco
        $existeCPF = mysqli_query($connect, "SELECT COUNT(*) FROM usuarios WHERE CPF = '$request->fcpf'");



        if (mysqli_fetch_assoc($existeCPF)['COUNT(*)'] == 0) {
            //detecta ip
            $ip = $request->ip();

            //detecta data
            date_default_timezone_set('America/Sao_Paulo');     
            $dataAtual = date('Y-m-d'); 

            //verifica erros de digitação
            if($request->fcpf=='000.000.000-00' and ($request->fnascimento <= $dataAtual)){
                return redirect()->route('cadastroPaciente')->with('error', "CPF inválido! Digite novamente.");
            }else if($request->fcpf=='000.000.000-00' and ($request->fnascimento > $dataAtual)){
                return redirect()->route('cadastroPaciente')->with('error', "CPF e data de nascimento inválidos! Digite novamente.");
            }else{
                
                if($request->fnascimento <= $dataAtual ){

                    //insere na tabela usuário
                    $novoUsuario = "INSERT INTO usuarios (CPF, Nome, Senha, Email, Data_Nasc, Atribuicao, Sexo, Ip, Ativo) values ('$request->fcpf', 
                    '$request->fnome', 12345, '$request->femail', '$request->fnascimento', '$request->fatribui','$request->fsexo','$ip',1)";
                    mysqli_query($connect, $novoUsuario);


                    //insere na tabela de administrador
                    if ($request->fatribui == 'Administrador') {
                        $novoAdm = "INSERT INTO administradores (CPF) values ('$request->fcpf')";
                        mysqli_query($connect, $novoAdm);
                    } else {
                        //insere na tabela de enfermeiro chefe
                        if ($request->fatribui == 'Enfermeiro Chefe') {
                            $novoEnfChefe = "INSERT INTO enfermeiros_chefes (CPF,COREN) values ('$request->fcpf','$request->fcoren')";
                            mysqli_query($connect, $novoEnfChefe);
                        }
                        //insere na tabela de enfermeiro
                        elseif ($request->fatribui == 'Enfermeiro') {
                            $novoEnf = "INSERT INTO enfermeiros (CPF,COREN,Plantao) values ('$request->fcpf', '$request->fcoren','false')";
                            mysqli_query($connect, $novoEnf);
                        }
                        //insere na tabela de estagiario
                        elseif ($request->fatribui == 'Estagiário') {
                            $novoEst = "INSERT INTO estagiarios (CPF,Plantao) values ('$request->fcpf','false')";
                            mysqli_query($connect, $novoEst);
                        }
                    }


                    $acao = "Cadastrou usuário $request->fnome";
                    $this->salvarLog($acao, $ip);

                    return redirect()->route('cadastrarUsuario')->with('success', 'Usuário cadastrado com sucesso!!');
                }
            }
         
        }else {
            //se o usuário já existir
            return redirect()->route('cadastrarUsuario')->with('error', 'Usuário já cadastrado!!');
    }
    }


    /**
     * Função que busca e retorna um usuario no banco de dados
     *
     * @param  mixed $request
     * @return view()
     */
    public function busca(Request $request)
    {
        session_start();
        include("db.php");
        $query = "SELECT * FROM usuarios WHERE CPF= '$request->cpf_user'";
        $result = mysqli_query($connect, $query);
        $user = mysqli_fetch_array($result);


        if ($user == null) {
            $user = 0;
            $atribuicao = 0;
        }

        if ($user != 0) {
            if (strcmp($user['Atribuicao'], "Enfermeiro") == 0) {
                $enfermeiro = mysqli_query($connect, "SELECT * FROM enfermeiros WHERE CPF= '$request->cpf_user'");
                $atribuicao = mysqli_fetch_array($enfermeiro);
            } elseif (strcmp($user['Atribuicao'], "Enfermeiro Chefe") == 0) {
                $enfermeiro_Chefe = mysqli_query($connect, "SELECT * FROM enfermeiros_chefes WHERE CPF= '$request->cpf_user'");
                $atribuicao = mysqli_fetch_array($enfermeiro_Chefe);
            } else {
                $atribuicao = 0;
            }
        }
        return view('/admin/remocaoUsuario', ['user' => $user, 'atribuicao' => $atribuicao]);
    }
  
    /**
     * Função de salvar backup do banco de dados
     *
     * @return redirect()->back()->with()
     */
    public static function salvarDB()
    {
        include("db.php");
        $tabelas = [];
        $sql = "SHOW TABLES"; // primeira linha do arquivo sql para exibir tabelas
        $query = mysqli_query($connect, $sql); //buscando sql
        while ($row = mysqli_fetch_row($query)) {
            $tabelas[] = $row[0]; //obtendo tabelas e adicionando ao vetor
        }
        $contador = 0;
        // Inicialização das variaveis do arquivo que vai ser escrito como string
        $resultado = "";
        $resultado1 = "";

        foreach (array_reverse($tabelas) as $iterador) { // iterando no vetor das tabelas do fim para o inicio para ler os codigos sql
            $sql1 = "SHOW CREATE TABLE " . $iterador; //concatenando linha lida com primeira linha da string sql
            $query1 = mysqli_query($connect, $sql1);
            $row = mysqli_fetch_row($query1);
            $vetor[$contador] = $row[1]; // obtendos novas tabelas e adicionando a vetor na posição do contador
            $contador++; // incremento de contador
        }
        //Trecho que muda as posições da tabelas no vetor para ser escritas na ordem certas com tabelas que possuem chave estrangeiras depois das que não possuem
        $VetorReal[0] = $vetor[0];
        $VetorReal[1] = $vetor[9];
        $VetorReal[2] = $vetor[10];
        $VetorReal[3] = $vetor[11];
        $VetorReal[4] = $vetor[17];
        $VetorReal[5] = $vetor[4];
        $VetorReal[6] = $vetor[8];
        $VetorReal[7] = $vetor[6];
        $VetorReal[8] = $vetor[7];
        $VetorReal[9] = $vetor[13];
        $VetorReal[10] = $vetor[14];
        $VetorReal[11] = $vetor[2];
        $VetorReal[12] = $vetor[3];
        $VetorReal[13] = $vetor[1];
        $VetorReal[14] = $vetor[5];
        $VetorReal[15] = $vetor[12];
        $VetorReal[16] = $vetor[15];
        $VetorReal[17] = $vetor[16];
        $contador = 0; // zera contador
        foreach (array_reverse($tabelas) as $iterador) {
            $resultado .= "\n\n" . $VetorReal[$contador] . ";\n\n"; // concatenando todos os comandos da  tabela na string da variavel do arquivo
            $contador++;// contador incrementado
        }

        foreach (array_reverse($tabelas) as $iterador1) { // percorre array de tabelas novamente
            $sql = "SELECT * FROM " . $iterador1;
            $query = mysqli_query($connect, $sql); // obtem nome de cada tabela pelo qual o iterador passa
            $colunas1 = mysqli_num_fields($query); // verifica numero de campos

            //Laços de repetição com range equivalente ao numero de capos de cada tabela. Usara varivel de string auxiliar primeiro
            for ($i = 0; $i < $colunas1; $i++) {
                while ($row1 = mysqli_fetch_row($query)) { //percorrendo arrays de colunas das tabelas
                    $resultado1 .= 'INSERT INTO ' . $iterador1 . ' VALUES('; // adicionando na variavel string os dados de incerção

                    for ($j = 0; $j < $colunas1; $j++) {
                        $row1[$j] = addslashes(($row1[$j])); //obtendo dados daquela posição
                        $row1[$j] = str_replace("\n", "\\n", $row1[$j]); // procurando quebras de linhas e corriginduas para quebra dupla

                        if (isset($row1[$j])) { // verifica a existencia do vetor
                            if (!empty($row1[$j])) { // verfica se o vetor não esta vazio
                                $resultado1 .= '"' . $row1[$j] . '"'; // concatena na variavel de string do arquivo
                            } else {
                                $resultado1 .= '0'; // se estiver vazia adiciona 0 que é eequivalente a false
                            }
                        } else {
                            $resultado1 .= '0'; // se não existir adiciona 0 que é eequivalente a false
                        }

                        if ($j < ($colunas1 - 1)) {// verifica se chegou ao final da linha
                            $resultado1 .= ',';  //adiciona virgula a linha
                        }
                    }
                    $resultado1 .= ");\n"; // fecha parenteses e quebra linha
                }
            }
            $resultado1 .= "\n\n"; // quebra dupla de linhas
        }
        $vetor = explode("\n\n", $resultado1); // transformando string em vetor usando as quebras duplas de linha como ponto de divisão
        $VetorR = [];
        //trecho para realizar escrita da inserção na ordem correta com tabelas sem chave estrangeira sendo adicionadas antes das que tem
        $VetorR[0] = $vetor[0];
        $VetorR[1] = $vetor[9];
        $VetorR[2] = $vetor[10];
        $VetorR[3] = $vetor[11];
        $VetorR[4] = $vetor[17];
        $VetorR[5] = $vetor[4];
        $VetorR[6] = $vetor[8];
        $VetorR[7] = $vetor[6];
        $VetorR[8] = $vetor[7];
        $VetorR[9] = $vetor[13];
        $VetorR[10] = $vetor[14];
        $VetorR[11] = $vetor[2];
        $VetorR[12] = $vetor[3];
        $VetorR[13] = $vetor[1];
        $VetorR[14] = $vetor[5];
        $VetorR[15] = $vetor[12];
        $VetorR[16] = $vetor[15];
        $VetorR[17] = $vetor[16];
        $contador = 0;
        foreach (array_reverse($tabelas) as $iterador) {
            $resultado .= $VetorR[$contador] . "\n\n";
            $contador++; // concatenando na variavel do arquivo original
        }
        $diretorio = '../BD/'; // definindodiretorio do download
        if (!is_dir($diretorio)) {
            mkdir($diretorio, 0777, true); //definindo permissões de diretorio
            chmod($diretorio, 0777);
        }
        //adicionando data e norme ao arquivo
        $data = date('Y-m-d-h-i-s');
        $arquivoN = $diretorio . "hospita_universitario_backup_" . $data;

        //função de criação e escrita do arquivo
        $arquivo = fopen($arquivoN . '.sql', 'w+');
        fwrite($arquivo, $resultado);
        fclose($arquivo);

        //adiconando extensão
        $baixar = $arquivoN . ".sql";


        //veificando existencia do arquivo
        if (file_exists(($baixar))) {
            header("Pragma: public");
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("Cache-Control: private", false);
            header("Content-Type: application/force-download");
            header("Content-Disposition: attachment; filename=\"" . basename($baixar) . "\";");
            header("Content-Transfer-Encoding: binary");
            header("Content-Length: " . filesize($baixar));
            readfile($baixar); // função para baixar

            //log
            $ip = $_SERVER["REMOTE_ADDR"];
            $acao = "Realizou um backup";
            AdminController::salvarLog($acao, $ip);

            return redirect()->back()->with('msg', "Backup realizado"); // mensagem de sucesso
        } else {
            return redirect()->back()->with('msg-error', "Houve um erro ao tentar exportar a base de dados!!"); //mensagem de erro
        }
    }

  
    /**
     * Função de cadastro de backup
     *
     * @param  mixed $request
     * @return redirect()->back()->with()
     */
    public function cadastrarBD(Request $request)
    {
        session_start();
        include("db.php");
        $checkbox = $request->alwaysCheck; // obtendo checkbox para ver se o downloadé altomatico
        
        //funções para obter ip do usuario
        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = $_SERVER['REMOTE_ADDR'];

        $hora = $request->fhorario; // obtend horario marcado
        $cod = 0;
        $sql = "SELECT * FROM backups_agendados";
        $query = mysqli_query($connect, $sql); // acesando tabela de buckups
        while ($sql = mysqli_fetch_array($query)) {
            if ($sql['ID'] != null) {
                $cod = $sql['ID']; // obtendo id do ultimo backup cadastrado
            }
        }
        $cod++; // somando id com 1 para obter id unico
        
        //trecho que verifica qual id consegue pegar do usuario das tres auternativas declaradas.
        if (filter_var($client, FILTER_VALIDATE_IP)) {
            $ip = $client;
        } elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
            $ip = $forward;
        } else {
            $ip = $remote;
        }
        if ($checkbox == "on") { // vericiando se o agendamento tem que ser automatico
            // se sim o agendamento sera inserido com data nula e automatico com 1 que equivale  a true
            $insert = "INSERT INTO backups_agendados (ID,Data_backup,Hora_backup,ip,Automatico) VALUES ('$cod','null','$hora','$ip','1')";
            mysqli_query($connect, $insert);

            //log
            $ip = $_SERVER["REMOTE_ADDR"];
            $acao = "Agendou um backup automático nº $cod";
            AdminController::salvarLog($acao, $ip);
        } else {
            //// se não o agendamento sera inserido com data informada e automatico com 0 que equivale  a false
            $data = $request->date;
            $insert = "INSERT INTO backups_agendados (ID,Data_backup,Hora_backup,ip,Automatico) VALUES ('$cod','$data','$hora','$ip','0')";
            mysqli_query($connect, $insert);

            //log
            $ip = $_SERVER["REMOTE_ADDR"];
            $acao = "Agendou um backup não automático nº $cod";
            AdminController::salvarLog($acao, $ip);
        }
        return redirect()->back()->with('success',"Agendamento de backup cadastrado com sucesso!!");
    }

    /**
     * Função para remover agendamento de backup  
     *
     * @param  mixed $request
     * @return redirect()->back()->with()
     */
    public function removerAgendamentoBackup(Request $request)
    {
        include("db.php");
        session_start();
        $sql =  "DELETE FROM backups_agendados WHERE ID = '$request->removerAB'";
        mysqli_query($connect, $sql);

        //log
        $ip = $_SERVER["REMOTE_ADDR"];
        $acao = "Removeu um backup agendado";
        AdminController::salvarLog($acao, $ip);

        return redirect()->back()->with('success',"Agendamento de backup removido com sucesso!!");;
    }

    /**
     * Função para pegar as informações do Relatório Gerencial
     *
     * @return view
     */
    public function relatorioGerencial()
    {
        include("db.php");
        VerificaLoginController::verificarLoginAdmin();
        
        //Calculo da quantidade de pacientes
        $sql = "SELECT COUNT(*) FROM pacientes WHERE Estado = 'internado'";
        $query = mysqli_query($connect, $sql);
        $paci = mysqli_fetch_assoc($query);

        //Calculo da quantidade de funcionarios Cadastrados
        $sql = "SELECT COUNT(*) FROM pacientes ";
        $query = mysqli_query($connect, $sql);
        $func = mysqli_fetch_assoc($query);

        //CID mais frequente
        $sql = "SELECT codCid FROM cid INNER JOIN cid_prontuario 
                ON cid.id=cid_prontuario.id_CID GROUP BY codCid 
                ORDER BY count(codCid) desc, codCid desc LIMIT 1";
        $query = mysqli_query($connect, $sql);
        //dd( mysqli_fetch_assoc($query));
        if ($query == false) {
            $cid = ["codCid" => "0"];
        }
        $cid = mysqli_fetch_assoc($query);

        //Taxa de óbito
        //Quantidade total de pacientes
        $sql = "SELECT COUNT(*) FROM pacientes ";
        $query = mysqli_query($connect, $sql);
        $paciV = mysqli_fetch_assoc($query);

        //Quantidade de pacientes estado Obito
        $sql = "SELECT COUNT(*) FROM pacientes WHERE Estado = 'obito'";
        $query = mysqli_query($connect, $sql);
        $PaciO = mysqli_fetch_assoc($query);
        if ($query == false) {
            $paciV = ["COUNT(*)" => "1"];
        }
        //Calculo da porcentagem
        $taxa = number_format($PaciO["COUNT(*)"] / $paciV["COUNT(*)"] * 100, 2);

        //Idade Media entre Pacientes
        $sql = "SELECT avg(FLOOR(DATEDIFF(NOW(), c.Data_Nasc) / 365)) AS idade FROM pacientes c";
        $query = mysqli_query($connect, $sql);
        $data = mysqli_fetch_assoc($query);
        $media = number_format($data["idade"], );

        //Medicamento mais usado
        $sql = "SELECT Nome_Medicam FROM medicamentos INNER JOIN agendamentos ON 
                medicamentos.Codigo=agendamentos.Cod_medicamento GROUP BY Nome_Medicam 
                ORDER BY count(Nome_Medicam) desc, Nome_Medicam desc LIMIT 1";
        $query = mysqli_query($connect, $sql);
        if ($query == false) {
            $medic = ["Nome_Medicam" => "Vazio"];
        }
        $medic = mysqli_fetch_assoc($query);

        //Quantidade de Leitos Cadastrados
        $sql = "SELECT COUNT(*) FROM leitos ";
        $query = mysqli_query($connect, $sql);
        $leito = mysqli_fetch_assoc($query);

        //Quantidade de Leitos Ocupados
        $sql = "SELECT COUNT(*) FROM leitos WHERE Ocupado = '1'";
        $query = mysqli_query($connect, $sql);
        $leitOcu = mysqli_fetch_assoc($query);

        //Enfermeiros Chefes Ativos
        $sql = "SELECT COUNT(*) FROM usuarios WHERE Atribuicao = 'Enfermeiro Chefe'AND Ativo = '1'";
        $query = mysqli_query($connect, $sql);
        $EnfCh = mysqli_fetch_assoc($query);

        //Enfermeiros Ativos
        $sql = "SELECT COUNT(*) FROM usuarios WHERE Atribuicao = 'Enfermeiro' AND Ativo = '1'";
        $query = mysqli_query($connect, $sql);
        $Enf = mysqli_fetch_assoc($query);

        //Estagiarios Ativos
        $sql = "SELECT COUNT(*) FROM usuarios WHERE Atribuicao = 'Estagiario' AND Ativo = '1'";
        $query = mysqli_query($connect, $sql);
        $Est = mysqli_fetch_assoc($query);

        //Administradores Cadastrados
        $sql = "SELECT COUNT(*) FROM administradores ";
        $query = mysqli_query($connect, $sql);
        $adMin = mysqli_fetch_assoc($query);

        $inf = ['paci' => $paci, 'func' => $func,'cid' => $cid, 'taxa' => $taxa, 'media' => $media,
        'medic' =>$medic,'leito' => $leito,'leitOcu' => $leitOcu,'EnfCh' => $EnfCh,'Enf' => $Enf,'Est' => $Est,'adMin' => $adMin, ];
        //dd($inf);

        return view('/admin/relatorioGerencial', $inf);
    }
    
    /**
     * Função para realizar Backup
     *
     * @return AdminController::salvarDB()
     */
    public function realizarBackup()
    {
        AdminController::salvarDB(); // Quando clicado no botão de realizar backup chama fução estatica de backup
    }
    
    /**
     * Função estatica para backup automatico. 
     * Deve ser chamada usando funcionalidade de chamada automatica da hospedagem
     *
     * @return void
     */
    public static function realizarBackupAgendado()
    {
        include("db.php");
        // obtem data e hora atual
        date_default_timezone_set('America/Sao_Paulo');
        $dataAtual = date('Y-m-d');
        $horaAtual = date('H:i:s');
        $sql = "SELECT * FROM backups_agendados";
        $query = mysqli_query($connect, $sql); // acessa a tabela de backups agendaddos
        while ($sql = mysqli_fetch_array($query)) {
            //obtem a data e hora de cada aendamento
            $data = $sql['Data_backup'];
            $hora = $sql['Hora_backup'];
            if ($dataAtual == $data and $horaAtual == $hora) { //verifica se as datas e horas cadastradas e obtidas batem e se sim chamam a função estatica de backup
               AdminController::salvarDB();
            }
            else if($data == '0000-00-00' and $horaAtual == $hora)
            {
                AdminController::salvarDB();
            }
        }
    }

    
}
