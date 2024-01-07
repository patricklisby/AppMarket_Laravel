<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenants extends Model
{
    use HasFactory;
    //esto significa que guarde todos los campos que indiquemos
    //en el archivo de la migracion, y algunos estaran vacios
    //y lo hara como un arreglo
    protected $guarded = [];
    public $timestamps = false;

    //Definimos la relacion de usuarios con tenant
    public function user(){
        return $this->hasOne(User::class, 'tenant_id');
    }

    public function productos(){
        return $this->hasMany(Productos::class);
    }

//Definimos la relacion de categorias con tenant
    public function categorias(){
        return $this->hasMany(Categorias::class);
    }

    public function proveedores(){
        return $this->hasMany(Proveedores::class);
    }

    public function clientes(){
        return $this->hasMany(Clientes::class);
    }

    public function estados(){
        return $this->hasMany(Estados::class);
    }
}
