<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email');
            $table->string('password');
            $table->string('remember_token', 255)->nullable();
            $table->string('nombre', 170)->nullable();
            $table->string('apellido', 170)->nullable();
            $table->smallInteger('edo_reg')->default(1);

            $table->enum('tipo_usuario', [
                    'ADMIN',
                    'USER'
                ]);
            
            $table->timestamps();
        });

        \DB::table('users')->insert([
                'email' => 'admin',
                'password' => bcrypt('admin'),
                'tipo_usuario' =>'ADMIN'
            ]);
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
}
