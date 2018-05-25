<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSedesTable extends Migration
{
    public function up()
    {
        Schema::create('sedes', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('nombre_sede');
            $table->string('direccion_sede')->nullable();
            $table->string('codigo_sede', 7)->nullable();

        });

        foreach (['PRINCIPAL BUCARAMANGA','CONCHA ACUSTICA', 'CABECERA DEL LLANO', 'PIEDECUESTA'] as $key => $value) {
           \DB::table('sedes')->insert([
                'nombre_sede' => $value,
                'codigo_sede' => '00000'.$key
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solicitudes');
    }
}
