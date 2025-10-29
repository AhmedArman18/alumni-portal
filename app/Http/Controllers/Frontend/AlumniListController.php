<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;

class AlumniListController extends Controller
{
    public function index()
    {
        $alumni = User::query()
            ->where('role_id', Role::ROLE_ALUMNI)
            ->get();

        $user = new User();

        return view('public.alumni.index', compact('alumni', 'user'));
    }
}
