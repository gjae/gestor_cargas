<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArchivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archivos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('nombre_original');
            $table->string('ruta', 130)->nullable();
            $table->string('tipo_archivo', 110)->nullable();
            $table->string('nombre_archivo', 170);
            $table->float('tamano')->default(0);
            $table->integer('post_id')->unsigned();
            $table->string('extension', 10);

            $table->foreign('post_id')->references('id')
                    ->on('posts')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('archivos');
    }
}
