<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::query()
            ->with('role')
            ->paginate(15);

        return view('backend.users.index', [
            'users' => $users,
        ]);
    }

    public function view($id)
    {
        $user = User::query()
            ->with([
                'role'
            ])
            ->where('id', $id)
            ->first();

        $batchNumber = (collect(generateBatchNumbers())->get($user->batch_number));
        $passingYear = (collect(generatePassingYears())->get($user->passing_year));
        $departmentId = (collect(getDepartments())->get($user->department_id));

        return view('backend.users.view', [
            'user' => $user,
            'batch_number' => $batchNumber,
            'passing_year' => $passingYear,
            'department' => $departmentId,
        ]);
    }

    public function edit($id)
    {
        $user = User::query()
            ->with([
                'role'
            ])
            ->where('id', $id)
            ->first();

        $roles = Role::all();

        return view('backend.users.edit', [
            'user' => $user,
            'roles' => $roles,
        ]);
    }

    public function update(Request $request, $id)
    {
        $role_id = $request->get('role_id') ?? null;
        $type = $request->get('type') ?? null;
        $status = $request->get('status') ?? null;

        $user = User::query()
            ->with([
                'role'
            ])
            ->where('id', $id)
            ->first();

        $user->role_id = $role_id;
        $user->type = $type;
        $user->status = $status;
        $user->save();



        return redirect('/admin/users')->with('success', 'User updated successfully');
    }
}
