<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Monolog\Handler\SendGridHandler;
use PhpParser\Node\Stmt\Return_;
use Dompdf\Dompdf;
use Dompdf\Options;
use Hamcrest\Core\IsSame;
use Mpdf\Mpdf;
use mysqli;
use Illuminate\Support\Facades\Mail;

/**
 * Classe HomeController
 */
class HomeController extends Controller
{

    /**
     * Função de página inicial
     *
     * @return view
     */
    public function index()
    {
        session_start();
        if ((isset($_SESSION['administrador']) == false) and (isset($_SESSION['enfermeiroChefe']) == false)
        and (isset($_SESSION['enfermeiro']) == false) and (isset($_SESSION['estagiario']) == false)) {
            return view('login');
        } elseif (isset($_SESSION['administrador'])) {
            header("Location: /menuAdm");
            exit();
        } else {
            header("Location: /menu");
            exit();
        }
    }


    /**
     * Função de login
     *
     * @param  mixed $request
     * @return redirect() -> back() ->with()
     */
    public function login(Request $request)
    {
        include("db.php");
        $request -> validate([
            'cpf' => 'required',
            'senha' => 'required'
        ]);

        //Verificando se cpf estão cadastrados no banco de dados
        $buscarCpf = mysqli_query($connect, "SELECT CPF FROM usuarios WHERE CPF = '$request->cpf'");
        $row = mysqli_num_rows($buscarCpf);        //resultado da verificação
        
        //captura a senha do banco
        $buscarSenha = "SELECT Senha FROM usuarios WHERE CPF = '$request->cpf'";
        $senhaBanco = mysqli_query($connect, $buscarSenha);
        while ($buscarSenha = mysqli_fetch_array($senhaBanco)) {
            $senhaEncontrada = $buscarSenha["Senha"];
        }

        
        //verifica se o usuario existe no sistema. $row = 1 significa que sim
        if ($row == 1) {

            /* se a senha digitada pelo usuário for igual a senha padrão (12345), que é a que está no banco também,
            *   ele é mandado para página de primeiro acesso */
            if ($request->senha == 12345 and $senhaEncontrada == 12345) {
                return redirect('/primeiroAcesso')->with('cpf', $request->cpf);
            }

            $resultado = 'p|e|r|m|i|ssã|os|';

            //busca a senha, status ativo e sua atribuição
            $sql = "SELECT * FROM usuarios where CPF = '$request->cpf'";
            $query = mysqli_query($connect, $sql);
            while ($sql = mysqli_fetch_array($query)) {
                $atribuicao = $sql["Atribuicao"];
                $ativo = $sql['Ativo'];
                $senhaEncontrada = $sql["Senha"];
            }

            //se a senha que foi digitada for igual ao do banco
            if (Hash::check($request->senha, $senhaEncontrada)) {
                session_start();
              
                $sqlNome = "SELECT * FROM usuarios where CPF = '$request->cpf'";
                $queryNome = mysqli_query($connect, $sqlNome);
                while ($sqlNome = mysqli_fetch_array($queryNome)) {
                    $NavNome = $sqlNome["Nome"];
                }
                
              
                if ($ativo == 1) {
                    //Sequência de condicionais que verifica o cargo para redirecionar para o menu correspondente

                    if ($atribuicao == "Administrador") {
                        $_SESSION['administrador'] = $request->cpf; // inicia uma sessão de nome usuario com o cpf recuperado
                        $_SESSION['permissoes'][36] = $NavNome;
                        //log
                        $ip = $_SERVER["REMOTE_ADDR"];
                        $acao = "Administrador logou";
                        AdminController::salvarLog($acao, $ip);
    
                        header("Location: /menuAdm");
                        exit();
                    }// A partir daqui ele vai obter todas as permissões
                    // Coloca-la em uma string
                    // Transforma-la em um array
                    // e passala para sessão de permissoes
                    elseif ($atribuicao == "Enfermeiro Chefe") {
                        $_SESSION['enfermeiroChefe'] = $request->cpf; // inicia uma sessão de nome usuario com o cpf recuperado
                        for ($i = 7;$i <= 35;$i++) {
                            $resultado .= VerificaLoginController::verificaPermissao($i).'|';
                        }
                        $resultado .= $NavNome;
                        $vetor = explode('|', $resultado);
                        $_SESSION['permissoes'] = $vetor;
                        
                        //log
                        $ip = $_SERVER["REMOTE_ADDR"];
                        $acao = "Enfermeiro chefe logou";
                        AdminController::salvarLog($acao, $ip);
    
                        header("Location: /menu");
                        exit();
                    } elseif ($atribuicao == "Enfermeiro") {
                        $_SESSION['enfermeiro'] = $request->cpf; // inicia uma sessão de nome usuario com o cpf recuperado
                        for ($i = 7;$i <= 35;$i++) {
                            $resultado .= VerificaLoginController::verificaPermissao($i).'|';
                        }
                        $resultado .= $NavNome;
                        $vetor = explode('|', $resultado);
                        $_SESSION['permissoes'] = $vetor;
                        //log
                        $ip = $_SERVER["REMOTE_ADDR"];
                        $acao = "Enfermeiro logou";
                        AdminController::salvarLog($acao, $ip);
    
    
                        header("Location: /menu");
                        exit();
                    } elseif ($atribuicao == "Estagiario") {
                        $_SESSION['estagiario'] = $request->cpf; // inicia uma sessão de nome usuario com o cpf recuperado

                        for ($i = 7;$i <= 35;$i++) {
                            $resultado .= VerificaLoginController::verificaPermissao($i).'|';
                        }
                        $resultado .= $NavNome;
                        $vetor = explode('|', $resultado);
                        $_SESSION['permissoes'] = $vetor;
                        //log
                        $ip = $_SERVER["REMOTE_ADDR"];
                        $acao = "Estagiário logou";
                        AdminController::salvarLog($acao, $ip);
    
                        header("Location: /menu");
                        exit();
                    } else {
                        return redirect() -> back() ->with('msg-error', 'Funcionário sem cargo, algo está errado');
                    }
                } else {
                    return redirect() -> back() ->with('msg-error', 'Conta do funcionário encontra-se desativada');
                }
            } else {
                return redirect() -> back() ->with('msg-error', 'A senha informada está incorreta');
            }
        } else { // caso em que o $row = 0, usuário não existe
            return redirect() -> back() ->with('msg-error', 'O Usuário não existe no sistema');
        }
    }

 
    /**
     * Função de menu com exceção do adm
     *
     * @return view
     */
    public function menu()
    {
        VerificaLoginController::verificarLogin();
        $resultado =[];
        // verifica que tipo de usuario esta logado e envia informações das permissões para view pra ocultar funcionalidades
        if (isset($_SESSION['enfermeiroChefe'])) {
            for ($i = 7;$i <= 35;$i++) {
                $resultado[$i] = VerificaLoginController::verificaPermissao($i);
            }
        } elseif (isset($_SESSION['enfermeiro'])) {
            for ($i = 36;$i < 65;$i++) {
                $resultado[$i] = VerificaLoginController::verificaPermissao($i-28);
            }
        } elseif (isset($_SESSION['estagiario'])) {
            for ($i = 65;$i < 94;$i++) {
                $resultado[$i] = VerificaLoginController::verificaPermissao($i-58);
            }
        }
        if (isset($_SESSION['enfermeiro']) or isset($_SESSION['enfermeiroChefe']) or isset($_SESSION['estagiario'])) {
            return view('/menu', ['resultado'=>$resultado]);
        } else {
            return redirect()->back();
        }
    }

 
    /**
     * Função de logout
     *
     * @return void
     */
    public function logout()
    {
        // destroi todas as sessões existentes e retorna para página de login
        session_start();
        session_destroy();

        //log
        $ip = $_SERVER["REMOTE_ADDR"];
        $acao = "Logout no sistema";
        AdminController::salvarLog($acao, $ip);

        header("Location: /");
        exit();
    }
    
 
    /**
     * Função de chamada de view de primeiro acesso
     *
     * @return view()
     */
    public function acessarPrimeiroAcesso()
    {
        return view('primeiroAcesso');
    }
    
    /**
     * Função de processar o primeiro acesso
     *
     * @param  mixed $request
     * @return redirect()
     */
    public function primeiroAcesso(Request $request)
    {
        include('db.php');

        $cpf = $request->cpf;
        $senhaDefinida = $request->senha;
        $senhaConfirmacao = $request->confirmacao;

        //se a nova senha desejada for igual a de confimação

        if ($senhaConfirmacao == $senhaDefinida) {
        
            //cria um hash a partir da nova senha
            $senhaCript = Hash::make($senhaConfirmacao);

            //atualiza senha no banco de dados
            $update = "UPDATE usuarios SET Senha = '$senhaCript' WHERE CPF = '$cpf'";
            mysqli_query($connect, $update);
            
            //log
            $ip = $_SERVER["REMOTE_ADDR"];
            $acao = "Novo usuário cadastrou senha";
            AdminController::salvarLog($acao, $ip);


            //Verificando se cpf está cadastrados no banco de dados
            $result = mysqli_query($connect, "SELECT CPF FROM usuarios WHERE CPF = '$request->cpf'");
            $row = mysqli_num_rows($result);
            
            //resultado da verificação
            $existeUsuario = "SELECT * FROM usuarios where CPF = '$request->cpf'";
            $buscar = mysqli_query($connect, $existeUsuario);
            while ($sql = mysqli_fetch_array($buscar)) {
                $atribuicao = $sql["Atribuicao"];
            }

            //verifica se o usuario existe no sistema. $row = 1 significa que sim
            if ($row == 1) {
                session_start();
          
                $sqlNome = "SELECT * FROM usuarios where CPF = '$request->cpf'";
                $queryNome = mysqli_query($connect, $sqlNome);
                while ($sqlNome = mysqli_fetch_array($queryNome)) {
                    $NavNome = $sqlNome["Nome"];
                }

                $resultado = 'p|e|r|m|i|ssã|os|';
              
                if ($ativo == 1) {
                    //Sequência de condicionais que verifica o cargo para redirecionar para o menu correspondente

                    if ($atribuicao == "Administrador") {
                        $_SESSION['administrador'] = $request->cpf; // inicia uma sessão de nome usuario com o cpf recuperado
                        $_SESSION['permissoes'][36] = $NavNome;
                        //log
                        $ip = $_SERVER["REMOTE_ADDR"];
                        $acao = "Administrador logou";
                        AdminController::salvarLog($acao, $ip);
    
                        header("Location: /menuAdm");
                        exit();
                    }
                    
                    // A partir daqui ele vai obter todas as permissões
                    // Coloca-la em uma string
                    // Transforma-la em um array
                    // e passa-la para sessão de permissoes
                    elseif ($atribuicao == "Enfermeiro Chefe") {
                        $_SESSION['enfermeiroChefe'] = $request->cpf; // inicia uma sessão de nome usuario com o cpf recuperado
                        for ($i = 7;$i <= 35;$i++) {
                            $resultado .= VerificaLoginController::verificaPermissao($i).'|';
                        }
                        $resultado .= $NavNome;
                        $vetor = explode('|', $resultado);
                        $_SESSION['permissoes'] = $vetor;
                        
                        //log
                        $ip = $_SERVER["REMOTE_ADDR"];
                        $acao = "Enfermeiro chefe logou";
                        AdminController::salvarLog($acao, $ip);
    
                        header("Location: /menu");
                        exit();
                    } elseif ($atribuicao == "Enfermeiro") {
                        $_SESSION['enfermeiro'] = $request->cpf; // inicia uma sessão de nome usuario com o cpf recuperado
                        for ($i = 7;$i <= 35;$i++) {
                            $resultado .= VerificaLoginController::verificaPermissao($i).'|';
                        }
                        $resultado .= $NavNome;
                        $vetor = explode('|', $resultado);
                        $_SESSION['permissoes'] = $vetor;
                        //log
                        $ip = $_SERVER["REMOTE_ADDR"];
                        $acao = "Enfermeiro logou";
                        AdminController::salvarLog($acao, $ip);
    
    
                        header("Location: /menu");
                        exit();
                    } elseif ($atribuicao == "Estagiario") {
                        $_SESSION['estagiario'] = $request->cpf; // inicia uma sessão de nome usuario com o cpf recuperado

                        for ($i = 7;$i <= 35;$i++) {
                            $resultado .= VerificaLoginController::verificaPermissao($i).'|';
                        }
                        $resultado .= $NavNome;
                        $vetor = explode('|', $resultado);
                        $_SESSION['permissoes'] = $vetor;
                        //log
                        $ip = $_SERVER["REMOTE_ADDR"];
                        $acao = "Estagiário logou";
                        AdminController::salvarLog($acao, $ip);
    
                        header("Location: /menu");
                        exit();
                    }
                }
            }
        } else {                  //se a nova senha desejada for diferente da confirmada
            return redirect('/primeiroAcesso')->with('cpf', $request->cpf);
        }
    }

