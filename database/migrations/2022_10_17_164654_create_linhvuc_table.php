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
        Schema::create('linhvuc', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('id_loailinhvuc');
            $table->foreign('id_loailinhvuc')->references('id')->on('loailinhvuc')->onDelete('cascade');
            $table->string('ten');
            $table->string('tenkhongdau');
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
        Schema::dropIfExists('linhvuc');
    }
};
