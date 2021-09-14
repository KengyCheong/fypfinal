<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToUsersInfosTable extends Migration
{
    public function up()
    {
        Schema::table('users_infos', function (Blueprint $table) {
            $table->unsignedBigInteger('illness_history_id');
            $table->foreign('illness_history_id', 'illness_history_fk_4634044')->references('id')->on('illness_tags');
            $table->unsignedBigInteger('vaccine_status_id');
            $table->foreign('vaccine_status_id', 'vaccine_status_fk_4635369')->references('id')->on('vaccine_tags');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_4634043')->references('id')->on('users');
        });
    }
}
