<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class CustomAuthenticateRedirectController extends Controller
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function showMessageAndRedirect()
    {
        if (session()->get('success')) {
            return view('skeleton.custom-authenticate-redirect-user');

        } else {
            Auth::logout();
            return redirect('/login');
        }
    }
}
