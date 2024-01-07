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
        Schema::create('bitacoras', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            //genero el campo de estado y luego lo relaciono
            $table->timestamp('fechaIngreso');
            $table->timestamp('fechaCierre');

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
        Schema::dropIfExists('bitacoras');
    }
};
