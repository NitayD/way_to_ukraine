<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('content_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->boolean('show_menu')->default(0)->nullable();
            $table->boolean('show_main_page')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
