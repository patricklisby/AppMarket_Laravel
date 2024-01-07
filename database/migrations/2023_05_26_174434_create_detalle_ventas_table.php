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
        Schema::create('detalle_ventas', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->integer('Cantidad');
            $table->float('Precio');
            $table->float('Total');

            //genero el campo de estado y luego lo relaciono
            $table->unsignedBigInteger('tenant_id');  
            $table->foreign('tenant_id')->references('id')->on('tenants');

             //genero el campo de estado y luego lo relaciono
            $table->unsignedBigInteger('producto_id');  
            $table->foreign('producto_id')->references('id')->on('productos');

             //genero el campo de estado y luego lo relaciono
            $table->unsignedBigInteger('venta_id');  
            $table->foreign('venta_id')->references('id')->on('ventas');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_ventas');
    }
};
