<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSStoryTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_story_tag', function($t) {
            $t->integer('tag_id')->unsigned();
            $t->integer('story_id')->unsigned();
            $t->foreign('tag_id')->references('id')->on('s_tags')->onDelete('cascade');
            $t->foreign('story_id')->references('id')->on('s_stories')->onDelete('cascade');
            
            $t->primary(['tag_id', 'story_id']); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('s_story_tag');
    }
}
