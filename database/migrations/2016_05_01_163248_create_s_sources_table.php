<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSSourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_sources', function($t) {
            $t->increments('id');
            $t->string('name', 255);
            $t->string('url', 255)->unique();
            $t->text('description');
            $t->string('smodel', 500)->nullable();
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
        Schema::drop('s_sources');
    }
}
