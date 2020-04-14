<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePracticeUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('practice_user', function (Blueprint $table) {

            # Column
            $table->bigInteger('practice_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->enum('type', ['expertise', 'request']);


            # Index
            $table->index('practice_id');
            $table->index('user_id');
            $table->unique(['practice_id', 'user_id', 'type']);


            # Constraints
            $table->foreign('practice_id')->references('id')->on('practices')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('practice_user', function (Blueprint $table) {
            $table->dropForeign(['practice_id']);
            $table->dropForeign(['user_id']);
        });

        Schema::dropIfExists('expertise_user');
    }
}
