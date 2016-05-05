<?php

use Illuminate\Database\Migrations\Migration;

class CreateSCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_categories', function ($t) {
            $t->increments('id');
            $t->string('name', 255);
            $t->string('slug', 255)->unique();
            $t->text('description');
            $t->boolean('active')->default(true);
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
        Schema::drop('s_categories');
    }
}
