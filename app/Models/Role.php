<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';

    protected $fillable = ["name"];

    const ROLE_ADMIN = 1;
    const ROLE_ALUMNI = 2;
    const ROLE_STUDENT = 3;
    const ROLE_FACULTY = 4;

}
