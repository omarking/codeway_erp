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

            $table->string('nameUser', 30)->nullable()->after('id');
            $table->string('firstLastname', 30)->nullable()->after('nameUser');
            $table->string('secondLastname', 30)->nullable()->after('firstLastname');
            $table->string('phone', 20)->nullable()->after('secondLastname');
            $table->boolean('status')->nullable()->after('password')->default('1');
            $table->softDeletes()->after('status');

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
