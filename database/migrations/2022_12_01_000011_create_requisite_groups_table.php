<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequisiteGroupsTable extends Migration
{
    public function up()
    {
        Schema::create('requisite_groups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->integer('priority');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