    /*public function menu(){
        return view('admin.menu');
    }*/


    /**
     * Função de editar perfil
     *
     * @param  mixed $request
     * @return view()
     */
    public function editPerfil(Request $request)
    {
        VerificaLoginController::verificarLogin();
        include("db.php");
        $usuario = [];
        $cpf = '';
        // verifica o cargo de quem ta logado
        //se for enfermeiro ou enfermeiro chefe obtem o coren e o cpf do banco se for administrador ou estagiario so o cpf
        if (isset($_SESSION['enfermeiroChefe'])) {
            $cpf = $_SESSION['enfermeiroChefe'];
            $sql = "SELECT * FROM enfermeiros_chefes where CPF = '$cpf'";
            $query = mysqli_query($connect, $sql);
            while ($sql = mysqli_fetch_array($query)) {
                $usuario['coren'] = $sql['COREN'];
            }
        } elseif (isset($_SESSION['enfermeiro'])) {
            $cpf = $_SESSION['enfermeiro'];
            $sql = "SELECT * FROM enfermeiros where CPF = '$cpf'";
            $query = mysqli_query($connect, $sql);
            while ($sql = mysqli_fetch_array($query)) {
                $usuario['coren'] = $sql['COREN'];
            }
        } elseif (isset($_SESSION['estagiario'])) {
            $cpf = $_SESSION['estagiario'];
        } elseif (isset($_SESSION['administrador'])) {
            $cpf = $_SESSION['administrador'];
        }
        $sql = "SELECT * FROM usuarios where CPF = '$cpf'";
        $query = mysqli_query($connect, $sql);
        while ($sql = mysqli_fetch_array($query)) {
            $usuario['nome'] = $sql['Nome'];
            $usuario['nascimento'] = $sql['Data_Nasc'];
            $usuario['sexo'] = $sql['Sexo'];
            $usuario['email'] = $sql['Email'];
        }

        //log
        $ip = $_SERVER["REMOTE_ADDR"];
        $acao = "Usuário editou perfil";
        AdminController::salvarLog($acao, $ip);


        return view('editarPerfil', ['usuario' => $usuario]); // envia os dados para view para preencher os campos
    }
    
  
    /**
     * Função de alterar senha
     *
     * @param  mixed $request
     * @return redirect()->back()->with()
     */
    public function alterarSenhaPerfil(Request $request)
    {
        session_start();
        include("db.php");

        //Verificação realizada para todos os cargos
        /* pega o usuario com o cpf na tabela de usuarios e compara a senha antiga
        digitada com a cadastrada e se forem correspondente substituem pela nova  digitada senha */
    
        if (isset($_SESSION['administrador'])) {
            $cpf = $_SESSION['administrador'];

            //busca de senha de usuário
            $sql = "SELECT * FROM usuarios where CPF = '$cpf'";
            $query = mysqli_query($connect, $sql);
            while ($sql = mysqli_fetch_array($query)) {
                $usuario['senha'] = $sql['Senha'];
            }

            if ((Hash::check($request->senhaAtual, $usuario['senha'])) and ($request->senha == $request->confirmacao)
                and ($request->senhaAtual != $request->confirmacao)) {

                //cria um hash a partir da nova senha
                $senhaCript = Hash::make($request->senha);

                //atualização de senha
                $updateSenha = "UPDATE usuarios SET Senha = '$senhaCript' WHERE CPF = '$cpf'";
                mysqli_query($connect, $updateSenha);

                //log
                $ip = $_SERVER["REMOTE_ADDR"];
                $acao = "Usuário alterou senha";
                AdminController::salvarLog($acao, $ip);

                //header('Location: /meuPerfil');
                return redirect()->back()->with('msg', 'Senha alterada com sucesso!');    // redireciona para o meu perfil
                
                //outros casos
            } elseif (!(Hash::check($request->senhaAtual, $usuario['senha']))) {
                return redirect()->back()->with('msg-error', 'A senha digitada está diferente da senha cadastrada!!!');
            } elseif ($request->senha != $request->confirmacao) {
                return redirect()->back()->with('msg-error', 'A senha de confirmação está diferente da nova senha. As senhas precisam ser idênticas!!!');
            } elseif ((Hash::check($request->senhaAtual, $usuario['senha'])) and ((Hash::check($request->senha, $usuario['senha'])))
                        and ($request->senha == $request->confirmacao)) {
                return redirect()->back()->with('msg-error', 'A nova senha digitada é igual a senha cadastrada!');
            } else {
                return redirect()->back()->with('msg-error', 'Campos de confirmação de nova e antiga senha estão incorretos!');
            }
        } elseif (isset($_SESSION['enfermeiroChefe'])) {
            $cpf = $_SESSION['enfermeiroChefe'];

            //busca de senha do usuário
            $sql = "SELECT * FROM usuarios where CPF = '$cpf'";
            $query = mysqli_query($connect, $sql);
            while ($sql = mysqli_fetch_array($query)) {
                $usuario['senha'] = $sql['Senha'];
            }

            if ((Hash::check($request->senhaAtual, $usuario['senha'])) and ($request->senha == $request->confirmacao)) {
                //cria um hash a partir da nova senha
                $senhaCript = Hash::make($request->senha);

                //atualização de senha
                $updateSenha = "UPDATE usuarios SET Senha = '$senhaCript' WHERE CPF = '$cpf'";
                mysqli_query($connect, $updateSenha);

                //log
                $ip = $_SERVER["REMOTE_ADDR"];
                $acao = "Usuário alterou senha";
                AdminController::salvarLog($acao, $ip);

                return redirect()->back()->with('msg', 'Senha alterada com sucesso!');      // redireciona para o meu perfil
                
                //outros casos
            } elseif (!(Hash::check($request->senhaAtual, $usuario['senha']))) {
                return redirect()->back()->with('msg-error', 'A senha atual digitada, é diferente da senha cadastrada.');
            } elseif ($request->senha != $request->confirmacao) {
                return redirect()->back()->with('msg-error', 'A senha de confirmação está diferente da nova senha. As senhas precisam ser idênticas!!!');
            } else {
                return redirect()->back()->with('msg-error', 'Campos de confirmação de nova e antiga senha estão incorretos!!!');
            }
        } elseif (isset($_SESSION['enfermeiro'])) {
            $cpf = $_SESSION['enfermeiro'];

            //busca de senha de usuário
            $sql = "SELECT * FROM usuarios where CPF = '$cpf'";
            $query = mysqli_query($connect, $sql);
            while ($sql = mysqli_fetch_array($query)) {
                $usuario['senha'] = $sql['Senha'];
            }

            if ((Hash::check($request->senhaAtual, $usuario['senha'])) and ($request->senha == $request->confirmacao)) {
                //cria um hash a partir da nova senha
                $senhaCript = Hash::make($request->senha);

                //atualização de senha
                $updateSenha = "UPDATE usuarios SET Senha = '$senhaCript' WHERE CPF = '$cpf'";
                mysqli_query($connect, $updateSenha);

                //log
                $ip = $_SERVER["REMOTE_ADDR"];
                $acao = "Usuário alterou senha";
                AdminController::salvarLog($acao, $ip);

                return redirect()->back()->with('msg', 'Senha alterada com sucesso!');          // redireciona para o meu perfil
                
                //outros casos
            } elseif (!(Hash::check($request->senhaAtual, $usuario['senha']))) {
                return redirect()->back()->with('msg-error', 'A senha atual digitada, é diferente da senha cadastrada.');
            } elseif ($request->senha != $request->confirmacao) {
                return redirect()->back()->with('msg-error', 'A senha de confirmação está diferente da nova senha. As senhas precisam ser idênticas!!!');
            } else {
                return redirect()->back()->with('msg-error', 'Campos de confirmação de nova e antiga senha estão incorretos!!!');
            }
        } else {
            $cpf = $_SESSION['estagiario'];

            //busca de senha de usuário
            $sql = "SELECT * FROM usuarios where CPF = '$cpf'";
            $query = mysqli_query($connect, $sql);
            while ($sql = mysqli_fetch_array($query)) {
                $usuario['senha'] = $sql['Senha'];
            }


            if ((Hash::check($request->senhaAtual, $usuario['senha'])) and ($request->senha == $request->confirmacao)) {
                //cria um hash a partir da nova senha
                $senhaCript = Hash::make($request->senha);

                //atualização de senha
                $updateSenha = "UPDATE usuarios SET Senha = '$senhaCript' WHERE CPF = '$cpf'";
                mysqli_query($connect, $updateSenha);

                //log
                $ip = $_SERVER["REMOTE_ADDR"];
                $acao = "Usuário alterou senha";
                AdminController::salvarLog($acao, $ip);

                return redirect()->back()->with('msg', 'Senha alterada com sucesso!');          // redireciona para o meu perfil
                
                //outros casos
            } elseif (!(Hash::check($request->senhaAtual, $usuario['senha']))) {
                return redirect()->back()->with('msg-error', 'A senha atual digitada, é diferente da senha cadastrada.');
            } elseif ($request->senha != $request->confirmacao) {
                return redirect()->back()->with('msg-error', 'A senha de confirmação está diferente da nova senha. As senhas precisam ser idênticas!!!');
            } else {
                return redirect()->back()->with('msg-error', 'Campos de confirmação de nova e antiga senha estão incorretos!!!');
            }
        }
    }


    /**
     * Função de alterar dados.
     * Altera dados como nome e email digitados na tela de perfil apos clicar no botão de edição  de acordo com o cpf do usuario cadastrado
     *
     * @param  mixed $request
     * @return redirect()->back()->with()
     */
    public function alterarDados(Request $request)
    {
        session_start();
        include("db.php");
        $cpf = HomeController::obterCpf();
        $updateNome = "UPDATE usuarios SET Nome = '$request->fnome' WHERE CPF = '$cpf'";
        $_SESSION['nome'] = $request->fnome;
        mysqli_query($connect, $updateNome);
        $updateEmail = "UPDATE usuarios SET Email = '$request->femail' WHERE CPF = '$cpf'";
        mysqli_query($connect, $updateEmail);

        //log
        $ip = $_SERVER["REMOTE_ADDR"];
        $acao = "Usuário alterou dados cadastrados";
        AdminController::salvarLog($acao, $ip);


        return redirect()->back()->with('msg', "Dados cadastrais atualizados com sucesso!!"); // retorna de volta para a mesma tela
    }


