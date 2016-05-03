<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSStoryAuthorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_story_author', function($t) {
            $t->integer('author_id')->unsigned();
            $t->integer('story_id')->unsigned();
            $t->foreign('author_id')->references('id')->on('s_authors')->onDelete('cascade');
            $t->foreign('story_id')->references('id')->on('s_stories')->onDelete('cascade');
            
            $t->primary(['author_id', 'story_id']); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('s_story_author');
    }
}
