<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EnfChefeController extends Controller
{
    public function menu(){
        return view('/enfChefe/menu');
    }
    public function cadastroPlantonista(){
        return view('cadastroPlantonista');
    }
}
