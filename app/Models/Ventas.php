<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
    public $timestamps = false;
    const CREATED_AT = 'FechaVenta';// reemplaza lo que eloquent estará buscando como columna created_at
    use HasFactory;
    protected $guarded = [];

    protected $fillable = [
        'FechaVenta',
        'TipoVenta',
        'Subtotal',
        'Impuesto',
        'Descuento',
        'TotalVenta',
        'DescripcionVenta',
        'usuario_id',
        'cliente_id',
        'tenant_id'
        ];

    public function tenant()
    {
        return $this->belongsTo(Tenants::class);
    }
}
