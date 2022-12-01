<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentPagesTable extends Migration
{
    public function up()
    {
        Schema::create('content_pages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('visible')->default(0)->nullable();
            $table->string('title')->nullable();
            $table->longText('excerpt')->nullable();
            $table->longText('page_text')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
