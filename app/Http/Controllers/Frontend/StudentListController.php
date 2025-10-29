<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;

class StudentListController extends Controller
{
    public function index()
    {

        $students = User::query()
            ->where('role_id', Role::ROLE_STUDENT)
            ->get();

        $user = new User();

        return view('public.student.index', compact('students', 'user'));
    }
}
