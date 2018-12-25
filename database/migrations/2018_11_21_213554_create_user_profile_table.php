<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profile', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
			$table->string('uuid');
            $table->date('birthday')->nullable();
            $table->string('avatar')->nullable();
			$table->string('address')->nullable();
			$table->unsignedInteger('country_id')->nullable();
            $table->timestamps();

            $table->index('user_id');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_profile', function (Blueprint $table) {
            $table->dropForeign('user_profile_user_id_foreign');
        });

        Schema::dropIfExists('user_profile');
    }
}
