<?php

namespace App\Http\Controllers;

/**
 * Classe VerificaLoginController
 */
class VerificaLoginController extends Controller
{    
    /**
     *  Função para verificar se tem alguem logado se não redireciona para login
     *
     * @return void
     */
    public static function verificarLogin(){ 
        session_start();  
        if((isset($_SESSION['administrador']) == false) AND (isset($_SESSION['enfermeiroChefe']) == false) 
        AND (isset($_SESSION['enfermeiro']) == false) AND (isset($_SESSION['estagiario']) == false)){
            header("Location: /");
            exit();
        }
    }
    
    /**
     * Função para verificar se tem adinistrador logado se não redireciona para login
     *
     * @return void
     */
    public static function verificarLoginAdmin(){ 
        session_start();  
        if(isset($_SESSION['administrador']) == false){
            header("Location: /");
            exit();
        }
    }
    
    /**
     * Função para verificar se tem enfermeiro chefe logado se não redireciona para login
     *
     * @return void
     */
    public static function verificarLoginEnfC(){ // 
        session_start();  
        if(isset($_SESSION['enfermeiroChefe']) == false){
            header("Location: /");
            exit();
        }
    }
    
    /**
     * Função para verificar se tem enfermeiro logado se não redireciona para login
     *
     * @return void
     */
    public static function verificarLoginEnf(){ 
        session_start();  
        if(isset($_SESSION['enfermeiro']) == false){
            header("Location: /");
            exit();
        }
    }
    
    /**
     * Função para verificar se tem estagiario logado se não redireciona para login
     *
     * @return void
     */
    public static function verificarLoginEst(){ 
        session_start();  
        if(isset($_SESSION['estagiario']) == false){
            header("Location: /");
            exit();
        }
    }
    
    /**
     * Função que verifica permissão com determinado ID cargo por cargo de 
     *
     * @param  mixed $numeroP
     * @return int
     */
    public static function verificaPermissao($numeroP){ // 
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