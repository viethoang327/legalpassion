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
        Schema::table('loailinhvuc', function (Blueprint $table) {
            //
            $table->string('hinhanh')->after('tenkhongdau')->nullable();
            $table->string('mota')->after('hinhanh')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('loailinhvuc', function (Blueprint $table) {
            //
        });
    }
};
