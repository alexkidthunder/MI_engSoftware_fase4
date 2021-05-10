<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EnfChefeController;
use App\Http\Controllers\EnfController;
use App\Http\Controllers\EstagiarioController;
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


Route::get('/mensagens', [HomeController::class,'mensagens'])->name('mensagensphp');

/*------------ Rota para Index ------------------------ */

Route::get('/', [HomeController::class,'index'])->name('index');



/*------------ Rota para Primeiro Acesso ------------------------ */

Route::get('/primeiroAcesso', [HomeController::class,'primeiroAcesso'])->name('primeiroAcesso');

/*------------ Rota para login ------------------------ */

Route::post('index/menu', [HomeController::class,'login']);

/*------------ Rota para sessao ------------------------ */

Route::get('/sessao', [HomeController::class,'verificarLoguin'])->name('sessao');


/*-------------------Rota para logout----------------- */

Route::get('/logout', [HomeController::class,'logout'])->name('logout');

/*--------- Rota para login caso esqueceu senha ---------- */

Route::get('/esqueciSenha',[HomeController::class,'esqueciSenha'])->name('esqueciSenha');

/*------------ Rota para o perfil ------------------------ */

Route::get('/meuPerfil', [HomeController::class,'editPerfil'])->name('editarPerfil');

/*------------ Rotas do administrador ------------------ */

Route::get('/menu', [AdminController::class,'menu'])->name('menu');
Route::get('/log', [AdminController::class,'log'])->name('log');
Route::post('/editarAtribuicao', [AdminController::class,'atribuicao'])->name('editarAtribuicao');
Route::get('/editarPermissao', [AdminController::class,'permissao'])->name('editarPermissao');
Route::get('/alterarPermissao', [AdminController::class,'alterarPermissao'])->name('alterarPermissao');
Route::get('/backup', [AdminController::class,'backup'])->name('backup');
Route::get('/cadastrarUsuario', [AdminController::class,'cadastro'])->name('cadastrarUsuario');
Route::post('/cadastrarUsuario',[AdminController::class,'salvarUsuario'])->name('salvarUsuario'); 
Route::get('/removerUsuario', [AdminController::class,'remocao'])->name('removerUsuario');
Route::get('/buscarUsuario', [AdminController::class,'busca'])->name('buscarUsuario');
Route::post('/alterarAtribuicao',[AdminController::class,'alterarAtribuicao'])->name('alterarAtribuicao'); // rota para alterar atribuição

/*------------ Rota para Busca ------------------------ */
Route::get('/lupinha', [AdminController::class,'lupinha'])->name('lupinha');

/*------------ Rota para Paciente------------------------ */

Route::get('/listaPacientes', [HomeController::class,'listaPacientes'])->name('pacientes');

/*------------ Rota para cadastro de paciente ------------------------ */

Route::get('/cadastroPaciente', [HomeController::class,'cadastroPaciente'])->name('cadastroPaciente');

/*------------ Rota para agendamentos ------------------------ */

Route::get('/agendamentosRealizados', [HomeController::class,'agendamentosRealizados'])->name('agendamentosRealizados');
Route::get('/meusAgendamentos', [HomeController::class,'meusAgendamentos'])->name('meusAgendamentos');
Route::get('/agendamentos',[HomeController::class,'agendamentos'])->name('agendamentos');

/*------------ Rotas do enfermeiro chefe -------------*/

Route::get('/menuEnfermeiroChefe', [EnfChefeController::class,'menu'])->name('menu-ec');
Route::get('/cadastroPlantonista', [EnfChefeController::class,'cadastroPlantonista'])->name('cadastroPlantonista');
Route::get('/listagemPlantonistas', [EnfChefeController::class,'listaPlantonistas'])->name('listagemPlantonistas');
Route::get('/cadastroMedicamento', [EnfChefeController::class,'cadastroMedicamento'])->name('cadastroMedicamento');
Route::get('/cadastroAgendamento', [EnfChefeController::class,'cadastroAgendamento'])->name('cadastroAgendamento');
Route::get('/listaAgendamentos',[EnfChefeController::class,'listaAgendamentos'])->name('listaAgendamentos');
Route::get('/listaResponsaveis',[EnfChefeController::class,'responsaveis'])->name('responsaveis');
Route::get('/prontuario',[EnfChefeController::class,'prontuario'])->name('prontuario');
Route::get('/cadastroLeito',[EnfChefeController::class,'cadastroLeito'])->name('cadastroLeito');
Route::get('/historicoEntradaSaida',[EnfChefeController::class,'historicoEntradaSaida'])->name('historicoEntradaSaida');
Route::post('/cadastroMedicamento', [EnfChefeController::class,'salvarMedicamento'])->name('salvarMedicamento');

/*------------ Rotas do enfermeiro -------------------*/

Route::get('/menuEnfermeiro', [EnfController::class,'menu'])->name('menu-e');

/*------------ Rotas do estagiário -------------------*/

Route::get('/menuEstagiario', [EstagiarioController::class,'menu'])->name('menu-es');

/*------------ Rotas do medicamento -------------------*/

Route::get('/listaMedicamento', [HomeController::class,'listaMedicamento'])->name('listaMedicamento');