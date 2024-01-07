<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedores extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];
    protected $fillable = [
        'NombreProveedor',
        'CedulaJuridica',
        'Pais',
        'Provincia',
        'Ciudad',
        'Direccion',
        'NombreContacto',
        'CorreoContacto',
        'TelefonoEmpresa',
        'Whatsapp',
        'Sitioweb',
        'Facebook',
        'Instagram',
        'estado_id',
        'tenant_id'
    ];


    public function tenant(){
        return $this->belongsTo(Tenants::class);
    }

    public function estados(){
        return $this->hasMany(Estados::class);
    }
}