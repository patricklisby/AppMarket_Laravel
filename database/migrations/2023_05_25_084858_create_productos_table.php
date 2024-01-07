<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table -> string("codigoBarras");
            $table -> string("descripcion");
            $table -> string("imagenProducto");
            $table -> float("precioCompra");
            $table -> float("precioVenta");
            $table -> float("utilidad");
            $table -> integer("existencia");
            $table -> integer("stock");
            $table -> integer("ventas");
            $table -> unsignedBigInteger("estado_id");
            $table -> unsignedBigInteger("tenants_id");
            $table -> unsignedBigInteger("categoria_id");
            $table -> unsignedBigInteger("proveedor_id");
            $table -> foreign("estado_id") -> references('id')->on('estados');
            $table -> foreign("tenants_id") -> references('id')->on('tenants');
            $table -> foreign("categoria_id") -> references('id')->on('categorias');
            $table -> foreign("proveedor_id") -> references('id')->on('proveedores');
            $table->timestamp('fechaIngreso');
            $table->timestamp('updated_at');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
