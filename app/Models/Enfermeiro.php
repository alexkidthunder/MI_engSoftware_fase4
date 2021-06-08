<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enfermeiro extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "enfermeiros";    //seta a o nome da tabela 

    protected $fillable = [
        'CPF', 'COREN', 'Plantao'
    ];
}
