<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToRequisitesTable extends Migration
{
    public function up()
    {
        Schema::table('requisites', function (Blueprint $table) {
            $table->unsignedBigInteger('group_id')->nullable();
            $table->foreign('group_id', 'group_fk_7607409')->references('id')->on('requisite_groups');
        });
    }
}
