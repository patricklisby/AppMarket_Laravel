<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    use HasFactory;
     //esto significa que guarde todos los campos que indiquemos
    //en el archivo de la migracion, y algunos estaran vacios
    //y lo hara como un arreglo
    protected $guarded = [];

    public function tenant()
    {
        return $this->belongsTo(Tenants::class);
    }
    public function categorias()
    {
        return $this->belongsTo(Categorias::class, 'categoria_id');
    }
    public function proveedores()
    {
        return $this->belongsTo(Proveedores::class, 'proveedor_id');
    }

    public function estados()
    {
        return $this->belongsTo(Estados::class, 'estado_id');
    }
}
