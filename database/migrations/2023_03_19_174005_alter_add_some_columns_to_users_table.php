<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAddSomeColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedInteger('batch_number')->after('email')->nullable();
            $table->unsignedInteger('passing_year')->after('batch_number')->nullable();
            $table->unsignedInteger('department_id')->after('passing_year')->nullable();
            $table->string('student_id_number')->after('department_id')->nullable();
            $table->string('phone')->after('student_id_number')->nullable();
            $table->text('address')->after('phone')->nullable();
            $table->unsignedInteger('role_id')->after('address')->nullable();
            $table->string('type')->after('role_id')->nullable()->comment('alumni, student, faculty');
            $table->unsignedInteger('status')->after('type')->default(0)->comment('1 = Active, 0 = Inactive');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'batch_number', 'passing_year', 'department_id',
                'student_id_number','phone', 'address',
                'role_id','type', 'status',
            ]);
        });
    }
}
