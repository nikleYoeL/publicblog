<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Role.index', ['roles' => Role::orderBy('id')->paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Role.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string'
        ]);

        Role::create(['name' => $validated['name']]);

        return redirect()->route('role.index')->with('status', 'Роль успешно добавлена');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        return view('Role.show', ['role' => $role, 'permissions' => Permission::all()]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        return view('Role.edit', ['role' => $role, 'permissions' => Permission::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        if ($role->name !== $request->name) {
            $validated = $request->validate([
                'name' => 'required|string|max:32|unique:roles,name,' . $role->id
            ]);
            $role->name = $validated['name'];
            $role->save();
        }

        if ($request->has('permission')) {
            $permissions = array_keys($request->permission);

            $role->syncPermissions($permissions);
        } else {
            $role->syncPermissions();
        }

        if ($role->wasChanged()) {
            return redirect()->route('role.index')->with('status', 'Роль успешно изменена');
        }

        return redirect()->route('role.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('role.index')->with('status', 'Роль удалена');
    }
}
