<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->date('FechaVenta');
            $table->string('TipoVenta');
            $table->float('Subtotal');
            $table->float('Impuesto');
            $table->float('Descuento');
            $table->float('TotalVentas');
            $table->String('DescripcionVenta');
             //genero el campo de estado y luego lo relaciono
             $table->unsignedBigInteger('tenant_id');  
             $table->foreign('tenant_id')->references('id')->on('tenants');

              //genero el campo de estado y luego lo relaciono
              $table->unsignedBigInteger('cliente_id');  
              $table->foreign('cliente_id')->references('id')->on('clientes');

              //genero el campo de estado y luego lo relaciono
              $table->unsignedBigInteger('usuario_id');  
              $table->foreign('usuario_id')->references('id')->on('users');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ventas');
    }
};
