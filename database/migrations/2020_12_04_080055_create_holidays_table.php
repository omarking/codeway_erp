<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHolidaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('holidays', function (Blueprint $table) {
            $table->id();

            $table->integer('days');
            $table->date('beginDate');
            $table->date('endDate');
            $table->integer('inProcess');
            $table->integer('taken');
            $table->double('available');
            $table->text('commentable');
            $table->foreignId('absence_id')->references('id')->on('absences')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('period_id')->references('id')->on('periods')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('holidays');
    }
}
