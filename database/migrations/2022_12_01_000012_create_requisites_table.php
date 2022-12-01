<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequisitesTable extends Migration
{
    public function up()
    {
        Schema::create('requisites', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('label');
            $table->string('value');
            $table->integer('priority');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
