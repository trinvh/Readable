<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSStoryCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_story_category', function($t) {
            $t->integer('category_id')->unsigned();
            $t->integer('story_id')->unsigned();
            $t->foreign('category_id')->references('id')->on('s_categories')->onDelete('cascade');
            $t->foreign('story_id')->references('id')->on('s_stories')->onDelete('cascade');
            
            $t->primary(['category_id', 'story_id']); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('s_story_category');
    }
}
