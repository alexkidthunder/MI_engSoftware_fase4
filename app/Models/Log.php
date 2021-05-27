<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "log";    //seta a o nome da tabela 

    protected $fillable = [
        'Id','Data_Log','Hora_Agend	','Ip','Acao'
    ];
}
