<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('dashboard.roles.roles', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view("dashboard.roles.addRole", compact("permissions"));
    }

    public function store(Request $request)
    {
        $validation = $request->validate([
            "name" => "required|unique:roles",
            "permissions" => "nullable|array",
            "permissions.*" => "exists:permissions,name"
        ]);
        $role = Role::create(['name' => $validation['name']]);
        $role->syncPermissions($request->permissions);

        return redirect()->route("role.index")->with("success", "Role created successfully with permissions!");
    }
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        $selectedPermissions = $role->permissions->pluck('name')->toArray();

        return view('dashboard.roles.editRole', compact('role', 'permissions', 'selectedPermissions'));
    }
    public function update(Request $request, Role $role)
    {
        $validation = $request->validate([
            "name" => "sometimes|unique:roles,name," . $role->id,
            "permissions" => "required|array",
            "permissions.*" => "exists:permissions,name"
        ]);
        $role->update(['name' => $validation['name']]);
        $role->syncPermissions($request->permissions);
        return redirect()->route("role.index")->with("success", "Role updated successfully!");
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route("role.index")->with("success", "Role deleted successfully!");
    }
}
