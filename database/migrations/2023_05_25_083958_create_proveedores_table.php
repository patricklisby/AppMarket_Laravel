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
        Schema::create('proveedores', function (Blueprint $table) {
            $table->id();
            $table->string('NombreProveedor');
            $table->string('CedulaJuridica')->nullable();
            $table->string('Pais')->nullable();
            $table->string('Provincia')->nullable();
            $table->string('Ciudad')->nullable();
            $table->string('Direccion')->nullable();
            $table->string('NombreContacto')->nullable();
            $table->string('CorreoContacto')->nullable();
            $table->string('TelefonoEmpresa')->nullable();
            $table->string('Whatsapp')->nullable();
            $table->string('Sitioweb')->nullable();
            $table->string('Facebook')->nullable();
            $table->string('Instagram')->nullable();

            //genero el campo de estado y luego lo relaciono
            $table->unsignedBigInteger('estado_id');  
            $table->foreign('estado_id')->references('id')->on('estados');

            //genero el campo de estado y luego lo relaciono
            $table->unsignedBigInteger('tenants_id');  
            $table->foreign('tenants_id')->references('id')->on('tenants');
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
        Schema::dropIfExists('proveedores');
    }
};
