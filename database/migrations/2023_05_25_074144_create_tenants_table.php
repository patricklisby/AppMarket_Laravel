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
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->string('NombreTenant')->nullable();
            $table->string('Perfil');
            $table->string('Direccion')->nullable();
            $table->string('CorreoTenant');
            $table->string('ClaveTenant');
            $table->string('Telefono')->nullable();
            $table->string('Whatsapp')->nullable();
            $table->string('Logotipo')->nullable();
            $table->timestamp('FechaContrato');
            $table->timestamp('FechaVencimiento')->nullable();
            $table->timestamp('CorreoVerificado')->nullable();
            $table->unsignedBigInteger('estado_id');
            $table->foreign('estado_id')->references('id')->on('estados');
            $table->string('NombreTienda');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tenants');
    }
};
