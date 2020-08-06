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
            $table->bigIncrements('id');
            $table->unsignedBigInteger('task_group_id');
            $table->string('title');
            $table->text('content');
            $table->enum('status', ['todo', 'inprogress','completed'])->default('todo');
            $table->enum('level', ['low', 'medium', 'high'])->default('low');
            $table->timestamps();

            $table->foreign('task_group_id')->references('id')->on('task_groups')->onDelete('CASCADE');
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
