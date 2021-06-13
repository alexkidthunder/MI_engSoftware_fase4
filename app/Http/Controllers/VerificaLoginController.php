<?php

namespace App\Http\Controllers;

class VerificaLoginController extends Controller
{
    public static function verificarLogin(){ // verifica se tem alguem logado se não redireciona para login
        session_start();  
        if((isset($_SESSION['administrador']) == false) AND (isset($_SESSION['enfermeiroChefe']) == false) 
        AND (isset($_SESSION['enfermeiro']) == false) AND (isset($_SESSION['estagiario']) == false)){
            header("Location: /");
            exit();
        }
    }

    public static function verificarLoginAdmin(){ // verifica se tem adinistrador logado se não redireciona para login
        session_start();  
        if(isset($_SESSION['administrador']) == false){
            header("Location: /");
            exit();
        }
    }

    public static function verificarLoginEnfC(){ // verifica se tem enfermeiro chefe logado se não redireciona para login
        session_start();  
        if(isset($_SESSION['enfermeiroChefe']) == false){
            header("Location: /");
            exit();
        }
    }

    public static function verificarLoginEnf(){ // verifica se tem enfermeiro logado se não redireciona para login
        session_start();  
        if(isset($_SESSION['enfermeiro']) == false){
            header("Location: /");
            exit();
        }
    }

    public static function verificarLoginEst(){ // verifica se tem estagiario logado se não redireciona para login
        session_start();  
        if(isset($_SESSION['estagiario']) == false){
            header("Location: /");
            exit();
        }
    }

    public static function verificaPermissao($numeroP){ // função que verifica permissão com determinado ID cargo por cargo de 
        include("db.php");
        $resultado = "";
        if(isset($_SESSION['enfermeiroChefe'])){
            $sql = "SELECT * FROM permissao_cargo where permissao_id = '$numeroP'";
            $query = mysqli_query($connect,$sql);
            while($sql = mysqli_fetch_array($query)){
                if($sql['cargo_id'] == '2'){
                    $resultado = $sql['ativo'];
                }
            }

        }else if(isset($_SESSION['enfermeiro'])){
            $sql = "SELECT * FROM permissao_cargo where permissao_id = '$numeroP'";
            $query = mysqli_query($connect,$sql);
            while($sql = mysqli_fetch_array($query)){
                if($sql['cargo_id'] == '3'){
                    $resultado = $sql['ativo'];
                }
            }
        }else if(isset($_SESSION['estagiario'])){
            $sql = "SELECT * FROM permissao_cargo where permissao_id = '$numeroP'";
            $query = mysqli_query($connect,$sql);
            while($sql = mysqli_fetch_array($query)){
                if($sql['cargo_id'] == '4'){
                    $resultado = $sql['ativo'];
                }
            }   
        }
        return $resultado; // Retorna 1 ou 0(Verdadeiro ou falso respectivamente)
    }

    
}