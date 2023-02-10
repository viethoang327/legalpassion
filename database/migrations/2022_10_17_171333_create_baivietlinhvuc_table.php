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
        Schema::create('baivietlinhvuc', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('id_linhvuc');
            $table->foreign('id_linhvuc')->references('id')->on('linhvuc')->onDelete('cascade');
            $table->string('tieude');
            $table->string('tieudekhongdau');
            $table->text('tomtat');
            $table->mediumText('noidung');
            $table->string('hinhanh');
            $table->integer('noibat');
            $table->integer('luotxem');
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
        Schema::dropIfExists('baivietlinhvuc');
    }
};
