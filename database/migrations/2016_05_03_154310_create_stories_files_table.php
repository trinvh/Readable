<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoriesFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("s_story_files", function($t) {
           $t->uuid('id');
           $t->string('path');
           $t->string('file_type', 10)->default('epub');
           $t->integer('total_chapters')->default(0);
           
           $t->integer('story_id')->unsigned();
           $t->foreign('story_id')->references('id')->on('s_stories')->onDelete('cascade');
           
           $t->timestamps();           
           $t->primary('id');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('s_story_files');
    }
}
