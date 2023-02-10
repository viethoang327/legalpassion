<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commentthutuc', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('id_thutuc');
            $table->foreign('id_thutuc')->references('id')->on('thutuc')->onDelete('cascade');
            $table->longText('noidung');
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('user')->onDelete('cascade');
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
        Schema::dropIfExists('commentthutuc');
    }
};
