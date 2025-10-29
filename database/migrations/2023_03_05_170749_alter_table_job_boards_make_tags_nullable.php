<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableJobBoardsMakeTagsNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //alter table job_boards make tags nullable
        Schema::table('job_boards', function (Blueprint $table) {
            $table
                ->string('tags')
                ->nullable()
                ->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //alter table job_boards make tags not nullable
        Schema::table('job_boards', function (Blueprint $table) {
            $table
                ->string('tags')
                ->nullable(false)
                ->change();
        });
    }
}
