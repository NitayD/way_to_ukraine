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
        Schema::table('aids_items', function (Blueprint $table) {
            $table->unsignedBigInteger('aid_id');
            $table->foreign('aid_id', 'aid_id_fk_7606716')->references('id')->on('aids')->onDelete('cascade');
            $table->unsignedBigInteger('aids_item_id');
            $table->foreign('aids_item_id', 'aids_items_fk_7606716')->references('id')->on('aids_items')->onDelete('cascade');
            $table->unsignedInteger('count');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
