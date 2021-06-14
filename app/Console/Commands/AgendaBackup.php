<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\AdminController;

class AgendaBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'program:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Comando para realizar o backup programado do Banco de Dados';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        AdminController::salvarDB();
        include("db.php");
        // obtem data e hora atual 
        $dataAtual = date('Y-m-d');
        $horaAtual = date('H:i:s');
        $sql = "SELECT * FROM backups_agendados";
        $query = mysqli_query($connect, $sql); // acessa a tabela de backups agendaddos
        while ($sql = mysqli_fetch_array($query)) {
            //obtem a data e hora de cada aendamento 
            $data = $sql['Data_backup'];
            $hora = $sql['Hora_backup'];
            if ($dataAtual == $data and $horaAtual == $hora) { //verifica se as datas e horas cadastradas e obtidas batem e se sim chamam a função estatica de backup
                AdminController::salvarDB();
            }
        }
    }
}
