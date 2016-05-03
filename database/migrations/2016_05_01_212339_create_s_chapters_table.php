<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSChaptersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_chapters', function($t) {
            $t->increments('id');
            $t->string('name', 255);
            $t->string('slug', 255)->unique();
            $t->string('info', 500)->nullable();
            $t->longText('content');
            $t->integer('sort_order')->default(0);
            $t->integer('viewed')->default(0);
            
            $t->integer('story_id')->unsigned();
            $t->foreign('story_id')->references('id')->on('s_stories')->onDelete('cascade');
            
            $t->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('s_chapters');
    }
}
