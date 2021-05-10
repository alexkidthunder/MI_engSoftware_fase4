<?php

namespace App\Http\Controllers;

use App\Models\Administrador;
use App\Models\Enfermeiro_chefe;
use App\Models\Estagiario;
use App\Models\Responsavel;
use App\Models\Usuario;
use App\Models\Enfermeiro;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\ElseIf_;

class AdminController extends Controller
{

    public function menu(){
        return view('/admin/menu');
    }

    public function log()
    {
        return view('/admin/log');
    }

    public function atribuicao()
    {
        return view('/admin/atribuicao');
    }

<<<<<<< Updated upstream
    public function permissao()
=======
    public function permissao(Request $request)
    {
        include("db.php");
        $atribuicao = $request->atribuicao;
        $p = [];

        if ($atribuicao != "Administrador") {

            if ($atribuicao == 'enfermeiroChefe') {


                $sql = "";
                $query = null;
                             
               
              
                
                for ($i = 1; $i <= 32; $i++) {          
                $sql = "SELECT * FROM permissao_cargo where permissao_id = $i";
                $query = mysqli_query($connect, $sql);   
                    while($sql = $query->fetch_array()){
                        if($sql['cargo_id'] == 2){
                            $p[$i] = $sql['ativo'] ? 'checked' : 'unchecked';
                        }
                        
                    }
                } 
                 //dd($p);
                return view('/admin/permissao',['p'=>$p]);

            }


            /*
            else if($atribuicao == 'Enfermeiro'){
                echo "2";
                $p = null;
                $sql = "";
                $query = null;
                $count = count($permissoes);
                for($i = 0; $i < $count; $i++){
                    $sql = "SELECT * FROM enfPermisoes where Id = $permissoes[$i]";
                    $query = mysqli_query($connect,$sql);
                    while($sql = mysqli_fetch_array($query)){
                        $p = $sql["Permissao"] ? true : 'checked';
                        return view('/admin/permissao', $p);
                    }
                }
            }
            else if($atribuicao == 'Estagiario'){
                echo "3";
                $p = null;
                $sql = "";
                $query = null;
                $count = count($permissoes);
                for($i = 0; $i < $count; $i++){
                    $sql = "SELECT * FROM estPermissoes where Id = $permissoes[$i]";
                    $query = mysqli_query($connect,$sql);
                    while($sql = mysqli_fetch_array($query)){
                        $p = $sql["Permissao"] ? true : 'checked';
                        return view('/admin/permissao', $p);
                    }
                }
            }
            */ else {

                return view('/admin/permissao');
            }
        }
    }


    public function alterarPermissao(Request $request)
>>>>>>> Stashed changes
    {

<<<<<<< Updated upstream
=======

        include("db.php");
        $atribuicao = $request->atribuicao;
        $permissoes = [
            1 => $request->p1,
            2 => $request->p2,
            3 => $request->p3,
            4 => $request->p4
        ];

        if ($atribuicao != "Administrador") {
            if ($atribuicao == 'Enfermeiro Chefe') {
                for ($i = 1; $i <= 32; $i++) {
                    if (isset($_POST['p' . $i])) {
                        $update = "UPDATE enfcPermisoes set='true' where Id = $i";
                        mysqli_query($connect, $update);
                    } else {
                        $update = "UPDATE enfcPermisoes set='false' where Id = $i";
                        mysqli_query($connect, $update);
                    }
                }
            } else if ($atribuicao == 'Enfermeiro') {
                for ($i = 0; $i < $count; $i++) {
                    $update = "UPDATE enfPermisoes set='true' where Id = $i";
                    mysqli_query($connect, $update);
                }
            } else if ($atribuicao == 'Estagiario') {
                for ($i = 0; $i < $count; $i++) {
                    $update = "UPDATE estPermissoes set='true' where Id = $i";
                    mysqli_query($connect, $update);
                }
                return view('/admin/permissao');
            }
        } else {
            return redirect()->back()->with('msg', '');
        }
    }

>>>>>>> Stashed changes
    public function backup()
    {
        return view('/admin/backup');
    }

    public function cadastro()
    {
        return view('/admin/cadastroUsuario');
    }

