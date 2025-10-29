<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAddSomeColumnsInJobBoardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_boards', function (Blueprint $table) {
            $table->string('company_name')->after('user_id')->nullable();
            $table->string('vacancy')->after('description')->comment('1 - 100 Or Not Specified')->default('Not Specified')->nullable();
            $table->string('experience_requirements')->after('vacancy')->nullable();
            $table->string('education_requirements')->after('experience_requirements')->comment('Bachelor of Science (BSc) in Computer Science Engineering, Masters')->nullable();
            $table->text('company_information')->after('education_requirements')->nullable();
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
            $table->dropColumn([
                'company_name',
                'vacancy',
                'experience_requirements',
                'education_requirements',
                'company_information',
            ]);
        });
    }
}
