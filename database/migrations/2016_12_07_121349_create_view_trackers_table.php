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
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->string('entity')->index();
            $table->integer('entity_id')->unsigned()->index();
            $table->bigInteger('count')->unsigned()->default(0)->index();

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