    /**
     * Função de listar pacientes
     *
     * @param  mixed $request
     * @return view()
     */
    public function listaPacientes(Request $request)
    {
        VerificaLoginController::verificarLogin();
        include("db.php");
        $i= 0;
        $p = [];
        $identicador = [];
        $perm = VerificaLoginController::verificaPermissao(18); // verifica permissão
        if ($perm == "1") {
            if ($request->novaAtribuicao == "internado") {
                //busca pacientes no banco com o status internado
                $sql = "SELECT * FROM pacientes WHERE Estado = 'internado'";
                $query = mysqli_query($connect, $sql);
                $verificaN = mysqli_num_rows($query);
                if ($verificaN > 0) {
                    //preenche array para ser exibido
                    while ($sql = mysqli_fetch_array($query)) {
                        $p[$i] = $sql['Nome_Paciente'];
                        $identicador[$i] = $sql['CPF'];
                        $cpf = $sql['CPF'];
                        $sql1 = "SELECT * FROM prontuarios WHERE Cpfpaciente = '$cpf'";
                        $query1 = mysqli_query($connect, $sql1);
                        while ($sql1 = mysqli_fetch_array($query1)) {
                            if ($sql1['aberto'] == 1) {
                                $p['id'.$i] = $sql1['ID'];
                            }
                        }
                        $i = $i+1;
                    }
                    return view('listaPacientes', ['p'=>$p,'identicador'=>$identicador]); // retorna vetor com dados para preencher a view e o id do prontuario
                } else {
                    return redirect()->back()->with('msg-error', 'Nenhuma informação encontrada na base de dados!!!');// se não encontrar nada exibe essa mensagem
                }
            } elseif ($request->novaAtribuicao == "alta") {
                //busca no banco pacientes com o status de alta
                $sql = "SELECT * FROM pacientes WHERE Estado = 'alta'";
                $query = mysqli_query($connect, $sql);
                $verificaN = mysqli_num_rows($query);
                if ($verificaN > 0) {
                    //preenche array para ser exibido
                    while ($sql = mysqli_fetch_array($query)) {
                        $p[$i] = $sql['Nome_Paciente'];
                        $identicador[$i] = $sql['CPF'];
                        $cpf = $sql['CPF'];
                        $sql1 = "SELECT * FROM prontuarios WHERE Cpfpaciente = '$cpf'";
                        $query1 = mysqli_query($connect, $sql1);
                        while ($sql1 = mysqli_fetch_array($query1)) {
                            if ($sql1['aberto'] == 0) {
                                $p['id'.$i] = $sql1['ID'];
                            }
                        }
                        $i = $i+1;
                    }
                    return view('listaPacientes', ['p'=>$p,'identicador'=>$identicador]); // retorna vetor com dados para preencher a view e o id do prontuario
                } else {
                    return redirect()->back()->with('msg-error', 'Nenhuma informação encontrada na base de dados!!!'); // se não encontrar nada exibe essa mensagem
                }
            } elseif ($request->novaAtribuicao == "obito") {
                //busca no banco pacientes com status de óbito
                $sql = "SELECT * FROM pacientes WHERE Estado = 'obito'";
                $query = mysqli_query($connect, $sql);
                $verificaN = mysqli_num_rows($query);
                if ($verificaN > 0) {
                    //preenche array para ser exibido
                    while ($sql = mysqli_fetch_array($query)) {
                        $p[$i] = $sql['Nome_Paciente'];
                        $identicador[$i] = $sql['CPF'];
                        $cpf = $sql['CPF'];
                        $sql1 = "SELECT * FROM prontuarios WHERE Cpfpaciente = '$cpf'";
                        $query1 = mysqli_query($connect, $sql1);
                        while ($sql1 = mysqli_fetch_array($query1)) {
                            if ($sql1['aberto'] == 0) {
                                $p['id'.$i] = $sql1['ID'];
                            }
                        }
                        $i = $i+1;
                    }

                    //log
                    $ip = $_SERVER["REMOTE_ADDR"];
                    $acao = "Visualizou lista de pacientes";
                    AdminController::salvarLog($acao, $ip);
                
                    return view('listaPacientes', ['p'=>$p,'identicador'=>$identicador]); // retorna vetor com dados para preencher a view e o id do prontuario
                } else {
                    return redirect()->back()->with('msg-error', 'Nenhuma informação encontrada na base de dados!!!'); // se não encontrar nada exibe essa mensagem
                }
            } else {
                return view('listaPacientes');
            }
        } else {
            return redirect()->back();
        }
    }


    /**
     * Função de agendamentos realizados
     *
     * @return view()
     */
    public function agendamentosRealizados()
    {
        VerificaLoginController::verificarLogin();
        $resultado = VerificaLoginController::verificaPermissao(22); // verifica permissão
        include("db.php");
        $infos = [];
        $identificaP = null;
        $i = 0;
        if ($resultado == "1") {
            $cpf = HomeController::obterCpf(); // função estatica para obter cpf do usuario logado
            $sql = "SELECT * FROM agendamentos WHERE CPF_usuario = '$cpf'";
            $query = mysqli_query($connect, $sql);
            $verificaN = mysqli_num_rows($query);
            if ($verificaN > 0) { // verifica se tem agendamentos cadastrados no bd
                while ($sql = mysqli_fetch_array($query)) {
                    if ($sql['Realizado'] == 1) { // verifica se o agendamento ja foi realizado
                        // se sim obtem os dados
                        $medicamento = $sql['Cod_medicamento'];
                        $prontuario = $sql['ID_prontuario'];
                        $infos['hora'.$i] = $sql['Hora_Agend'];
                        $infos['data'.$i] = $sql['Data_Agend'];
                        $infos['posologia'.$i] = $sql['Posologia'];
                        $infos['id'.$i] = $sql['Codigo'];
                        $sql1 = "SELECT * FROM medicamentos WHERE Codigo = '$medicamento'";
                        $query1 = mysqli_query($connect, $sql1);
                        while ($sql1 = mysqli_fetch_array($query1)) {
                            $infos['medicamento'.$i] = $sql1['Nome_Medicam'];
                        }
                        $sql2 = "SELECT * FROM prontuarios WHERE ID = '$prontuario'";
                        $query2 = mysqli_query($connect, $sql2);
                        while ($sql2 = mysqli_fetch_array($query2)) {
                            $identificaP = $sql2['Cpfpaciente'];
                            $infos['leito'.$i] = $sql2['Id_leito'];
                        }
                        $sql3 = "SELECT * FROM pacientes WHERE CPF = '$identificaP'";
                        $query3 = mysqli_query($connect, $sql3);
                        while ($sql3 = mysqli_fetch_array($query3)) {
                            $infos['paciente'.$i] = $sql3['Nome_Paciente'];
                        }
                        $infos['identificaP'.$i] = $identificaP;
                        $i++;
                    }
                }

                //log
                $ip = $_SERVER["REMOTE_ADDR"];
                $acao = "Visualizou lista de agendamentos realizados";
                AdminController::salvarLog($acao, $ip);
     
                return view('agendamentosRealizados', ['infos' => $infos]); // Retorna dados para view
            } else {
                return redirect()->back()->with('msg-error', 'Nenhuma informação encontrada na base de dados!!!');
            }
        } else {
            return redirect()->back()->with('msg-error', 'Você não tem acesso a essa página!!!');
        }
    }


    /**
     * Função de visualizar meus agendamentos
     *
     * @return view()
     */
    public function meusAgendamentos()
    {
        //verifica permissã busca agendamentos com aplicado cadastrado com aquele cpf e exibi na tela se encontrado.
        VerificaLoginController::verificarLogin();
        $resultado = VerificaLoginController::verificaPermissao(23);
        include("db.php");
        $infos = [];
        $i = 0;
        $identificaP = null;
        if ($resultado == "1") {
            $cpf = HomeController::obterCpf();
            $sql = "SELECT * FROM agendamentos WHERE CPF_usuario = '$cpf'";
            $query = mysqli_query($connect, $sql);
            $verificaN = mysqli_num_rows($query);
            if ($verificaN > 0) {
                while ($sql = mysqli_fetch_array($query)) {
                    if ($sql['Realizado'] == 0) {
                        $medicamento = $sql['Cod_medicamento'];
                        $prontuario = $sql['ID_prontuario'];
                        $infos['codA'.$i] = $sql['Codigo'];
                        $infos['hora'.$i] = $sql['Hora_Agend'];
                        $infos['data'.$i] = $sql['Data_Agend'];
                        $infos['posologia'.$i] = $sql['Posologia'];
                        $sql1 = "SELECT * FROM medicamentos WHERE Codigo = '$medicamento'";
                        $query1 = mysqli_query($connect, $sql1);
                        while ($sql1 = mysqli_fetch_array($query1)) {
                            $infos['medicamento'.$i] = $sql1['Nome_Medicam'];
                        }
                        $sql2 = "SELECT * FROM prontuarios WHERE ID = '$prontuario'";
                        $query2 = mysqli_query($connect, $sql2);
                        while ($sql2 = mysqli_fetch_array($query2)) {
                            $identificaP = $sql2['Cpfpaciente'];
                            $infos['leito'.$i] = $sql2['Id_leito'];
                            $infos['id'.$i] = $sql2['ID'];
                        }
                        $sql3 = "SELECT * FROM pacientes WHERE CPF = '$identificaP'";
                        $query3 = mysqli_query($connect, $sql3);
                        while ($sql3 = mysqli_fetch_array($query3)) {
                            $infos['paciente'.$i] = $sql3['Nome_Paciente'];
                        }
                        $infos['identificaP'.$i] = $identificaP;
                        $i++;
                    }
                }


                //log
                $ip = $_SERVER["REMOTE_ADDR"];
                $acao = "Visualizou lista de meus agendamentos";
                AdminController::salvarLog($acao, $ip);

                return view('meusAgendamentos', ['infos' => $infos]); // retorna dados encontrados para view
            } else {
                return redirect()->back()->with('msg-error', 'Nenhuma informação encontrada na base de dados!!!');
            }
        } else {
            return redirect()->back()->with('msg-error', 'Você não tem acesso a essa página!!!');
        }
    }


    /**
     * Função de finalizar meus agendamentos
     *
     * @param  mixed $request
     * @return redirect()->back()
     */
    public function finalizarMeusAgendamentos(Request $request)
    {
        include("db.php");
        session_start();
        // altera agendamento com determinado id para realizado (informação = 1)
        $sql = "UPDATE agendamentos SET Realizado = '1' WHERE Codigo = '$request->idA'";
        mysqli_query($connect, $sql);

        //log
        $ip = $_SERVER["REMOTE_ADDR"];
        $acao = "Finalizou um agendamento de medicamento";
        AdminController::salvarLog($acao, $ip);

        return redirect()->back()->with('msg', "Agendamento finalizado com sucesso!"); // redireciona de volta
    }
        

    /**
     * Função de ver agendamentos
     *
     * @param  mixed $request
     * @return view()
     */
    public function agendamentos(Request $request)
    {
        //verifica se tem permissão e busca agendamentoS
        VerificaLoginController::verificarLogin();
        include("db.php");
        $identificaP = null;
        $perm = VerificaLoginController::verificaPermissao(21);
        if ($perm == "1") {
            $i = 0;
            $infos = [];
            $sql = "SELECT * FROM agendamentos";
            $query = mysqli_query($connect, $sql);
            $verificaN = mysqli_num_rows($query);
            if ($verificaN > 0) {
                while ($sql = mysqli_fetch_array($query)) {
                    if ($sql['CPF_usuario'] == null) {//Encontrando agendamentos, se não tiver nenhum aplicador cadastrado obtem os dados
                        $medicamento = $sql['Cod_medicamento'];
                        $prontuario = $sql['ID_prontuario'];
                        $infos['hora'.$i] = $sql['Hora_Agend'];
                        $infos['data'.$i] = $sql['Data_Agend'];
                        $infos['codA'.$i] = $sql['Codigo'];
                        $infos['posologia'.$i] = $sql['Posologia'];
                        $sql1 = "SELECT * FROM medicamentos WHERE Codigo = '$medicamento'";
                        $query1 = mysqli_query($connect, $sql1);
                        while ($sql1 = mysqli_fetch_array($query1)) {
                            $infos['medicamento'.$i] = $sql1['Nome_Medicam'];
                        }
                        $sql2 = "SELECT * FROM prontuarios WHERE ID = '$prontuario'";
                        $query2 = mysqli_query($connect, $sql2);
                        while ($sql2 = mysqli_fetch_array($query2)) {
                            $identificaP = $sql2['Cpfpaciente'];
                            $infos['leito'.$i] = $sql2['Id_leito'];
                            $infos['id'.$i] = $sql2['ID'];
                        }
                        $sql3 = "SELECT * FROM pacientes WHERE CPF = '$identificaP'";
                        $query3 = mysqli_query($connect, $sql3);
                        while ($sql3 = mysqli_fetch_array($query3)) {
                            $infos['paciente'.$i] = $sql3['Nome_Paciente'];
                        }
                        $infos['identificaP'.$i] = $identificaP;
                        $i++;
                    }
                }


                //log
                $ip = $_SERVER["REMOTE_ADDR"];
                $acao = "Visualizou lista de agendamentos";
                AdminController::salvarLog($acao, $ip);

                return view('agendamentos', ['infos' => $infos]); // envia os dados para serem exibidos na view
            } else {
                return redirect()->back()->with('msg-error', 'Nenhuma informação encontrada na base de dados!!!');
            }
        } else {
            return redirect()->back();
        }
    }


