<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVaccineTagsTable extends Migration
{
    public function up()
    {
        Schema::create('vaccine_tags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('vaccine_status');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
