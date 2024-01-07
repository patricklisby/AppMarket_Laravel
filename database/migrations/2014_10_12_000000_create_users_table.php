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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            $table->string('Perfil');
            $table->unsignedBigInteger('estado_id');
            $table->unsignedBigInteger('tenant_id'); 
            $table->foreign('estado_id')->references('id')->on('estados');
            $table->foreign('tenant_id')->references('id')->on('tenants');

            $table->rememberToken();
            $table->timestamps();
            $table->timestamp('fechaIngreso');
            $table->timestamp('fechaCierre');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