    /**
     * Função auto cadastro em agendamentos
     *
     * @param  mixed $request
     * @return redirect()->back()->with()
     */
    public function autoCadastroAgendamento(Request $request)
    {
        include("db.php");
        session_start();
        $perm = VerificaLoginController::verificaPermissao(25); //verifica se usuario tem permissão
        if ($perm == "1") {
            $cpf = HomeController::obterCpf();
            if ($cpf!=null) { // se cpf diferente de nulo
                // adiciona seu proprio cpf ao agendamento sem responsavel
                $update = "UPDATE agendamentos SET CPF_usuario = '$cpf' WHERE Codigo = '$request->codA'";
                mysqli_query($connect, $update);

                //log
                $ip = $_SERVER["REMOTE_ADDR"];
                $acao = "Auto cadastrou como aplicador de um agendamento";
                AdminController::salvarLog($acao, $ip);

                return redirect()->back()->with('msg', 'Você se adicionou como aplicador do agendamento');
            }
        } else {
            return redirect()->back()->with("Você não tem permissão para realizar essa ação");
        }
    }


    /**
     * Função para permissão de cadastro de agendamentos
     *
     * @return view()
     */
    public function cadastroAgendamentos()
    {
        VerificaLoginController::verificarLogin();
        $resultado = VerificaLoginController::verificaPermissao(12);
        if ($resultado == "1") {
            return view('cadastroAgendamentos');
        } else {
            return redirect()->back()->with('msg-error', 'Você não tem acesso a essa página!!!');
        }
    }

 
    /**
     * Função para permissão de cadastro de prontuário
     *
     * @return view()
     */
    public function cadastroProntuario()
    {
        VerificaLoginController::verificarLogin();
        $perm = VerificaLoginController::verificaPermissao(33);
        if ($perm == "1") {
            return view('cadastroProntuario');
        } else {
            return redirect()->back();
        }
    }

   
    /**
     * Função para permissão de cadastro de paciente
     *
     * @return view()
     */
    public function cadastroPaciente()
    {
        VerificaLoginController::verificarLogin();
        $resultado = VerificaLoginController::verificaPermissao(17);
        if ($resultado == "1") {
            return view('cadastroPaciente');
        } else {
            return redirect()->back()->with('msg-error', 'Você não tem acesso a essa página!!!');
        }
    }

    
    /**
     * Função para redirecionar para a página de esqueci a senha
     *
     * @return view()
     */
    public function esqueciSenhaView()
    {
        return view('esqueciSenha');
    }

    /**
     * Função de esqueci a senha
     *
     * @param  mixed $request
     * @return  redirect()->back()->with()
     */
    public function esqueciSenha(Request $request)
    {
        include('db.php');

        $existeEmail = mysqli_query($connect, "SELECT COUNT(*) FROM usuarios WHERE Email = '$request->email'");

        //se não existir o email
        if (mysqli_fetch_assoc($existeEmail)['COUNT(*)'] == 0) {
            return redirect()->route('esqueciSenha')->with('error', "Email não existente!");
        } else {  //se existir

            //busca o nome do usuário no banco
            $buscarNome = "SELECT Nome FROM usuarios WHERE Email = '$request->email'";
            $busca = mysqli_query($connect, $buscarNome);
            while ($buscarNome = mysqli_fetch_array($busca)) {
                $nome = $buscarNome["Nome"];
            }

            $codigo = rand(100000, 999999);
            $link = "http://127.0.0.1:8000/checarCPF/".$codigo;

            

            //envia email
            Mail::send(new \App\Mail\ClasseMail($nome, $request->email, $link));

            return redirect()->back()->with('msg-sucess', 'Verifique sua caixa de entrada ou de spam!');
        }
    }
    
    /**
     * Função para a chamada da view
     *
     * @return view()
     */
    public function definirSenhaView()
    {
        return view('novaSenha');
    }
    
    /**
     * Função para redirecionar a tela
     *
     * @param  mixed $codigo
     * @return view()
     */
    public function checarCPFView($codigo)
    {
        if ($codigo < 100000 && $codigo < 999999) {
            abort(404);
        }
        return view('checarCPF');
    }
    
    /**
     * Função para checar o CPF
     *
     * @param  mixed $request
     * @return redirect()->with
     */
    public function checarCPF(Request $request)
    {
        include('db.php');

        //captura a senha do banco
        $buscarCPF = "SELECT CPF FROM usuarios WHERE CPF = '$request->cpf'";
        $resultado = mysqli_query($connect, $buscarSenha);
        while ($buscarCPF = mysqli_fetch_array($resultado)) {
            $existeCPF = $buscarCPF["CPF"];
        }

        if ($existeCPF == $request->cpf) {
            return redirect('/definirSenha')->with('cpf', $request->cpf);
        } else {
            return redirect()-> back()-> with('msg-sucess', 'O CPF digitado não está cadastrado!!');
        }

        return view('checarCPF');
    }

  
    /**
     * Função de redefinir a senha a partir do esqueci a senha
     *
     * @param  mixed $request
     * @return redirect()->route()->with()
     */
    public function definirSenha(Request $request)
    {
        include('db.php');

        $cpf = $request->cpf;
        $senhaDefinida = $request->senha;
        $senhaConfirmacao = $request->confirmacao;

        //se a nova senha desejada for igual a de confimação

        if ($senhaConfirmacao == $senhaDefinida) {
        
            //cria um hash a partir da nova senha
            $senhaCript = Hash::make($senhaConfirmacao);

            //atualiza senha no banco de dados
            $update = "UPDATE usuarios SET Senha = '$senhaCript' WHERE CPF = '$cpf'";
            mysqli_query($connect, $update);
            
            //log
            $ip = $_SERVER["REMOTE_ADDR"];
            $acao = "Usuário redefiniu senha";
            AdminController::salvarLog($acao, $ip);

            return redirect()->route('index')->with('msg-sucess', 'Senha alterada com sucesso!');
        }
    }


    /**
     * Função de listagem de medicamentos
     *
     * @return view()
     */
    public function listaMedicamento()
    {
        VerificaLoginController::verificarLogin();
        include("db.php");
        $resultado = VerificaLoginController::verificaPermissao(35);
        
        //verifica permissão, caso tenha obtem todos os agendamentos, se existem os dados são obtidos
        if ($resultado == "1") {
            $i = 0;
            $m = [];
            $sql = "SELECT * FROM medicamentos";
            $query = mysqli_query($connect, $sql);
            $verificaN = mysqli_num_rows($query);
            if ($verificaN > 0) {
                while ($sql = mysqli_fetch_array($query)) {
                    $m["nome".$i] = $sql['Nome_Medicam'];
                    $m["data".$i] = $sql['Data_Validade'];
                    $m["quantidade".$i] = $sql['Quantidade'];
                    $m["fabricante".$i] = $sql['Fabricante'];
                    $i = $i+1;
                }

                //log
                $ip = $_SERVER["REMOTE_ADDR"];
                $acao = "Visualizou lista de medicamentos";
                AdminController::salvarLog($acao, $ip);

                return view('listaMedicamento', ['m' => $m]); // retorna os dados dos medicamentos
            } else {
                return redirect()->back()->with('msg-error', 'Nenhuma informação encontrada na base de dados!!!');
            }
        } else {
            return redirect()->back()->with('msg-error', 'Você não tem acesso a essa página!!!');
        }
    }


    /**
     * Função de permissão de histórico de prontuário
     *
     * @return view()
     */
    public function historicoProntuario()
    {
        VerificaLoginController::verificarLogin();
        $perm = VerificaLoginController::verificaPermissao(34);
        if ($perm == "1") {
            return view('historicoProntuario');
        } else {
            return redirect()->back();
        }
    }


    /**
     * Função de salvar paciente no banco de dados
     *
     * @param  mixed $request
     * @return redirect()->route()->with()
     */
    public function salvarPaciente(Request $request)
    {
        session_start();
        include('db.php');

        //buscar paciente
        $existePac = mysqli_query($connect, "SELECT COUNT(*) FROM pacientes WHERE CPF = '$request->fcpf'");

        //se não existir o paciente
        if (mysqli_fetch_assoc($existePac)['COUNT(*)'] == 0) {

            //detecta data
            date_default_timezone_set('America/Sao_Paulo');
            $dataAtual = date('Y-m-d');

            if ($request->fcpf=='000.000.000-00' and ($request->fnascimento <= $dataAtual)) {
                return redirect()->route('cadastroPaciente')->with('error', "CPF inválido! Digite novamente.");
            } elseif ($request->fcpf=='000.000.000-00' and ($request->fnascimento > $dataAtual)) {
                return redirect()->route('cadastroPaciente')->with('error', "CPF e data de nascimento inválidos! Digite novamente.");
            } else {
                if ($request->fnascimento <= $dataAtual) {
                
                    //cria paciente e adiciona
                    $novoPac = "INSERT INTO pacientes (Nome_Paciente, Sexo, Data_Nasc, CPF, Tipo_Sang) values
                    ('$request->fnome', '$request->fsexo', '$request->fnascimento', '$request->fcpf', '$request->fsanguineo')";
                    mysqli_query($connect, $novoPac);
                    
                    $ip = $request->ip();
                    $acao = "Cadastrou paciente $request->fnome";
                    AdminController::salvarLog($acao, $ip);
    
                    return redirect()->route('cadastroPaciente')->with('success', "Paciente cadastrado com sucesso!");
                } else {
                    return redirect()->route('cadastroPaciente')->with('error', "Data de nascimento inválida! Digite novamente.");
                }
            }
        } else {
            //se existir o paciente cadastrado
            return redirect()->route('cadastroPaciente')->with('error', "Paciente já existente no banco de dados!!");
        }
    }


