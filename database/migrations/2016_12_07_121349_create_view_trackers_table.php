<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViewTrackersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('view_trackers', function (Blueprint $table) {
            $table->increments('id');

            $table->string('entity', 175);
            $table->integer('entity_id')->unsigned();
            $table->bigInteger('count')->unsigned()->default(0);

            $table->unique(['entity', 'entity_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('view_trackers');
    }
}