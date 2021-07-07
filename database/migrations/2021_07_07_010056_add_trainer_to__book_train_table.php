<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTrainerToBookTrainTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('train_appointments', function (Blueprint $table) {
            $table->integer('trainer_id')->after('time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('train_appointments', function (Blueprint $table) {
            $table->dropColumn('trainer_id');
        });
    }
}
