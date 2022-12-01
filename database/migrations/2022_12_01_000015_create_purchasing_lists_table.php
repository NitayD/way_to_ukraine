<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasingListsTable extends Migration
{
    public function up()
    {
        Schema::create('purchasing_lists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('amount');
            $table->integer('total_sum');
            $table->integer('sort')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
