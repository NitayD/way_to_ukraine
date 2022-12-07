<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPurchasingListsTable extends Migration
{
    public function up()
    {
        Schema::table('purchasing_lists', function (Blueprint $table) {
            $table->unsignedBigInteger('funraising_id')->nullable();
            $table->foreign('funraising_id', 'funraising_fk_7702272')->references('id')->on('fundraisings');
            $table->unsignedBigInteger('item_id')->nullable();
            $table->foreign('item_id', 'item_fk_7702273')->references('id')->on('collectibles');
        });
    }
}
