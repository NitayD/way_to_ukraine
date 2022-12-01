<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFundraisingsTable extends Migration
{
    public function up()
    {
        Schema::create('fundraisings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('finished')->default(0)->nullable();
            $table->integer('already_collected');
            $table->string('title');
            $table->string('description_short')->nullable();
            $table->longText('description')->nullable();
            $table->integer('sort')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
