<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];

    protected $fillable = [
        'idDocumento',
        'NomCliente',
        'CorreoCliente',
        'TelefonoCliente',
        'PaisCliente',
        'ProvinciaCliente',
        'DireccionCliente',
        'estado_id',
        'tenants_id'
    ];
    public function tenant(){

        return $this->belongsTo(Tenants::class);
    }

    public function estados(){
        return $this->hasMany(Estados::class);
    }
}