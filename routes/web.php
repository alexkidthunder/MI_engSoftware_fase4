<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EnfChefeController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*------------ Rota para Index ------------------------ */

Route::get('/', [HomeController::class, 'index'])->name('index');

/*------------ Rota do login------------------------ */

Route::post('/primeiroAcesso', [HomeController::class, 'primeiroAcesso'])->name('primeiroAcesso');
Route::get('/primeiroAcesso', [HomeController::class, 'acessarPrimeiroAcesso'])->name('acessarPrimeiroAcesso');
Route::post('index/menu', [HomeController::class, 'login']);
Route::get('/esqueciSenha', [HomeController::class, 'esqueciSenha'])->name('esqueciSenha');

/*-------------------Rota para logout----------------- */

Route::get('/logout', [HomeController::class, 'logout'])->name('logout');

/*------------ Rota para sessao ------------------------ */

Route::get('/verificarLoginAdmin', [VerificaLoginController::class, 'verificarLoginAdmin'])->name('verificarLoginA');
Route::get('/verificarLoginEnfC', [VerificaLoginController::class, 'verificarLoginEnfC'])->name('verificarLoginEC');
Route::get('/verificarLoginEnf', [VerificaLoginController::class, 'verificarLoginEnf'])->name('verificarLoginE');
Route::get('/verificarLoginEst', [VerificaLoginController::class, 'verificarLoginEst'])->name('verificarLoginEst');
Route::get('/verificarLogin', [VerificaLoginController::class, 'verificarLogin'])->name('verificarLogin');

/*------------ Rota para o perfil ------------------------ */

Route::get('/meuPerfil', [HomeController::class, 'editPerfil'])->name('editarPerfil');
Route::post('/alterarDados', [HomeController::class, 'alterarDados']);
Route::post('/alterarSP', [HomeController::class, 'alterarSenhaPerfil']);

/*------------ Rotas do administrador ------------------ */

Route::get('/menuAdm', [AdminController::class, 'menu'])->name('menuAdm');
Route::get('/log', [AdminController::class, 'log'])->name('log');
Route::get('/editarAtribuicao', [AdminController::class, 'atribuicao'])->name('editarAtribuicao');
Route::get('/editarPermissao', [AdminController::class, 'permissao'])->name('editarPermissao');
Route::get('/alterarPermissao', [AdminController::class, 'alterarPermissao'])->name('alterarPermissao');
Route::get('/backup', [AdminController::class, 'backup'])->name('backup');
Route::get('/cadastrarUsuario', [AdminController::class, 'cadastro'])->name('cadastrarUsuario');
Route::post('/cadastrarUsuario', [AdminController::class, 'salvarUsuario'])->name('salvarUsuario'); //Antes estava como comentário de linha 
Route::get('/removerUsuario', [AdminController::class, 'remocao'])->name('removerUsuario');
Route::get('/buscarUsuario', [AdminController::class, 'busca'])->name('buscarUsuario');
Route::post('/alterarAtribuicao', [AdminController::class, 'alterarAtribuicao'])->name('alterarAtribuicao'); // rota para alterar atribuição
Route::post('/agendarBd', [AdminController::class, 'cadastrarBD']);
Route::get('/RagendarBd', [AdminController::class, 'removerAgendamentoBackup']);
Route::get('/baixarBd', [AdminController::class, 'realizarBackup']);
Route::get('/relatorioGerencial', [AdminController::class, 'relatorioGerencial'])->name('relatorioGerencial');

/*------------ Rota para Busca ------------------------ */

Route::get('/lupinha', [AdminController::class, 'lupinha'])->name('lupinha');
Route::get('/hp', [HomeController::class, 'buscaProntuario']);

/*------------ Rota para Paciente e Prontuário------------------------ */

Route::get('/listaPacientes', [HomeController::class, 'listaPacientes'])->name('pacientes');
Route::get('/prontuario', [HomeController::class, 'prontuario'])->name('prontuario');
Route::get('/historicoDeProntuario', [HomeController::class, 'historicoProntuario'])->name('historicoProntuario');
Route::get('/buscarPaciente', [HomeController::class, 'buscarPaciente'])->name('buscarPaciente');
Route::post('/cadastroCID', [HomeController::class, 'cadastrarCidProntuario']);
Route::post('/cadastroOcorr', [HomeController::class, 'adicionarOcorrencias']);
Route::post('/finalizarProntuario', [HomeController::class, 'finalizarProntuario']);

/*Atenção*/Route::post('/editarProntuario', [HomeController::class, 'editarProntuario']); // Não está sendo mais utilizada

/*------------ Rota para cadastro de paciente  e prontuário------------------------ */

Route::get('/cadastroPaciente', [HomeController::class, 'cadastroPaciente'])->name('cadastroPaciente');
Route::post('/cadastroPaciente', [HomeController::class, 'salvarPaciente'])->name('salvarPaciente');
Route::get('/cadastroProntuario', [HomeController::class, 'cadastroProntuario'])->name('cadastroProntuario');
Route::get('/cadastrarProntuario', [HomeController::class, 'cadastrarProntuario'])->name('cadastrarProntuario');

/*------------ Rota para agendamentos ------------------------ */

Route::get('/agendamentosRealizados', [HomeController::class, 'agendamentosRealizados'])->name('agendamentosRealizados');
Route::get('/meusAgendamentos', [HomeController::class, 'meusAgendamentos'])->name('meusAgendamentos');
Route::get('/agendamentos', [HomeController::class, 'agendamentos'])->name('agendamentos');
Route::post('/ACagendamentos', [HomeController::class, 'autoCadastroAgendamento']);
Route::post('/FMagendamentos', [HomeController::class, 'finalizarMeusAgendamentos']);

/*------------ Rotas do enfermeiro chefe -------------*/

Route::get('/cadastroPlantonista', [EnfChefeController::class, 'cadastroPlantonista'])->name('cadastroPlantonista');
Route::get('/cadastrarPlantonistas', [EnfChefeController::class, 'cadastrarPlantonistas'])->name('cadastrarPlantonistas');
Route::get('/listagemPlantonistas', [EnfChefeController::class, 'listaPlantonistas'])->name('listagemPlantonistas');
Route::get('/cadastroMedicamento', [EnfChefeController::class, 'cadastroMedicamento'])->name('cadastroMedicamento');
Route::get('/cadastroAgendamento', [EnfChefeController::class, 'cadastroAgendamento'])->name('cadastroAgendamento');
Route::get('/listaAgendamentos', [EnfChefeController::class, 'listaAgendamentos'])->name('listaAgendamentos');
Route::get('/listaResponsaveis', [EnfChefeController::class, 'responsaveis'])->name('responsaveis');
Route::get('/cadastroLeito', [EnfChefeController::class, 'cadastroLeito'])->name('cadastroLeito');
Route::get('/cadastrarLeito', [EnfChefeController::class, 'cadastrarLeito'])->name('cadastrarLeito');
Route::get('/removerLeito', [EnfChefeController::class, 'removerLeito'])->name('removerLeito');
Route::post('/cadastroMedicamento', [EnfChefeController::class, 'salvarMedicamento'])->name('salvarMedicamento');

/*------------ Rotas do menu de enfermeiro, estagiário e enfermeiro chefe -------------------*/

Route::get('/menu', [HomeController::class, 'menu'])->name('menu');

/*------------ Rotas do medicamento -------------------*/

Route::get('/listaMedicamento', [HomeController::class, 'listaMedicamento'])->name('listaMedicamento');

/*------------ Rotas para downloads-------------------*/

Route::get('/baixarArquivos', [HomeController::class, 'baixarArquivos']);
