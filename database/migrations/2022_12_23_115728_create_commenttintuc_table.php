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
        Schema::create('commenttintuc', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('id_tintuc');
            $table->foreign('id_tintuc')->references('id')->on('tintuc')->onDelete('cascade');
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
        Schema::dropIfExists('commenttintuc');
    }
};
