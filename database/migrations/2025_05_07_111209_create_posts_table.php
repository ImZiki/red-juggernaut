<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Ejecutar las migraciones.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Título del post
            $table->text('content'); // Contenido del post
            $table->json('media')->nullable(); // Multimedia (puede ser null si no hay)
            $table->unsignedBigInteger('user_id'); // Relación con el usuario
            $table->timestamps();

            // Clave foránea para la relación con el usuario
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Deshacer las migraciones.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
