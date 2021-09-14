<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentTimesTable extends Migration
{
    public function up()
    {
        Schema::create('appointment_times', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->time('time');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
