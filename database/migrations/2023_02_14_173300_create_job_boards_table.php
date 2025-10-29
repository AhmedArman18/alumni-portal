<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobBoardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_boards', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->text('title');
            $table->text('description');
            $table->string('image')->nullable();
            $table->json('tags')->nullable();
            $table->string('job_type')->comment('intern, fulltime, part-time');
            $table->double('salary');
            $table->string('location');
            $table->date('application_deadline');
            $table->string('approve_status')->default('no')->comment('yes, no');
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
        Schema::dropIfExists('job_boards');
    }
}
