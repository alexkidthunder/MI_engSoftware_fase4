<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="{{ ('css/navbar-style.css') }}" rel="stylesheet"> 
    <link href="{{ ('bootstrap/css/bootstrap.css') }}" rel="stylesheet">
</head>
<body>
  <header  class="header" id="header" class="fixed-top">
    
    <div class="d-flex align-items-center justify-content-between">
      <div class="d-flex">
        <a href="{{ route('editarPerfil') }}"><img src="{{asset(' ')}}" class="img-fluid"></a>
        <div>
          <h2><a href="{{ route('editarPerfil') }}">OLÁ, NOME FUNCIONÁRIO</a></h2>
        </div>
      </div>
    
      <div class="d-flex align-items-center pr-5">    
        <nav class="nav d-none d-lg-block">

          <ul>
            <li class="title-nav"><a href="{{ route('menu') }}">INÍCIO</a></li>
            <li class="drop-down title-nav"><a>PACIENTES</a>
                <ul>
                    <li><a href="{{ route('cadastroPaciente') }}">Cadastro de pacientes</a></li>
                    <li><a href="{{ route('pacientes') }}">Pacientes e prontuários</a></li>
                </ul>
            </li>
     
            <li class="drop-down title-nav"><a>AGENDAMENTOS E<br> MEDICAMENTOS</a>
              <ul>
                <li class=""><a href="{{ route('agendamentos') }}">Verificação de agendamentos</a></li>
                <li class=""><a href="{{ route('meusAgendamentos') }}">Meus agendamentos</a></li>
                <!-- Enfermeiro chefe 
                <li class=""><a href="{{ route('cadastroAgendamento') }}">Cadastro de agendamentos</a></li>
                <li class=""><a href="{{ route('listaAgendamentos') }}">Listagem de agendamentos</a></li>
                <li class=""><a href="{{ route('cadastroMedicamento') }}">Cadastro de medicamentos</a></li>
                <li class=""><a href="{{ route('responsaveis') }}">Responsáveis por aplicação</a></li>
                -->
              </ul>
            </li>
            
            <li class="title-nav"><a href="{{ route('agendamentosRealizados') }}">AGENDAMENTOS REALIZADOS</a></li>
         
            <!-- Enfermeiro chefe   
            <li class="drop-down title-nav"><a>PLANTONISTAS</a>
              <ul>
                <li class=""><a href="{{ route('cadastroPlantonista') }}">Cadastro de plantonista</a></li>
                <li class=""><a href="{{ route('listagemPlantonistas') }}">Listagem de plantonista</a></li>
              </ul>
            </li>
          -->
            <li><a href="#"><img src="{{asset(' ')}}" class="img-fluid"></a></li>
         
          </ul>
        </nav>
      </div>
    </div>
  </header>
</body>
</html>