    /**
     * Função de permissão de acesso ao prontuário
     *
     * @param  mixed $request
     * @return view()
     */
    public function prontuario(Request $request)
    {
        //Essa função busca na tabela de pacientes,cids, medicamentos, e agendamentos os dados daquele paciente a partir das informações do prontuario
        include("db.php");
        VerificaLoginController::verificarLogin();
        $resultado = VerificaLoginController::verificaPermissao(19);
        $paciente=[];
        $agendamentos = [];
        $infosA = [];
        $infosM = [];
        $i = 0;
        $j = 0;
        $cpf = $request->cpf;
        if ($resultado == "1") {
            /*Inicio dos dados do paciente */
            $sql = "SELECT * FROM pacientes where CPF='$cpf'";
            $query = mysqli_query($connect, $sql);
            while ($sql = mysqli_fetch_array($query)) {
                $paciente['nome'] = $sql['Nome_Paciente'];
                $paciente['nascimento'] = $sql['Data_Nasc'];
                $paciente['sexo'] = $sql['Sexo'];
                $paciente['sangue'] = $sql['Tipo_Sang'];
                $paciente['estado'] = $sql['Estado'];
                $paciente['cpf'] = $cpf;
            }
            $sql = "SELECT * FROM prontuarios where ID ='$request->numero'";
            $query = mysqli_query($connect, $sql);
            while ($sql = mysqli_fetch_array($query)) {
                $paciente['internacao'] = $sql['Data_Internacao'];
                $paciente['leito'] = $sql['Id_leito'];
                $paciente['prontuario'] = $sql['ID'];
                $id = $paciente['prontuario'];
            }
            /*fim dos dados do paciente */

            /*inicio dos dados do agendamento */
            if (isset($id)) {
                $sql = "SELECT * FROM agendamentos WHERE ID_prontuario = '$id'";
                $query = mysqli_query($connect, $sql);
                while ($sql = mysqli_fetch_array($query)) {
                    $agendamentos = $sql['Codigo'];
                    $medicamento = $sql['Cod_medicamento'];
                    if ($sql['Realizado'] == 0) {
                        $infosA['hora'.$i] = $sql['Hora_Agend'];
                        $infosA['data'.$i] = $sql['Data_Agend'];
                        $infosA['posologia'.$i] = $sql['Posologia'];
                        $cpfuser = $sql['CPF_usuario'];
                        $sql1 = "SELECT * FROM medicamentos WHERE Codigo = '$medicamento'";
                        $query1 = mysqli_query($connect, $sql1);
                        while ($sql1 = mysqli_fetch_array($query1)) {
                            $infosA['medicamento'.$i] = $sql1['Nome_Medicam'];
                        }
                        if ($cpfuser != null) {
                            $bucaNomeAplicador = "SELECT * FROM usuarios WHERE CPF = '$cpfuser'";
                            $queryBusca = mysqli_query($connect, $bucaNomeAplicador);
                            while ($bucaNomeAplicador = mysqli_fetch_array($queryBusca)) {
                                $infosA['aplicador'.$i] = $bucaNomeAplicador['Nome'];
                            }
                        }
                        $i++;
                    }
                    if ($sql['Realizado'] == 1) {
                        /*inicio dos dados do medicamento */
                        $sql1 = "SELECT * FROM medicamentos WHERE Codigo = '$medicamento'";
                        $query1 = mysqli_query($connect, $sql1);
                        while ($sql1 = mysqli_fetch_array($query1)) {
                            $infosM['medicamento'.$j] = $sql1['Nome_Medicam'];
                        }
                        $infosM['hora'.$j] = $sql['Hora_Agend'];
                        $infosM['data'.$j] = $sql['Data_Agend'];
                        $infosM['posologia'.$j] = $sql['Posologia'];
                        $aplicador = $sql["CPF_usuario"];
                        $sql2 = "SELECT * FROM usuarios WHERE CPF = '$aplicador'";
                        $query2 = mysqli_query($connect, $sql2);
                        while ($sql2 = mysqli_fetch_array($query2)) {
                            $infosM['aplicador'.$j] = $sql2['Nome'];
                        }
                        $j++;
                    }
                }
                /*fim dos dados do agendamento e medicamento */

                //log
                $ip = $_SERVER["REMOTE_ADDR"];
                $acao = "Visualizou prontuário de paciente";
                AdminController::salvarLog($acao, $ip);

                /*inicio das ocorrências */
                $infosO = [];
                $k = 0;
                $sql3 = "SELECT * FROM ocorrencias WHERE ID_prontuario = '$request->numero'";
                $query3 = mysqli_query($connect, $sql3);
                while ($sql3 = mysqli_fetch_array($query3)) {
                    $infosO['data'.$k] = $sql3['Data_ocorr'];
                    $infosO['ocorrencia'.$k] = $sql3['Descricao'];
                    $infosO['hora'.$k] = $sql3['Hora_ocorr'];
                    $fun = $sql3['CPF'];
                    $sql4 = "SELECT * FROM usuarios where CPF = '$fun'";
                    $query4 = mysqli_query($connect, $sql4);
                    while ($sql4 = mysqli_fetch_array($query4)) {
                        $infosO['aplicador'.$k] = $sql4['Nome'];
                    }
                    $k++;
                }

                $infosC = [];
                $l = 0;
                $sql4 = "SELECT * FROM cid_prontuario WHERE id_prontuario = '$request->numero'";
                $query4 = mysqli_query($connect, $sql4);
                while ($sql4 = mysqli_fetch_array($query4)) {
                    $idcid = $sql4['id_CID'];
                    $sql5 = "SELECT * FROM cid WHERE id = $idcid";
                    $query5 = mysqli_query($connect, $sql5);
                    while ($sql5 = mysqli_fetch_array($query5)) {
                        $infosC['cid'.$l] = $sql5['codCid'];
                    }
                    $l++;
                }
            } else {
                return redirect()->back()->with('msg-error', 'Não foi possivel encontrar o prontuario no banco de dados!!!');
            }
            
            return view('prontuario', ['paciente' => $paciente, 'infosA' => $infosA, 'infosM' => $infosM, 'infosO' => $infosO, 'infosC' => $infosC, 'agendamentos' => $agendamentos]); // os dados obtidos são retornados para view
        } else {
            return redirect()->back()->with('msg-error', 'Você não tem acesso a essa página!!!');
        }
    }
    
    /**
     * Função para editar o prontuário
     *
     * @param  mixed $request
     * @return redirect()->back()->with()
     */
    public function editarProntuario(Request $request)
    {
        session_start();
        include("db.php");
        $msgAlteração = "Dados alterados: "; // Mensagem que indica itens do menu alterado
        $resultado = VerificaLoginController::verificaPermissao(20); // verifica se tem permição
        if ($resultado == 1) {
            $sql = "SELECT * FROM prontuarios where Cpfpaciente = '$request->cpfA' AND aberto = '1'";
            $query = mysqli_query($connect, $sql);
            if (mysqli_num_rows($query) == 1) { // verifica se encontrou algum prontuario na busca do bd
                if ($request->nomeA != $request->fnome) { // compara os dados pra ver se foram modificados
                    $msgAlteração .= "Nome,"; // caso este dado tenha sido alterado concatena o dado que foi modificado
                    $update = "UPDATE pacientes SET Nome_Paciente = '$request->fnome' WHERE CPF = '$request->cpfA'";
                    mysqli_query($connect, $update);// altera no d
                }
                if ($request->cpfA != $request->fcpf) {
                    $sqlp = "SELECT * FROM pacientes WHERE CPF = '$request->fcpf'";
                    $queryp = mysqli_query($connect, $sqlp);
                    if (mysqli_num_rows($queryp) == 0) {
                        $msgAlteração .= " CPF,";
                        $updatepac = "UPDATE pacientes SET CPF = '$request->fcpf' WHERE CPF = '$request->cpfA'";
                        mysqli_query($connect, $updatepac);
                        $updatepront = "UPDATE prontuarios SET Cpfpaciente = '$request->fcpf' WHERE CPF = '$request->cpfA' AND aberto = '1'";
                        mysqli_query($connect, $updatepront);
                    } else {
                        return redirect()->back()->with('msg-error', "CPF ja cadastrado no sistema!!!!");
                    }
                }
                if ($request->nascimentoA != $request->fnascimento) {
                    $msgAlteração .= " Data de nascimento,";
                    $update = "UPDATE pacientes SET Data_Nasc = '$request->fnascimento' WHERE CPF = '$request->cpfA'";
                    mysqli_query($connect, $update);
                }
                if ($request->leitoA != $request->fleito) {
                    $sqll = "SELECT * FROM leitos where Identificacao = '$request->fleito'";
                    $queryl = mysqli_query($connect, $sqll);
                    if (mysqli_num_rows($queryl) >= 1) {
                        while ($sqll = mysqli_fetch_array($queryl)) {
                            $ocupado = $sqll['Ocupado'];
                        }
                        if ($ocupado == 0) { // verifica se o leito requisitado para alteração esta ocupado
                            $msgAlteração .= " Leito";
                            $updateLeito = "UPDATE leitos SET Ocupado = '0' where Identificacao = '$request->leitoA'"; // desocupa o antigo
                            mysqli_query($connect, $updateLeito);
                            $updateLeito = "UPDATE leitos SET Ocupado = '1' where Identificacao = '$request->fleito'"; // ocupa o novo
                            mysqli_query($connect, $updateLeito);
                            $update = "UPDATE prontuarios SET id_leito = '$request->fleito' where Cpfpaciente = '$request->cpfA' AND aberto = '1'";
                            mysqli_query($connect, $update); // altera o prontuario do paciente
                        } else {
                            return redirect()->back()->with('msg-error', "O leito não pode ser alterado para o informado pois encontrasse ocupado");
                        }
                    } else {
                        return redirect()->back()->with('msg-error', "O leito foi o unico dado a não ser alterado pois não existe no nosso banco de dados!!!!");
                    }
                }

                return redirect()->back()->with('msg', $msgAlteração);
            } elseif (mysqli_num_rows($query) == 0) { // não encotrou nenum prontuario
                return redirect()->back()->with('msg-error', "Não existe prontuario cadastrado para este paciente!!!!!");
            } else { // cso de erro estremo onde o retorno é negativo por algum bug
                return redirect()->back()->with('msg-error', "Algo deu errado. Por favor tente novamente ou contate o suporte tecnico");
            }
        } else { // não tem permissão para acesso
            return redirect()->back()->with('msg-error', "Este prontuario não pode ser editado pois ja foi finalizado!!!!!");
        }
    }
    
    /**
     * Função para cadastrar o prontuário
     *
     * @param  mixed $request
     * @return redirect()->back()->with()
     */
    public function cadastrarProntuario(Request $request)
    {
        session_start();
        include("db.php");
        $resultado = VerificaLoginController::verificaPermissao(33);
        if ($resultado == 1) {
            $sql = "SELECT * FROM leitos where Identificacao = '$request->Leito'";
            $query = mysqli_query($connect, $sql);
            $temp = mysqli_fetch_array($query);
             
            //caso o Leito não esteja mais disponível
            if ($temp['Ocupado'] == 1) {
                return redirect()->back()->with('msg-error', 'O Leito não está mais disónível, tente novamente.');
            }
            // caso o Leito esteja disponível

            // verificar se o Paciente já pertence a um prontuário aberto
            $sql3 = "SELECT * FROM prontuarios WHERE Cpfpaciente = '$request->CPF_Paciente'";
            $query3 = mysqli_query($connect, $sql3);
       
            while ($dado = mysqli_fetch_array($query3)) {
                if ($dado['aberto'] == 1) {
                    return redirect()->back()->with('msg-error', 'O paciente já possuí um prontuário em aberto no sistema');
                }
            }

        
            // ocupar o leito
            $sql1 = "UPDATE leitos SET Ocupado = '1' WHERE Identificacao = '$request->Leito'";
            $query1 = mysqli_query($connect, $sql1);

            //cadastrar o prontuário
            $sql2 = "INSERT INTO prontuarios (aberto, Data_Internacao, Id_leito, Cpfpaciente) VALUES
                        ('1', '$request->data_internacao', '$request->Leito', '$request->CPF_Paciente')";
            $query2 = mysqli_query($connect, $sql2);
            if ($query2 == 1) {
                // se cadastrou com sucesso
                return redirect()->route('cadastroProntuario')->with('msg-sucess', 'Prontuário cadastrado com sucesso');
            } else {
                //caso não cadastre erro no bd
                return redirect()->back()->with('msg-error', 'Ocorreu um erro com o Banco de Dados tente novamente');
            }
        } else {
            return redirect()->back()->with('msg-error', 'Você não tem acesso a essa página!!!');
        }
    }


    /**
     * Função de buscar prontuário
     *
     * @param  mixed $request
     * @return view()
     */
    public function buscaProntuario(Request $request)
    {
        //função que obtem todos os prontuarios finalizados de determinado paciente de acordo com o cpf
        session_start();
        include("db.php");                  // inclusão do banco de dados
        $prontuario = [];                   // garantia de existência da variavel
        
        // busca do usuario no banco de dados
        $i = 0;
        $sql = "SELECT * FROM prontuarios where Cpfpaciente = '$request->cpf_user'";
        $query = mysqli_query($connect, $sql);
        $row = mysqli_num_rows($query);
        if ($row >= 1) {
            while ($sql = mysqli_fetch_array($query)) { //percorrendo array de usuarios com determinado cpf
                $sql1 = "SELECT * FROM pacientes where CPF = '$request->cpf_user'";
                $query1 = mysqli_query($connect, $sql1);
                $row1 = mysqli_num_rows($query1);
                if ($row1 >= 1) {
                    while ($sql1 = mysqli_fetch_array($query1)) {
                        if ($sql["aberto"]!= 1) { // se o prontuario ja foi fechado obtem os dados
                            $prontuario["id".$i] = $sql['ID'];
                            $prontuario["nome".$i] = $sql1["Nome_Paciente"];
                            $prontuario["estado".$i] = $sql1["Estado"];
                            $prontuario["cpf".$i] = $sql["Cpfpaciente"];
                            $prontuario["internacao".$i] = $sql["Data_Internacao"];
                            $prontuario["saida".$i] = $sql["Data_Saida"];
                            $i++;
                        } 
                    }
                } else {
                    return redirect()->back()->with('msg-error', 'O Paciente buscado não está cadastrado no sistema.');
                }
            }

            //log
            $ip = $_SERVER["REMOTE_ADDR"];
            $acao = "Buscou prontuário do paciente";
            AdminController::salvarLog($acao, $ip);

            return view('historicoProntuario', ['prontuario' => $prontuario]); // retorna os dados para serem exibidos na view
        } else {
            return redirect()->back()->with('msg-error', 'O Paciente buscado não possui prontuário.');
        }
    }


