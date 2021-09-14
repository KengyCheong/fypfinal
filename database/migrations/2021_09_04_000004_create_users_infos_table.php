<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersInfosTable extends Migration
{
    public function up()
    {
        Schema::create('users_infos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('nric_no')->unique();
            $table->date('birth_date');
            $table->string('phone_no')->unique();
            $table->longText('address');
            $table->string('nationality');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
