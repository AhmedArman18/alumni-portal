<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use PHPUnit\Exception;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::query()->truncate();

        $roles = [
            ["name" => 'Admin'],
            ["name" => 'Alumni'],
            ["name" => 'Student'],
            ["name" => 'Faculty'],
        ];

        try {
            Role::query()->insert($roles);
        } Catch (Exception $exception) {
            echo $exception;
        }

    }
}
