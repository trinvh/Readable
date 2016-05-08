<?php

use Illuminate\Database\Migrations\Migration;

class AddSocialLoginsOnUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function ($table) {
            $table->string('facebook')->nullable()->after('password');
            $table->string('github')->nullable()->after('password');
            $table->string('google')->nullable()->after('password');
            $table->string('twitter')->nullable()->after('password');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
