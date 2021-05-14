<?php

namespace App\Http\Controllers;

class VerificaLoginController extends Controller
{
    public static function verificarLogin(){
        session_start();  
        if((isset($_SESSION['administrador']) == false) AND (isset($_SESSION['enfermeiroChefe']) == false) 
        AND (isset($_SESSION['enfermeiro']) == false) AND (isset($_SESSION['astagiario']) == false)){
            header("Location: /");
            exit();
        }
    }

    public static function verificarLoginAdmin(){
        session_start();  
        if(isset($_SESSION['administrador']) == false){
            header("Location: /");
            exit();
        }
    }

    public static function verificarLoginEnfC(){
        session_start();  
        if(isset($_SESSION['enfermeiroChefe']) == false){
            header("Location: /");
            exit();
        }
    }

    public static function verificarLoginEnf(){
        session_start();  
        if(isset($_SESSION['enfermeiro']) == false){
            header("Location: /");
            exit();
        }
    }

    public static function verificarLoginEst(){
        session_start();  
        if(isset($_SESSION['estagiario']) == false){
            header("Location: /");
            exit();
        }
    }

    
}