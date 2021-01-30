<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBalizasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('balizas', function (Blueprint $table) {
            $table->string('id')->unique();
            $table->string("nombre")->unique();
            $table->string("latitud");
            $table->string("longitud");
            $table->string("altitud");
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
        Schema::dropIfExists('balizas');
    }
}
