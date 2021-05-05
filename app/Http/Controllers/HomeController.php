<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{
    public function index(){
        return view('login');
    }

    public function login(Request $request){
        $request -> validate([
            'cpf' => 'required',
            'senha' => 'required'
        ]);
        $users = DB::table('usuarios')->where('CPF',$request->cpf)->first();;
        if($users != null){
            if($users->Senha == $request->senha){
                if($users->Atribuicao == "Administrador"){
                    return redirect() -> intended('menu');
                }else if($users->Atribuicao == "Enfermeiro Chefe"){
                    return redirect() -> intended('menuEnfermeiroChefe');
                }else if($users->Atribuicao == "Enfermeiro"){
                    return redirect() -> intended('menuEnfermeiro');
                }else if($users->Atribuicao == "Estagiario"){
                    return redirect() -> intended('menuEstagiario');
                }else{
                    return redirect() -> back() ->with('msg','Funcionario sem cargo, algo esta errado!!!');
                }
                
            }else{
                return redirect() -> back() ->with('msg','Acesso negado para essas credenciais');
            }
        }else{
            return redirect() -> back() ->with('msg','Usuario não cadastrado');
        }

    }

    public function logout(){
        session_start();
        session_destroy();
        return view('login');
    }
    
    public function primeiroAcesso(){
        return view('primeiroAcesso');
    }

    public function sessaoAdmin(){
        session_start();
        return view('admin.menu');
    }
    public function sessaoEnf(){
        session_start();
        return view('enf.menu');
    }
    public function sessaoEnfChef(){
        session_start();
        return view('enfChefe.menu');
    }
    public function sessaoEst(){
        session_start();
        return view('estagiario.menu');
    }

    public function menu(){
        return view('admin.menu');
    }
    public function editPerfil(){
        return view('editarPerfil');
    }

    public function listaPacientes(){
        return view('listaPacientes');
    }

    public function agendamentosRealizados(){
        return view('agendamentosRealizados');
    }

    public function meusAgendamentos(){
        return view('meusAgendamentos');
    }
    
    public function agendamentos(){
        return view('agendamentos');
    }

    public function cadastroAgendamentos(){
        return view('cadastroAgendamentos');
    }

    public function cadastroPaciente(){
        return view('cadastroPaciente');
    }

    public function esqueciSenha(){
        return view('esqueciSenha');
    }

    public function mensagens(){
        return view('mensagens');
    }
}
