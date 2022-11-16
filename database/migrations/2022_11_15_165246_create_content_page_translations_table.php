<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_page_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale')->index();

            // Foreign key to the main model
            $table->unsignedBigInteger('content_page_id');
            $table->unique(['content_page_id', 'locale']);
            $table->foreign('content_page_id')->references('id')->on('content_pages')->onDelete('cascade');

            // Actual fields you want to translate
            $table->string('title');
            $table->longText('excerpt');
            $table->longText('page_text');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('content_page_translations');
    }
};
