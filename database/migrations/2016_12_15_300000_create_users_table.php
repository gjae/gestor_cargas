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
            $table->string('email')->unique();
            $table->string('correo_electronico')->unique();
            $table->string('password');
            $table->string('remember_token', 255)->nullable();
            $table->string('nombre', 170)->nullable();
            $table->string('apellido', 170)->nullable();
            $table->smallInteger('edo_reg')->default(1);
            $table->dateTime('actived_at')->nullable();
            $table->string('active_token')->nullable();

            $table->index('active_token', 'act_to');
            $table->enum('tipo_usuario', [
                    'ADMIN',
                    'USER'
                ])->default('USER');
            
            $table->timestamps();
        });

        \DB::table('users')->insert([
                'email' => 'admin',
                'password' => bcrypt('admin'),
                'tipo_usuario' =>'ADMIN',
                'correo_electronico' => 'noapply@mail.com',
                'actived_at' => \Carbon\Carbon::now()->format('Y-m-d'),
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
