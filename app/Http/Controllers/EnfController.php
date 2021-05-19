<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EnfController extends Controller
{
    public function menu(){
        VerificaLoginController::verificarLoginEnf();
        return view('/enf/menu');
    }
}
