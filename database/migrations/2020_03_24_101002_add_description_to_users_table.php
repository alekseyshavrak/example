<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDescriptionToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->text('description')->nullable()->after('phone');
            $table->text('offer')->nullable()->after('phone');
            $table->string('hometown')->nullable()->after('phone');
            $table->string('location')->nullable()->after('phone');
            $table->date('birthday')->nullable()->after('phone');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['description', 'offer', 'hometown', 'location', 'birthday']);
        });
    }
}
