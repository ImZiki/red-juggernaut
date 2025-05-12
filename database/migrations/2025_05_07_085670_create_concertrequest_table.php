<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('concert_requests', function (Blueprint $table) {
            $table->id();
            $table->string('request_name');
            $table->string('email');
            $table->string('venue');
            $table->dateTime('date');
            $table->text('message')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('concert_requests');
    }

};