    public function remocao()
    {  
        
        
        include('..\app\Http\Controllers\db.php'); 
        if (isset($_GET['cpf'])) {
            $cpf = $_GET['cpf'];
            //$atr = $_GET['atr'];    
            $query ="DELETE FROM usuarios WHERE 'CPF' = '$cpf'";
            $status = mysqli_query($connect, $query);            
                    
            return view('/admin/remocaoUsuario',['status'=>$status]);
        } else {
            return view('/admin/remocaoUsuario');
        }       
      
    }
    
    public function salvarUsuario(Request $request){
        
        //busca o cpf
        $existeCPF = DB::table('usuarios')->where('CPF', $request->fcpf)->first();    
           
        //se já existir o cpf
        if($existeCPF)   
             return redirect()->route('salvarUsuario')->with('error', "CPF já existente!");
       
        //validação de erro
        $validator = Validator::make($request->all(), [     
            'CPF' => 'required|min:14|max:14',
       ]);
        
       //redirecionando o usuario após erro 
        if ($validator->fails()) {
           return redirect()->route('salvarUsuario')->with('error', "Digite um CPF válido!!");   
         }      
         
        //se não existir cpf, cria usuário
         Usuario::Create([
            'CPF' => $request->fcpf,
            'Nome' => $request->fnome,
            'Senha' => '12345',                                 //exemplo de senha
            //'Senha' => bcrypt($request->fsenha);               // PARA ALTERAR A SENHA, NÃO SALVAR COMO RECEBE
            //Hash::make('password'),                                               VERIFICAR TAMANHO DE SENHA
            'Email' => $request->femail,
            'Data_Nasc' => $request->fnascimento,
            'Atribuicao' => $request->fatribui,
            'Sexo' => $request->fsexo,
            'Ip' => $request->ip(), 
            ]);        
         
        //Adiciona usuário em tabelas correspondentes ao cargo
        if ($request->fatribui == 'Administrador'){
            Administrador::Create([
                'CPF' => $request->fcpf,
            ]);
        }else{
            Responsavel::Create([
                'CPF' => $request->fcpf,
            ]);
            
            if ($request->fatribui == 'Enfermeiro Chefe') {
                Enfermeiro_chefe::Create([
                    'CPF' => $request->fcpf,
                    'COREN' => '01-AC00024',   //TROCAR ISSO
                ]);
            }
            else if ($request->fatribui == 'Enfermeiro') {
                Enfermeiro::Create([
                    'CPF' => $request->fcpf,
                    'COREN' => '01-SP00100',   //TROCAR ISSO
                    'Plantao' => '1',           //TROCAR ISSO
                ]); 
            }else if ($request->fatribui == 'Estagiario') {
                Estagiario::Create([
                    'CPF' => $request->fcpf,
                    'Plantao' => '0',           //TROCAR ISSO
                ]);
            }   
        }         
         
        return redirect()->route('salvarUsuario')->with('success','Usuário cadastrado com sucesso!!');
     }

    public function busca(Request $request)
    {          
        
        include('..\app\Http\Controllers\db.php');        
        $query = "SELECT * FROM usuarios WHERE CPF= '$request->cpf_user'";
        $result = mysqli_query($connect, $query);       
        $user = mysqli_fetch_array($result);
        
        
        if ($user == null) {
            $user = 0;
            $atribuicao = 0;
        }

        if($user != 0){
            if(strcmp($user['Atribuicao'],"Enfermeiro") == 0){
                $enfermeiro = mysqli_query($connect, "SELECT * FROM enfermeiros WHERE CPF= '$request->cpf_user'");
                $atribuicao = mysqli_fetch_array($enfermeiro);  
            }else if(strcmp($user['Atribuicao'], "Enfermeiro Chefe") == 0){
                $enfermeiro_Chefe = mysqli_query($connect, "SELECT * FROM enfermeiros_chefes WHERE CPF= '$request->cpf_user'");   
                $atribuicao = mysqli_fetch_array($enfermeiro_Chefe);   
            }else{
                $atribuicao = 0;
            }
        }
        return view('/admin/remocaoUsuario', ['user' => $user, 'atribuicao'=> $atribuicao]);
        
    }
}
