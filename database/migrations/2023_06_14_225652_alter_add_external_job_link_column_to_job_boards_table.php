<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAddExternalJobLinkColumnToJobBoardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_boards', function (Blueprint $table) {
            $table->text('external_job_link')->after('approve_status')->nullable();
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
            $table->dropColumn(['external_job_link']);
        });
    }
}
