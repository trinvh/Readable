<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSStoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_stories', function($t) {
            $t->increments('id');
            $t->string('name', 255);
            $t->string('slug', 255)->unique();
            $t->string('photo', 255)->nullable();
            $t->text('description');
            
            $t->integer('viewed')->default(0);
            
            $t->softDeletes();
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
        Schema::drop('s_stories');
    }
}
