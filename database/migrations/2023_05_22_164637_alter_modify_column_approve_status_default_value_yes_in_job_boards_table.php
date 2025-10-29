<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterModifyColumnApproveStatusDefaultValueYesInJobBoardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_boards', function (Blueprint $table) {
            $table->string('approve_status')->default('yes')->change()->comment('yes, no');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_boards', function (Blueprint $table) {
            $table->string('approve_status')->default('no')->change()->comment('yes, no');
        });
    }
}
