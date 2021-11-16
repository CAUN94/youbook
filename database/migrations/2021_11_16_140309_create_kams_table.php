<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kams', function (Blueprint $table) {
            $table->id();
            $table->string('alliance');
            $table->unsignedBigInteger('userapp_id');
            $table->foreign('userapp_id')->references('id')->on('usersapp');
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
        Schema::dropIfExists('kams');
    }
}
