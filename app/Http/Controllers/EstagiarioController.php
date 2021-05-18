<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EstagiarioController extends Controller
{
    public function menu(){
        VerificaLoginController::verificarLoginEst();
        return view('/estagiario/menu');
    }

}
