<?php

use App\Http\Controllers\HomeController;
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
Route::get('/', [HomeController::class,'index']);



/*------------ Rotas do administrador -------------------*/




/*------------ Rotas do enfermeiro chefe -------------------*/



/*------------ Rotas do enfermeiro -------------------*/



/*------------ Rotas do estagiário -------------------*/