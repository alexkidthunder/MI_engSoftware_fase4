<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "pacientes";    //seta a o nome da tabela 

    protected $fillable = [
        'Nome_Paciente', 'Sexo', 'Data_Nasc', 'CPF', 'Tipo_Sang'
    ];
}
