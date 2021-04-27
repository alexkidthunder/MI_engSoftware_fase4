<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estagiario extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "estagiarios";    //seta a o nome da tabela 

    protected $fillable = [
        'CPF','Plantao'
    ];
}
