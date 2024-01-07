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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('idDocumento');
            $table->string('NomCliente');
            $table->string('CorreoCliente')->nullable();
            $table->string('TelefonoCliente')->nullable();
            $table->string('PaisCliente');
            $table->string('ProvinciaCliente')->nullable();
            $table->string('DireccionCliente')->nullable();
            //genero el campo de estado y luego lo relaciono
            $table->unsignedBigInteger('estado_id');  
            $table->foreign('estado_id')->references('id')->on('estados');

            //genero el campo de estado y luego lo relaciono
            $table->unsignedBigInteger('tenant_id');  
            $table->foreign('tenant_id')->references('id')->on('tenants');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
};
