<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleVentas extends Model
{
    public $timestamps = false;

    use HasFactory;
    protected $guard=[];

    protected $fillable = [
        'CodigoBarras',
        'ImagenProducto',
        'Descripcion',
        'Stock',
        'tenant_id',
        'producto_id'
        ];

    public function tenant()
    {
        return $this->belongsTo(Tenants::class);
    }
}
