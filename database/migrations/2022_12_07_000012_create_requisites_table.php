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
            $table->string('title')->nullable();
            $table->string('label');
            $table->string('value');
            $table->boolean('is_link')->default(0)->nullable();
            $table->integer('priority');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
