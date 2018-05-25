<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolicitudesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->text('descripcion')->nullable();
            $table->string('asunto');
            $table->date('fecha_solicitada')->nullable();
            $table->string('telefono', 32)->nullable();
            $table->string('cc')->nullable();
            $table->string('nombre_doctor')->nullable();
            $table->string('apellido_doctor')->nullable();

            $table->enum('radio_intraorales', [
                    'Periapical Digital',
                    'Periapical Digital Milimetrada',
                    'Juego de Periapical Completo',

                ])->nullable();

            $table->enum('oclusal', ['Inferior', 'Superior'])->nullable();

            $table->enum('extraoral', [
                    'Antero-Posterior',
                    'Postero  Anterior',
                    'Dinamica A.T.M.',
                    'Senos Nasales y Paranasales',
                    'Carpograma'
                ])->nullable();

            $table->enum('foto_clinica', [
                    'Oclusal  Sup',
                    'Oclusal  Inf',
                    'Oclusal  Der',
                    'Oclusal  Izq',
                    'Over Yet',
                ])->nullable();

            $table->enum('otros_servicios', [
                    'Modelos de Estudio',
                    'Modelos de Trabajo',
                    'Cefalometria Computarizada', 
                ])->nullable();

            $table->enum('paquete_ortodoncia', [
                    'Opción 1 (Panorámica, lateral cráneo, modelos)',
                    'Opción 2 (Panorámica Fotografías (5) modelos)',
                    'Opción 3 (Panorámica, lateral cráneo, Fotografías (5) modelos)',
                    'Opción 4 (Panorámica, lateral cráneo, Fotografías (8) modelos)',
                    'Opción 5 (Panorámica, lateral cráneo, Fotografías (8) modelos, Cefalometría)',

                ])->nullable();

            $table->softDeletes();

            $table->integer('user_id')->unsigned();

            $table->foreign('user_id')->references('id')
                    ->on('users');

            $table->integer('sede_id')->references('id')
                    ->on('sedes')->onDelete('cascade');
        });
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
