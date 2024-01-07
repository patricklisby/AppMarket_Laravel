<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estados extends Model
{
    use HasFactory;

    //esto significa que guarde todos los campos que indiquemos
    //en el archivo de la migracion, y algunos estaran vacios
    //y lo hara como un arreglo
    protected $guarded = [];
}
