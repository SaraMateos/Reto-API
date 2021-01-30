<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos', function (Blueprint $table) {
            $table->string('id')->unique()->nullable();
            $table->string("nombre")->unique()->nullable();
            $table->float("temperatura")->nullable();
            $table->float("humedad")->nullable();
            $table->float("viento")->nullable();
            $table->float("vientoMax")->nullable();
            $table->float("vientoDir")->nullable();
            $table->float("precipitacion")->nullable();
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
        Schema::dropIfExists('datos');
    }
}
