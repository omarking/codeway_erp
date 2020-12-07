<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();

            $table->string('avatar')->nullable()->default('user.png');
            $table->text('description')->nullable();
            $table->date('birthday')->nullable();
            $table->string('facebook', 100)->nullable();
            $table->string('instagram', 100)->nullable();
            $table->string('github', 100)->nullable();
            $table->string('website', 100)->nullable();
            $table->string('other', 100)->nullable();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
