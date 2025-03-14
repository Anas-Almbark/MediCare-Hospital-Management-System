<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{

    public function index()
    {
        $permissions = Permission::all();
        return view('dashboard.permissions.permissions', compact('permissions'));
    }

    public function create()
    {
        $roles = Role::all();
        return view("dashboard.permissions.addPermission", compact("roles"));
    }

    public function store(Request $request)
    {
        $validation = $request->validate([
            "name" => "required|unique:roles",
        ]);
        Permission::create($validation);
        return redirect()->route("permission.index")->with("success", "Permission created successfully!");
    }
    public function edit(Permission $permission)
    {
        return view("dashboard.permissions.editPermission", compact("permission"));
    }
    public function update(Request $request, Permission $permission)
    {
        $validation = $request->validate([
            "name" => "required|unique:roles",
        ]);
        $permission->update($validation);
        return redirect()->route("permission.index")->with("success", "Permission updated successfully!");
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
        return redirect()->route("permission.index")->with("success", "Permission deleted successfully!");
    }
}