    /**
     * Função que busca um paciente para o cadastro de prontuário e também retorna os leitos disponíveis
     *
     * @param  mixed $request
     * @return view()
     */
    public function buscarPaciente(Request $request)
    {
        session_start();
        include("db.php");
        // BUSCANDO O PACIENTE
        $sql = "SELECT * FROM pacientes WHERE CPF = '$request->cpf_user'";
        $query = mysqli_query($connect, $sql);
        $paciente = mysqli_fetch_array($query);
       
        // BUSCANDO OS LEITOS
        $sql = "SELECT * FROM leitos";
        $query = mysqli_query($connect, $sql);
        $i = 0;
        $leitos = null;
        while ($dado = mysqli_fetch_array($query)) {
            if ($dado['Ocupado'] == 0) {
                $leitos[$i] = $dado;
            }

            $i++;
        }
        //FIM BUSCA DOS LEITOS

        if ($paciente == null) {
            return redirect()->back()->with('msg-error', 'Paciente não encontrado');
        } else {
            return view('cadastroProntuario', ['paciente' => $paciente, 'leitos'=>$leitos]);
        }
    }

    /**
     * Função para checar se prontuario foi finalizado
     *
     * @param  mixed $codigo
     * @return int
     */
    public static function estadoPronturio($codigo)
    {
        include("db.php");
        $aberto = null;

        //busca no banco de dados
        $sql = "SELECT * FROM prontuarios WHERE ID = '$codigo'"; // com o id fornecido
        $query = mysqli_query($connect, $sql);
        while ($sql = mysqli_fetch_array($query)) {
            $aberto = $sql['aberto']; //pega se o prontuario esta aberto ou não(1 para verdadeiro e 0 para falso)
        }
        return $aberto;
    }


    /**
     * Função de cadastrar cid em prontuário
     *
     * @param  mixed $request
     * @return redirect() -> back() ->with()
     */
    public function cadastrarCidProntuario(Request $request)
    {
        session_start();
        include("db.php");
        $c=0;
        $perm = VerificaLoginController::verificaPermissao(10); // verifica se tem a permissão
        if ($perm == "1") {
            $cid = null;
            $sql = "SELECT * FROM cid WHERE codCid = '$request->fcid'";
            $query = mysqli_query($connect, $sql);
            while ($sql = mysqli_fetch_array($query)) {
                $cid = $sql['id']; // procura cid com o mesmo codigo de identificação na tabela de cids para ver se existe
            }
            $aberto = HomeController::estadoPronturio($request->prontuario); // ve se o prontuario esta aberto
            if ($cid != null and $aberto == '1') { // se o prontuario esta aberto e a cid foi encontada
                $sql1 = "SELECT * FROM cid_prontuario WHERE id_CID = '$cid' AND id_prontuario = '$request->prontuario'"; // procura se ja tem uma cid naquele prontuario que seja igual a cid a ser cadastrada usando o id do prontuario
                $query1 = mysqli_query($connect, $sql1);
                while ($sql1 = mysqli_fetch_array($query1)) {
                    $igual = $sql1['id'];
                }
                if (isset($igual)) { // se existe da mensagem de erro
                    return redirect() -> back() ->with('msg-error', 'Esta CID já se encontra cadastrada no prontuario!!!!');
                } else { // se não ele cadastra a cid no prontuario e exibi mensagem de sucesso
                    $insert = "INSERT INTO cid_prontuario (id_CID,id_prontuario) VALUES ('$cid','$request->prontuario')";
                    mysqli_query($connect, $insert);
                    //log
                    $ip = $_SERVER["REMOTE_ADDR"];
                    $acao = "Cadastrou CID $cid ao prontuário nº $request->prontuario";
                    AdminController::salvarLog($acao, $ip);

                    return redirect() -> back() ->with('msg', 'CID adicionada ao prontuario com sucesso!!!!');
                }
            } elseif ($cid == null and $aberto == '1') {
                $descri = "Esta cid não possui descrição";
                $sqlc = "SELECT * FROM cid" ;
                $queryc = mysqli_query($connect, $sqlc);
                while ($sqlc = mysqli_fetch_array($queryc)) {
                    $c = $sqlc['id'];
                }
                $c++;
                $insertNC = "INSERT INTO cid (id,codCid,descricaoCid) VALUES ('$c','$request->fcid','$descri')";
                mysqli_query($connect, $insertNC);
                $sql = "SELECT * FROM cid WHERE codCid = '$request->fcid'";
                $query = mysqli_query($connect, $sql);
                while ($sql = mysqli_fetch_array($query)) {
                    $cid = $sql['id']; // procura cid com o mesmo codigo de identificação na tabela de cids para ver se existe
                }
                $insertC = "INSERT INTO cid_prontuario (id_CID,id_prontuario) VALUES ('$cid','$request->prontuario')";
                mysqli_query($connect, $insertC);
                return redirect() -> back() ->with('msg', 'CID não se encontrava na base de dados. Uma nova cid foi adicionada a base de dados e ao prontuario!!!!');
            } elseif ($aberto == '0' or $aberto == null) {
                return redirect() -> back() ->with('msg-error', 'Não pode haver cadastro de cids nesse prontuario pois ele se enconta fechado');
            } else {
                return redirect() -> back() ->with('msg-error', 'CID digitada não existe na base de dados');
            }
        } else {
            return redirect()->back();
        }
    }


    /**
     * Função de obter cpf
     *
     * @return char
     */
    public static function obterCpf()
    { // função para obter cpf do usuario logado
        $cpf = null;
        if (isset($_SESSION['administrador'])) {
            $cpf = $_SESSION['administrador'];
        } elseif (isset($_SESSION['enfermeiro'])) {
            $cpf = $_SESSION['enfermeiro'];
        } elseif (isset($_SESSION['enfermeiroChefe'])) {
            $cpf = $_SESSION['enfermeiroChefe'];
        } elseif (isset($_SESSION['estagiario'])) {
            $cpf = $_SESSION['estagiario'];
        }
        return $cpf; // retorna o cpf caso exista
    }


    /**
     * Função de adicionar ocorrencias em prontuário
     *
     * @param  mixed $request
     * @return redirect() -> back() ->with()
     */
    public function adicionarOcorrencias(Request $request)
    {
        session_start();
        include("db.php");
        $resultado = VerificaLoginController::verificaPermissao(28); // verificase tem permissão
        if ($resultado == 1) {
            $cod = 0;
            $aberto = HomeController::estadoPronturio($request->prontuario); // verifica se prontuario esta aberto
            date_default_timezone_set('America/Sao_Paulo');
            //obtem data e hora atual
            $data = date('Y-m-d');
            $hora = date('H:i:s');
            $nome = null;
            $cpf = HomeController::obterCpf(); // obtem cpf do funcionario para conseguir o nome
            $sql = "SELECT * FROM usuarios WHERE CPF = '$cpf'";
            $query = mysqli_query($connect, $sql);
            while ($sql = mysqli_fetch_array($query)) {
                $nome = $sql['Nome'];
            }
            if ($aberto == '1' and $nome!=null) { // se nome foi encontrado e prontuario aberto
                $sql = "SELECT * FROM ocorrencias";
                $query = mysqli_query($connect, $sql);
                while ($sql = mysqli_fetch_array($query)) {
                    $cod = $sql['Codigo'];
                }
                $cod++; // um novo codigo de ocorrencia e gerado acrescendo 1 ao mais recente antes dele
                // é inserido uma nova ocorrencia na tabela de ocorrencias com o id desse prontuario e o cpf do usuario
                $insert = "INSERT INTO ocorrencias (Codigo,Data_ocorr,Hora_ocorr,ID_prontuario,Descricao,CPF) VALUES ('$cod','$data','$hora','$request->prontuario','$request->focorrencia','$cpf')";
                mysqli_query($connect, $insert);

                //log
                $ip = $_SERVER["REMOTE_ADDR"];
                $acao = "Adicionou ocorrência ao prontuário nº $request->prontuario";
                AdminController::salvarLog($acao, $ip);

                return redirect() -> back() ->with('msg', 'Ocorrência adicionada ao prontuário com sucesso!!!!');
            } elseif ($nome == null) {
                return redirect() -> back()->with('msg-error', 'Seu cpf não foi encontrado na base de dados. Ocorrência não cadastrada');
            } else {
                return redirect() -> back() ->with('msg-error', 'Prontuário encontra-se fechado');
            }
        } else {
            return redirect() -> back() ->with('msg-error', 'Você não possui permissão para realizar essa ação');
        }
    }
     
    /**
     * função de finalizar prontuário
     *
     * @param  mixed $request
     * @return redirect() -> back() ->with()
     */
    public function finalizarProntuario(Request $request)
    {
        session_start();
        include("db.php");
        $dataA = date('Y-m-d');
        $aberto = HomeController::estadoPronturio($request->prontuario); // verifca se prontuario esta aberto
        if ($aberto == '1') { // se sim muda o estado dele para fechado
            $update = "UPDATE prontuarios SET aberto = '0', Data_Saida = '$dataA' WHERE ID = '$request->prontuario'";
            mysqli_query($connect, $update);
            $sql = "SELECT * FROM prontuarios WHERE ID = '$request->prontuario'";
            $query =  mysqli_query($connect, $sql);
            while ($sql = mysqli_fetch_array($query)) {
                // obtem o leito e o cpf do paciente a partir do  id do prontuario
                $leito = $sql['Id_leito'];
                $cpf = $sql['Cpfpaciente'];
            }
            $update = "UPDATE leitos SET Ocupado = '0'  WHERE Identificacao = '$leito'"; // remove a ocupação do leito(muda o valor de 1 para 0)
            mysqli_query($connect, $update);
            $update = "UPDATE pacientes SET Estado = '$request->status_saida'  WHERE CPF = '$cpf'"; // muda o status do paciente para o status selecionado na parte de finalização
            mysqli_query($connect, $update);
            //log
            $ip = $_SERVER["REMOTE_ADDR"];
            $acao = "Finalizou prontuário nº $request->prontuario";
            AdminController::salvarLog($acao, $ip);

            return redirect() -> back() ->with('msg', 'Este prontuario foi fechado');
        } else {
            return redirect() -> back() ->with('msg-error', 'Este prontuario ja encontrasse fechado');
        }
    }


