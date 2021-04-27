<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Responsavel extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "responsaveis";    //seta a o nome da tabela 

    protected $fillable = [
        'CPF'
    ];
}
