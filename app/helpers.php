<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

if (!function_exists('userFullName')) {
    function userFullName(): string
    {
        return Auth::User()->name ?? '';
    }
}

if (!function_exists('routeNameMatched')) {
    function routeNameMatched($routesName, $output = 'active'): string
    {
        $routesName = Arr::wrap($routesName);
        foreach ($routesName as $routeName) {
            if (Route::currentRouteNamed($routeName)) {
                return $output;
            }
        }
        return '';
    }
}

function generateBatchNumbers(): array
{
    $batchNumbers = [];

    $counter = 1;
    for ($i = 100; $i <= 230; $i++) {
        $batchNameDay = $i . " Day";
        $batchNameEve = $i . " Evening";

        $batchNumbers[$counter++] = $batchNameDay;
        $batchNumbers[$counter++] = $batchNameEve;

    }

    return (collect($batchNumbers)->toArray());
}

function generatePassingYears(): array
{
    $passingYears = [];

    $counter = 1;
    for ($i = 2003; $i <= now()->format('Y'); $i++) {
        $spring = $i . " Spring";
        $summer = $i . " Summer";
        $fall = $i . " Fall";

        $passingYears[$counter++] = $spring;
        $passingYears[$counter++] = $summer;
        $passingYears[$counter++] = $fall;

    }

    return (collect($passingYears)->toArray());
}

function getDepartments(): array
{
    return [
        1 => 'CSE',
        2 => 'EEE',
        3 => 'CIV',
        4 => 'BBA',
        5 => 'ENG',
        6 => 'LLB',
    ];
}

if (! function_exists('isAdmin')) {
    function isAdmin(): bool
    {
        return Auth::user()->role_id === 1;
    }
}

if (! function_exists('isStudent')) {
    function isStudent(): bool
    {
        return Auth::user()->role_id === 3;
    }
}

if (! function_exists('isAlumni')) {
    function isAlumni(): bool
    {
        return Auth::user()->role_id === 2;
    }
}

if (! function_exists('isFaculty')) {
    function isFaculty(): bool
    {
        return Auth::user()->role_id === 4;
    }
}

if (! function_exists('greeting')) {
    function greeting(): string
    {
        date_default_timezone_set(env('TIME_ZONE', 'Asia/Dhaka'));

        $hour = date('H');
        if ($hour >= 5 && $hour <= 11) {
            return 'Good Morning';
        } elseif ($hour >= 12 && $hour <= 16) {
            return 'Good Afternoon';
        } elseif ($hour >= 17 && $hour <= 20) {
            return 'Good Evening';
        } else {
            return 'Good Night';
        }
    }
}

if (! function_exists('getProfilePicture')) {
    function getProfilePicture(): string
    {
        return Auth::user()->avatar ? asset('img/profile/' . Auth::user()->avatar) : asset('img/avatar.jpg');
    }
}

if (! function_exists('getDefaultLogo')) {
    function getDefaultLogo(): string
    {
        return asset('img/logo.jpeg');
    }
}
