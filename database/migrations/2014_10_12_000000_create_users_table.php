<?php

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

        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('password');
            $table->integer('id_rol')->unsigned();
            $table->foreign('id_rol')->references('id')->on('roles');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('tipos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->timestamps();
        });

        Schema::create('cursos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo');
            $table->integer('id_tipo')->unsigned();
            $table->foreign('id_tipo')->references('id')->on('tipos');
            $table->timestamps();
        });

        Schema::create('secciones', function (Blueprint $table) {
            $table->increments('id');
            $table->string('numero');
            $table->integer('id_curso')->unsigned();
            $table->foreign('id_curso')->references('id')->on('cursos');
            $table->timestamps();
        });

        Schema::create('relacion_users_secciones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_user')->unsigned();
            $table->foreign('id_user')->references('id')->on('users');
            $table->integer('id_seccion')->unsigned();
            $table->foreign('id_seccion')->references('id')->on('secciones');
            $table->timestamps();
        });

        Schema::create('preguntas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->boolean('profesor')->nullable();
            $table->boolean('auxiliar')->nullable();
            $table->boolean('coordinador')->nullable();
            $table->integer('id_tipo')->unsigned();
            $table->foreign('id_tipo')->references('id')->on('tipos');
            $table->timestamps();
        });

        Schema::create('respuestas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('respuesta',700);
            $table->integer('id_user')->unsigned()->nullable();
            $table->foreign('id_user')->references('id')->on('users');
            $table->integer('id_pregunta')->unsigned();
            $table->foreign('id_pregunta')->references('id')->on('preguntas');
            $table->integer('id_seccion')->unsigned();
            $table->foreign('id_seccion')->references('id')->on('secciones');
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
        Schema::drop('respuestas');
        Schema::drop('preguntas');
        Schema::drop('relacion_users_secciones');
        Schema::drop('secciones');
        Schema::drop('cursos');
        Schema::drop('tipos');
        Schema::drop('users');
        Schema::drop('roles');
    }
}
