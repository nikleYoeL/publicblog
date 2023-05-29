<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Permission.index', ['permissions' => Permission::orderBy('id')->paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Permission.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string'
        ]);

        Permission::create(['name' => $validated['name']]);

        return redirect()->route('permission.index')->with('status', 'Право успешно создано');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        return view('Permission.edit', ['permission' => $permission]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission)
    {
        if ($permission->name !== $request->name) {
            $validated = $request->validate([
                'name' => 'required|string|max:32|unique:permissions,name,' . $permission->id
            ]);
            $permission->name = $validated['name'];
            $permission->save();
        }

        if ($permission->wasChanged('name')) {
            return redirect()->route('permission.index')->with('status', 'Право успешно изменено!');
        }

        return redirect()->route('permission.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();

        return redirect()->route('permission.index')->with('status', 'Право удалено');
    }
}
