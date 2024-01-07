<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
    use HasFactory;
     //esto significa que guarde todos los campos que indiquemos
    //en el archivo de la migracion, y algunos estaran vacios
    //y lo hara como un arreglo
    protected $guarded = [];

    protected $fillable = [
        'NombreCategoria',
        'estado_id',
        'tenant_id',
        'created_at'
    ];

     //Definimos la relación de tenants con usuarios
     public function tenant(){
        return $this->belongsTo(Tenants::class);
    }
    public function productos(){
        return $this->hasMany(Productos::class);
    }

}
