<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSStorySourceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_story_source', function($t) {
           $t->integer('story_id')->unsigned();
           $t->integer('source_id')->unsigned();
           
           $t->foreign('story_id')->references('id')->on('s_stories')->onDelete('cascade');
           $t->foreign('source_id')->references('id')->on('s_sources')->onDelete('cascade');
           $t->integer('priority')->default(0);
           $t->string('url', 255);
           $t->text('data'); // Save as json
           
           $t->primary(['story_id', 'source_id']); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('s_story_source');
    }
}
