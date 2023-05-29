<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        return view('User.index', ['users' => User::orderBy('id')->paginate(10)]);
    }

    public function update(Request $request, User $user)
    {
        if ($user->hasRole('super-admin') && !($request->user()->hasRole('super-admin'))) {
            abort(403);
        }

        $user->changeBlockingStatus();

        return back()->with('status', 'Статус пользователя '. $user->name .' изменён');
    }

    public function roleUpdateShow(User $user) {
        return view('User.role-update', ['roles' => Role::all(), 'user' => $user]);
    }

    public function roleUpdate(Request $request, User $user)
    {
        $user->syncRoles(
            array_keys($request->except('_token', '_method'))
        );

        return redirect()->route('user.index');
    }

    public function permissionUpdateShow(User $user)
    {
        return view('User.permission-update', ['permissions' => Permission::all(), 'user' => $user]);
    }

    public function permissionUpdate(Request $request, User $user)
    {
        $user->syncPermissions(
            array_keys($request->except('_token', '_method'))
        );

        return redirect()->route('user.index');
    }
}
