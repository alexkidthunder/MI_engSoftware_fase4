<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicamento extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "medicamentos";    //seta a o nome da tabela 

    protected $fillable = [
        'Nome_Medicam','Quantidade','Fabricante','Data_Validade','Codigo'
    ];
}
