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
        Schema::table('content_pages', function (Blueprint $table) {
            $table->dropColumn('title');
            $table->dropColumn('excerpt');
            $table->dropColumn('page_text');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('content_pages', function (Blueprint $table) {
            $table->string('title')->nullable();
            $table->longText('excerpt')->nullable();
            $table->longText('page_text')->nullable();
        });
    }
};
