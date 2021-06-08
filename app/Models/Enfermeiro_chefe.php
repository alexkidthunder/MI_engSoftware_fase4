<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enfermeiro_chefe extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "enfermeiros_chefes";    //seta a o nome da tabela 

    protected $fillable = [
        'CPF','COREN'
    ];
}
