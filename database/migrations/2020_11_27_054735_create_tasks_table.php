<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->text('description');
            $table->date('date-start');
            $table->date('date-end');
            $table->foreignId('statu_id')->references('id')->on('status')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('priority_id')->references('id')->on('priorities')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('type_id')->references('id')->on('types')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('tasks');
    }
}
