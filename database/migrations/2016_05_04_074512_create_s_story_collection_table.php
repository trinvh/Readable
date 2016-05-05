<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSStoryCollectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_story_collection', function($t) {
            $t->integer('story_id')->unsigned();
            $t->integer('collection_id')->unsigned();
            $t->foreign('story_id')->references('id')->on('s_stories')->onDelete('cascade');
            $t->foreign('collection_id')->references('id')->on('s_collections')->onDelete('cascade');
            
            $t->datetime('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('s_story_collection');
    }
}
