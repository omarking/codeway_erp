<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsAtUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users',  function (Blueprint $table) {

            $table->string('avatar')->nullable()->after('id')->default('user.png');
            $table->string('nameUser', 30)->nullable()->after('avatar');
            $table->string('firstLastname', 30)->nullable()->after('nameUser');
            $table->string('secondLastname', 30)->nullable()->after('firstLastname');
            $table->string('phoneUser', 20)->nullable()->after('secondLastname');
            $table->boolean('statusUser')->nullable()->after('password');

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
        //
    }
}