    /**
     * Função de baixar arquivos de listagem
     *
     * @param  mixed $request
     * @return void
     */
    public function baixarArquivos(Request $request)
    {
        session_start();
        include("db.php");
        $cpf = HomeController::obterCpf(); // obtendo cpf do usuario
        $vetor = explode('|', $request->listagem); //transformando string de dados obtidos da página em vetor
        $lista = ''; // inicialização da string que sera usada para escrita
        $sql = "SELECT * from usuarios where CPF = '$cpf'";
        $query = mysqli_query($connect, $sql);
        while ($sql = mysqli_fetch_array($query)) {
            $nome = $sql['Nome']; // obter nome do usuario a partir do cpf
        };
        $css = file_get_contents("../public/css/download-style.css"); // caminho do css
        $mpdf =  new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'Legal']); // nova instancia da biblioteca que gera pdm
        date_default_timezone_set('America/Sao_Paulo');
        $data_a = date('d-m-y - h:i:s'); //data e hora atual obtida
        //$mpdf->WriteHTML($css,\Mpdf\HTMLParserMode::HEADER_CSS);
        if ($request->tela == 'log') {
            $contador = 0;
            $sql = "SELECT * from logs";
            $query = mysqli_query($connect, $sql);
            while ($sql = mysqli_fetch_array($query)) {
                $vetor[$contador]= $sql['Ip'];
                $vetor[$contador + 1]= $sql['Data_Log'];
                $vetor[$contador + 2]= $sql['Hora_Agend'];
                $vetor[$contador + 3]= $sql['Acao'];
                $vetor[$contador + 4]= $sql['CPF'];
                $contador = $contador + 5;
            };

            for ($i = count($vetor)-1; $i >= 0;$i--) {
                if ($i % 5 == 0) {
                    $lista =  $lista.'
                    <tr> <!--Cada Log-->
                        <td>'.$vetor[$i+4].'</td>
                        <td>'.$vetor[$i].'</td>
                        <td>'.$vetor[$i+1].'</td>
                        <td>'.$vetor[$i+2].'</td>
                        <td>'.$vetor[$i+3].'</td>
                    </tr>
                    ';
                }
            }
            $mpdf->WriteHTML('<!doctype html>
                <html lang="en">
                <style>'.$css.'</style>
                    <body>
                        <header class="container-personal-data">
                            <div>
                                <h2>Hospital Universitário da UEFS</h2> 
                            </div>
                            <div>
                                <h2>'.$nome.' / '.$cpf.'</h2> <!--Nome e CPF de quem requisitou o download-->
                            </div>
                            <div>
                                <h2>'.$data_a.'</h2> <!--Data e Hora em que foi feito o download-->
                            </div>
                        </header>
                        <hr>
                        <section>
                            <div class="container-header"> 
                                <h1>Logs</h1> <!--De onde saiu a lista-->
                            </div>
                            <hr>
                            <div class="container-listagem">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>CPF</th>
                                            <th>IP</th>
                                            <th>Data</th>
                                            <th>Hora do Log</th>
                                            <th>Ação</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        '.$lista.'
                                    </tbody>
                                </table>
                            </div>
                        </section>
                        <footer style="position: absolute; bottom: 0;">
                            <p id="Copyright">Informações para o Footer da página</p> <!--Caso queira deixar alguma informação no Footer-->
                        </footer>
                    </body>');
            $mpdf->Output('log'.$data_a.'.pdf', \Mpdf\Output\Destination::DOWNLOAD);
        } else { // listas gerais
            //ultizam dados obtidos da página para concatenar na string
            // IFs dentro dos FORs são para pegar posições estrategicas de cada vetor de acordo com o numero de dados que ele possui de cada instancia
            //variavel de string concatenada junto com tabelas para ficar organizado
            // Função  writeHTML função onde vc passa o html da página que sera impressa os dados concatenado com o estilo do css
            if ($request->tela == 'lp') { // lista de pacientes
                $sql = "SELECT *  from pacientes where Nome_Paciente = '$request->numero'";
                $query = mysqli_query($connect, $sql);
                while ($sql = mysqli_fetch_array($query)) {
                    $estado = $sql['Estado'];
                };
                for ($i = 0; $i < count($vetor);$i++) {
                    if ($i % 2 == 0) {
                        $lista =  $lista.'<tr><td>'.$vetor[$i].'</td><td>'.$estado.'</td></tr>';
                    }
                }
                $mpdf->WriteHTML('<!doctype html>
                <html lang="en">
                <style>'.$css.'</style>
                    <body>
                        <header class="container-personal-data">
                            <div>
                                <h2>Hospital Universitário da UEFS</h2>
                            </div>
                            <div>
                                <h2>'.$nome.' / '.$cpf.'</h2> <!--Nome e CPF de quem requisitou o download-->
                            </div>
                            <div>
                                <h2>'.$data_a.'</h2> <!--Data e Hora em que foi feito o download-->
                            </div>
                        </header>
                        <hr>
                        <section>
                            <div class="container-header"> 
                                <h1>Pacientes e Prontuários</h1> <!--De onde saiu a lista-->
                            </div>
                            <hr>
                            <div class="container-listagem">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>'.$lista.'
                                       
                                    </tbody>
                                </table>
                            </div>
                        </section>
                        <footer style="position: absolute; bottom: 0;">
                            <p id="Copyright">Informações para o Footer da página</p> <!--Caso queira deixar alguma informação no Footer-->
                        </footer>
                    </body>');
                $mpdf->Output('Paciente_Prontuario'.$data_a.'.pdf', \Mpdf\Output\Destination::DOWNLOAD);
            } elseif ($request->tela == 'lm') {// lista de medicamentos
                for ($i =  0; $i <= count($vetor)-1;$i++) {
                    if ($i%4 ==0) {
                        $lista =$lista.
                        '<tr>
                        <td>'.$vetor[$i].'</td>
                        <td>'.$vetor[$i+3].'</td>
                        <td>'.$vetor[$i+1].'</td>
                        <td>'.$vetor[$i+2].'</td>
                        </tr>';
                    }
                }
                $mpdf->WriteHTML('<!doctype html>
                <html lang="en">
                <style>'.$css.'</style>
                    <body>
                        <header class="container-personal-data">
                            <div>
                                <h2>Hospital Universitário da UEFS</h2>
                            </div>
                            <div>
                                <h2>'.$nome.' / '.$cpf.'</h2> <!--Nome e CPF de quem requisitou o download-->
                            </div>
                            <div>
                                <h2>'.$data_a.'</h2> <!--Data e Hora em que foi feito o download-->
                            </div>
                        </header>
                        <hr>
                        <section>
                            <div class="container-header"> 
                            <section>
                                <h1>Medicamentos</h1> <!--De onde saiu a lista-->
                            </div>
                            <hr>
                            <div class="container-listagem">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Nome Medicamento</th>
                                            <th>Nome do Fabricante</th>
                                            <th>Data de Validade</th>
                                            <th>Quantidade</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        '.$lista.'
                                    </tbody>
                                </table>
                            </div>
                        </section>
                        <footer style="position: absolute; bottom: 0;">
                            <p id="Copyright">Informações para o Footer da página</p> <!--Caso queira deixar alguma informação no Footer-->
                        </footer>
                    </body>');
                $mpdf->Output('Listagem_Medicamentos'.$data_a.'.pdf', \Mpdf\Output\Destination::DOWNLOAD);
            } elseif ($request->tela == 'lr') { // lista de responsaveis
                for ($i =  0; $i <= count($vetor)-1;$i++) {
                    if ($i%8 ==0) {
                        $lista =$lista.
                        '<tr> <!--Cada Responsável-->
                        <td>'.$vetor[$i+7].'</td>
                        <td>'.$vetor[$i+4].'</td>
                        <td>'.$vetor[$i].' - '.$vetor[$i+1].'</td>
                        <td>'.$vetor[$i+6].'</td>
                        <td>'.$vetor[$i+3].'</td>
                        <td>'.$vetor[$i+2].'</td>
                        </tr>';
                    }
                }
                
                $mpdf->WriteHTML('<!doctype html>
                <html lang="en">
                <style>'.$css.'</style>
                    <body>
                        <header class="container-personal-data">
                            <div>
                                <h2>Hospital Universitário da UEFS</h2>
                            </div>
                            <div>
                                <h2>'.$nome.' / '.$cpf.'</h2> <!--Nome e CPF de quem requisitou o download-->
                            </div>
                            <div>
                                <h2>'.$data_a.'</h2> <!--Data e Hora em que foi feito o download-->
                            </div>
                        </header>
                        <hr>
                        <section>
                            <div class="container-header"> 
                                <h1>Responsáveis</h1> <!--De onde saiu a lista-->
                            </div>
                            <hr>
                            <div class="container-listagem">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Nome do Responsável</th>
                                            <th>Leito</th>
                                            <th>Hora - Data</th>
                                            <th>Nome do Paciente</th>
                                            <th>Remedio</th>
                                            <th>Quantidade Remedio</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    '.$lista.'
                                    </tbody>
                                </table>
                            </div>
                        </section>
                        <footer style="position: absolute; bottom: 0;">
                            <p id="Copyright">Informações para o Footer da página</p> <!--Caso queira deixar alguma informação no Footer-->
                        </footer>
                    </body>');
                $mpdf->Output('Listagem_Responsaveis'.$data_a.'.pdf', \Mpdf\Output\Destination::DOWNLOAD);
            } elseif ($request->tela == 'la') { // lista de agendamentos
                for ($i =  0; $i <= count($vetor)-1;$i++) {
                    if ($i%8 ==0) {
                        $lista =$lista.
                        '<tr> <!--Cada Agendamento-->
                            <td>'.$vetor[$i+4].'</td>
                            <td>'.$vetor[$i].' - '.$vetor[$i+1].'</td>
                            <td>'.$vetor[$i+6].'</td>
                            <td>'.$vetor[$i+3].'</td>
                            <td>'.$vetor[$i+2].'</td>
                        </tr>';
                    }
                }
                
                $mpdf->WriteHTML('<!doctype html>
                <html lang="en">
                <style>'.$css.'</style>
                    <body>
                        <header class="container-personal-data">
                            <div>
                                <h2>Hospital Universitário da UEFS</h2>
                            </div>
                            <div>
                                <h2>'.$nome.' / '.$cpf.'</h2> <!--Nome e CPF de quem requisitou o download-->
                            </div>
                            <div>
                                <h2>'.$data_a.'</h2> <!--Data e Hora em que foi feito o download-->
                            </div>
                        </header>
                        <hr>
                        <section>
                            <div class="container-header"> 
                                <h1>Agendamentos</h1> <!--De onde saiu a lista-->
                            </div>
                            <hr>
                            <div class="container-listagem">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Leito</th>
                                            <th>Hora - Data</th>
                                            <th>Nome do Paciente</th>
                                            <th>Remedio</th>
                                            <th>Quantidade Remedio</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        '.$lista.'
                                    </tbody>
                                </table>
                            </div>
                        </section>
                        <footer style="position: absolute; bottom: 0;">
                            <p id="Copyright">Informações para o Footer da página</p> <!--Caso queira deixar alguma informação no Footer-->
                        </footer>
                    </body>');
                $mpdf->Output('Listagem_Agendamentos'.$data_a.'.pdf', \Mpdf\Output\Destination::DOWNLOAD);
            } elseif ($request->tela == 'hp') { // historico de prontuario
                for ($i =  0; $i <= count($vetor)-1;$i++) {
                    if ($i%6 ==0) {
                        $lista =$lista.
                        '<tr> <!--Cada Prontuário-->
                        <td>'.$vetor[$i].'</td> <!--Numero do Prontuário-->
                        <td>'.$vetor[$i+4].'</td> <!--Data de Internação-->
                        <td>'.$vetor[$i+5].'</td> <!--Data de Saída-->
                        <td>'.$vetor[$i+2].'</td> <!--Motivo-->
                        </tr>';
                    }
                }
                
                $mpdf->WriteHTML('<!doctype html>
                <html lang="en">
                <style>'.$css.'</style>
                <body>
                <header class="container-personal-data">
                            <div>
                                <h2>Hospital Universitário da UEFS</h2>
                            </div>
                            <div>
                                <h2>'.$nome.' / '.$cpf.'</h2> <!--Nome e CPF de quem requisitou o download-->
                            </div>
                            <div>
                                <h2>'.$data_a.'</h2> <!--Data e Hora em que foi feito o download-->
                            </div>
                        </header>
                <hr>
                <section>
                    <div class="container-header"> 
                        <h1>Historico de Prontuarios</h1> <!--De onde saiu a lista-->
                    </div>
                    <hr>
                    <div>
                        <p><span>'.$vetor[1].'</span> - <span>'.$vetor[3].'</span></p>
                    </div>
                    <div class="container-listagem">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th> <!--Numero do Prontuário-->
                                    <th>Data de Internação</th>
                                    <th>Data de Saída</th>
                                    <th>Motivo</th>
                                </tr>
                            </thead>
                            <tbody>
                            '.$lista.'
                            </tbody>
                        </table>
                    </div>
                </section>
                <footer style="position: absolute; bottom: 0;">
                    <p id="Copyright">Informações para o Footer da página</p> <!--Caso queira deixar alguma informação no Footer-->
                </footer>
            </body>');
                $mpdf->Output('Historico_Prontuario'.$data_a.'.pdf', \Mpdf\Output\Destination::DOWNLOAD);
            } elseif ($request->tela == 'rg') {
                $mpdf->WriteHTML('<!doctype html>
                <html lang="en">
                <style>'.$css.'</style>
                    <body>
                        <header class="container-personal-data">
                            <div>
                                <h2>Hospital Universitário da UEFS</h2>
                            </div>
                            <div>
                                <h2>'.$nome.' / '.$cpf.'</h2> <!--Nome e CPF de quem requisitou o download-->
                            </div>
                            <div>
                                <h2>'.$data_a.'</h2> <!--Data e Hora em que foi feito o download-->
                            </div>
                        </header>
                        <hr>
                        <section>
                            <div class="container-header"> 
                                <h1>Tabela - Relatorio Gerencial</h1> <!--De onde saiu a lista-->
                            </div>
                            <hr>
                            <div class="container-listagem">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Pacientes Internados</th>
                                            <th>Funcionários Cadastrados</th>
                                            <th>CID mais frequente</th>
                                            <th>Taxa de óbito</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr> 
                                            <td>'.$vetor[0].'</td> <!--Pacientes Internados-->
                                            <td>'.$vetor[1].'</td> <!--Funcionários Cadastrados-->
                                            <td>'.$vetor[2].'</td> <!--CID mais frequente-->
                                            <td>'.$vetor[3].'% </td> <!--Taxa de óbito-->
                                        </tr>
                                        <tr>
                                            <th>Idade Media entre Pacientes</th>
                                            <th>Medicamento mais usado</th>
                                            <th>Quantidade de Leitos Cadastrados</th>
                                            <th>Quantidade de Leitos Ocupados</th>
                                        </tr>
                                        <tr> 
                                            <td>'.$vetor[4].' anos </td> <!--Idade Media entre Pacientes-->
                                            <td>'.$vetor[5].'</td> <!--Medicamento mais usado-->
                                            <td>'.$vetor[6].'</td> <!--Quantidade de Leitos Cadastrados-->
                                            <td>'.$vetor[7].'</td> <!--Quantidade de Leitos Ocupados-->
                                        </tr>
                                        <tr>
                                            <th>Enfermeiros Chefes Ativos</th>
                                            <th>Enfermeiros Ativos</th>
                                            <th>Estagiários Ativos</th>
                                            <th>Administradores Cadastrados</th>
                                        </tr>
                                        <tr> 
                                            <td>'.$vetor[8].'</td> <!--Enfermeiros Chefes Ativos-->
                                            <td>'.$vetor[9].'</td> <!--Enfermeiros Ativos-->
                                            <td>'.$vetor[10].'</td> <!--Estagiários Ativos-->
                                            <td>'.$vetor[11].'</td> <!--Administradores Cadastrados-->
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </section>
                    <footer style="position: absolute; bottom: 0;">
                        <p id="Copyright">Informações para o Footer da página</p> <!--Caso queira deixar alguma informação no Footer-->
                    </footer>
                    </body>');
                $mpdf->Output('Relatorio_Gerencial'.$data_a.'.pdf', \Mpdf\Output\Destination::DOWNLOAD);
            } elseif ($request->tela == 'lpt') {
                for ($i =  0; $i <= count($vetor)-1;$i++) {
                    if ($i%2 ==0) {
                        $lista =$lista.
                        '<tr>
                        <th>'.$vetor[$i].'</td> 
                        <th>'.$vetor[$i+1].'</td> 
                        </tr>';
                    }
                }
                
                $mpdf->WriteHTML('<!doctype html>
                <html lang="en">
                <style>'.$css.'</style>
                <body>
                <header class="container-personal-data">
                            <div>
                                <h2>Hospital Universitário da UEFS</h2>
                            </div>
                            <div>
                                <h2>'.$nome.' / '.$cpf.'</h2> <!--Nome e CPF de quem requisitou o download-->
                            </div>
                            <div>
                                <h2>'.$data_a.'</h2> <!--Data e Hora em que foi feito o download-->
                            </div>
                        </header>
                <hr>
                <section>
            <div class="container-header"> 
                <h1>Listagem Plantonista</h1> <!--De onde saiu a lista-->
            </div>
            <hr>
            <div class="container-listagem">
                <table>
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Cargo</th>
                        </tr>
                    </thead>
                    <tbody>
                        '.$lista.'
                    </tbody>
                </table>
            </div>
        </section>
                <footer style="position: absolute; bottom: 0;">
                    <p id="Copyright">Informações para o Footer da página</p> <!--Caso queira deixar alguma informação no Footer-->
                </footer>
            </body>');
                $mpdf->Output('Listagem_Plantonistas'.$data_a.'.pdf', \Mpdf\Output\Destination::DOWNLOAD);
            } elseif ($request->tela == 'prontuario') {
                $listaP = '';
                $listaP2 = '';
                $listaA = '';
                $listaM = '';
                $listaC = '';
                $listaO = '';
                $vetorP = explode('|', $request->listagemP); //transformando string de dados obtidos da página em vetor
                $vetorA = explode('|', $request->listagemA); //transformando string de dados obtidos da página em vetor
                $vetorM = explode('|', $request->listagemM); //transformando string de dados obtidos da página em vetor
                $vetorO = explode('|', $request->listagemO); //transformando string de dados obtidos da página em vetor
                $vetorC = explode('|', $request->listagemC); //transformando string de dados obtidos da página em vetor
                for ($i =  0; $i <= count($vetorP)-1;$i++) {
                    if ($i%9 ==0) {
                        $listaP =$listaP.
                        '<tr> <!--Cada Paciente-->
                            <td>'.$vetorP[$i].'</td>
                            <td>'.$vetorP[$i+5].'</td>
                            <td>'.$vetorP[$i+2].'</td>
                            <th>'.$vetorP[$i+1].'</th>
                            <td>'.$vetorP[$i+3].'</td>
                        </tr>';
                        $prontuarioID = $vetorP[$i+8];
                        $sql = "SELECT * FROM prontuarios WHERE ID ='$prontuarioID'";
                        $query = mysqli_query($connect, $sql);
                        while ($sql = mysqli_fetch_array($query)) {
                            $saiu = $sql['Data_Saida'];
                        };
                        $listaP2 = $listaP2.
                        '<tr>
                            <td>'.$vetorP[$i+6].'</td>
                            <td>'.$saiu.'</td>
                            <td>'.$vetorP[$i+7].'</td>
                            <td>'.$vetorP[$i+4].'</td>
                        </tr>';
                    }
                }

                for ($i =  0; $i <= count($vetorA)-1;$i++) {
                    if (count($vetorA)>1) {
                        if (count($vetorA) == 5) {
                            if ($i%5 ==0) {
                                $listaA =$listaA.
                            '<tr>
                            <td>'.$vetorA[$i].'</td>
                            <td>'.$vetorA[$i+1].'</td>
                            <td>'.$vetorA[$i+3].'</td>
                            <td>'.$vetorA[$i+2].'ml </td>
                            <td>'.$vetorA[$i+4].'</td>
                            </tr>';
                            }
                        } elseif (count($vetorA) == 4) {
                            if ($i%4 ==0) {
                                $listaA =$listaA.
                            '<tr>
                            <td>'.$vetorA[$i].'</td>
                            <td>'.$vetorA[$i+1].'</td>
                            <td>'.$vetorA[$i+3].'</td>
                            <td>'.$vetorA[$i+2].'ml </td>
                            <td>Agendamento sem preparador alocado</td>
                            </tr>';
                            }
                        }
                    }
                }

                for ($i =  0; $i <= count($vetorM)-1;$i++) {
                    if (count($vetorM)>1) {
                        if ($i%5 ==0) {
                            $listaM =$listaM.
                        '<tr>
                        <td>'.$vetorM[$i+1].'</td>
                        <td>'.$vetorM[$i+2].'</td>
                        <td>'.$vetorM[$i].'</td>
                        <td>'.$vetorM[$i+3].'ml </td>
                        <td>'.$vetorM[$i+4].'</td>
                        </tr>';
                        }
                    }
                }

                for ($i =  0; $i <= count($vetorO)-1;$i++) {
                    if (count($vetorO)>1) {
                        if ($i%4 ==0) {
                            $listaO =$listaO.
                            '<tr>
                            <td>'.$vetorO[$i+2].'</td>
                            <td>'.$vetorO[$i].'</td>
                            <td>'.$vetorO[$i+3].'</td>
                            <td>'.$vetorO[$i+1].'</td>
                            </tr>';
                        }
                    }
                }

                for ($i =  0; $i <= count($vetorC)-1;$i++) {
                    if (count($vetorC)>1) {
                        $cod = $vetorC[$i];
                        $sql = "SELECT * FROM cid WHERE codCid ='$cod'";
                        $query = mysqli_query($connect, $sql);
                        while ($sql = mysqli_fetch_array($query)) {
                            $desc = $sql['descricaoCid'];
                        };
                        $listaC =$listaC.
                        '<tr>
                            <td>'.$cod.'</td>
                            <td>'.$desc.'</td>
                        </tr>';
                    }
                }
                
                $mpdf->WriteHTML('<!doctype html>
                <html lang="en">
                <style>'.$css.'</style>
                <body>
                <header class="container-personal-data">
                            <div>
                                <h2>Hospital Universitário da UEFS</h2> <!--Nome do nosso Hospital-->
                            </div>
                            <div>
                                <h2>'.$nome.' / '.$cpf.'</h2> <!--Nome e CPF de quem requisitou o download-->
                            </div>
                            <div>
                                <h2>'.$data_a.'</h2> <!--Data e Hora em que foi feito o download-->
                            </div>
                        </header>
                <hr>
                <section>
                    <div class="container-header"> 
                        <h1>Prontuário</h1> <!--De onde saiu a lista-->
                    </div>
                    <hr>
                    <div class="container-listagem">
                        <h2>Paciente</h2>
                        <table> <!--Paciente-->
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>CPF</th>
                                    <th>Sexo</th>
                                    <th>Data de Nascimento</th>
                                    <th>Tipo Sanguíneo</th>
                                </tr>
                            </thead>
                            <tbody>
                                '.$listaP.'
                            </tbody>
                        </table>
                        <hr>
                        <h2>Dados sobre internação</h2>
                        <table>
                            <thead>
                                <tr>
                                    <th>Data Internação</th>
                                    <th>Data Saida</th>
                                    <th>Leito</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                '.$listaP2.'
                            </tbody>
                        </table>
                        <hr>
                        <h2>Agendamentos</h2>
                        <table>
                            <thead>
                                <tr>
                                    <th>Hora</th>
                                    <th>Data</th>
                                    <th>Medicamento</th>
                                    <th>Posologia</th>
                                    <th>Aplicador</th>
                                </tr>
                            </thead>
                            <tbody>
                                '.$listaA.'
                            </tbody>
                        </table>
                        <hr>
                        <h2>Medicações ministradas</h2>
                        <table>
                            <thead>
                                <tr>
                                    <th>Hora</th>
                                    <th>Data</th>
                                    <th>Medicamento</th>
                                    <th>Posologia</th>
                                    <th>Aplicador</th>
                                </tr>
                            </thead>
                            <tbody>
                                '.$listaM.'
                            </tbody>
                        </table>
                        <hr>
                        <h2>Ocorrências</h2>
                        <table>
                            <thead>
                                <tr>
                                    <th>Hora</th>
                                    <th>Data</th>
                                    <th>Responsável</th>
                                    <th>Ocorrências</th>
                                </tr>
                            </thead>
                            <tbody>
                                '.$listaO.'
                            </tbody>
                        </table>
                        <hr>
                        <h2>CIDs</h2>
                        <table>
                            <thead>
                                <tr>
                                    <th>CIDs</th>
                                    <th>Descrição</th>
                                </tr>
                            </thead>
                            <tbody>
                                '.$listaC.'
                            </tbody>
                        </table>
                    </div>
                </section>
            </body>');
                $mpdf->Output('Prontuario: '.$vetorP[0].'-'.$data_a.'.pdf', \Mpdf\Output\Destination::DOWNLOAD);
            }
        }
    }
    
    /**
     * Função para notificar o usuario do seu agendamento
     *
     * @return void
     */
    public static function notificarUsuarioAgendamento()
    { // função estatica para notificação. Deve ser chamada usando funcionalidade de chamad automatica da hospedagem
        session_start();
        include("db.php");
        //obtem data e hora atual
        date_default_timezone_set('America/Sao_Paulo');
        $hora = date('H-i-s');
        $data = date('Y-m-d');
        $cpf = HomeController::ObterCpf();
        $sql = "SELECT * FROM agendamentos WHERE CPF_usuario = '$cpf'"; // verifica se o usuario logado tem agendamento
        $query = mysqli_query($connect, $sql);
        while ($sql= mysqli_fetch_array($query)) {
            if ($sql['Realizado'] == 0) {
                $prontuario = $sql['ID_prontuario'];
                $sql1 = "SELECT * FROM prontuarios WHERE ID = '$prontuario'";
                $query1 = mysqli_query($connect, $sql1);
                while ($sql1= mysqli_fetch_array($query1)) {
                    $leito = $sql1['Id_leito'];
                }
                if ($data == $sql['Data_Agend'] and $hora == $sql['Hora_Agend']) { //verifica se as datas e horas cadastradas e obtidas batem e se sim manda a notificação
                    $_SESSION['notifi'] = 'Você tem o agendamento marcado para o leiot:'.$leito;
                }
                //OBS - Adicionar um css tbm de msg-notification assim como tem pra sucess e error e colocar em todas as páginas no inicio do body
            }
        }
    }
    
    /**
     * Função de apagarN
     *
     * @return void
     */
    public function apagarN()
    {
        $_SESSION['notify'] = array();
        return redirect()->back();
    }
}
