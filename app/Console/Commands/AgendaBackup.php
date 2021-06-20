<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\AdminController;
use Symfony\Component\VarDumper\Cloner\Data;

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
        AdminController::realizarBackupAgendado();          
    }
}
