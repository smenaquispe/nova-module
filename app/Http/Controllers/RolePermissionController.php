<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionController extends Controller
{
    public function createRole(Request $request) {
        $role = Role::create(["name" => $request->name]);
        return response()->json($role);
    }

    public function createPermission(Request $request) {
        $permission = Permission::create(["name" => $request->name]);
        return response()->json($permission);
    }

    public function assignRoleToUser(Request $request) {
        $user = $request->user;
        $role = $request->role;
        $user->assignRole($role);
        return response()->json($user);
    }

    public function assignPermissionToRole(Request $request) {
        $role = $request->role;
        $permission = $request->permission;
        $role->givePermissionTo($permission);
        return response()->json($role);
    }
}
