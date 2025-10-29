<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class RedirectAuthenticatedUsersController extends Controller
{
    public function home()
    {
        // 1 = Admin, 2 = Alumni, 3 = Student, 4 = Faculty
        if (auth()->user()->role->id == 1) {
            return redirect('/admin/dashboard');
        } else if (auth()->user()->role->id == 2) {
            return redirect('/backend/alumni');
        } else if (auth()->user()->role->id == 3) {
            return redirect('/backend/student');
        } else if (auth()->user()->role->id == null) {
            return redirect('/custom-authenticate-redirect');
        }
    }
}
