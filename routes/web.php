<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolePermissionController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/roles', [RolePermissionController::class, 'createRole']);
Route::post('/permissions', [RolePermissionController::class, 'createPermission']);
Route::post('/assign-role/{user}', [RolePermissionController::class, 'assignRoleToUser']);
Route::post('/assign-permission/{role}', [RolePermissionController::class, 'assignPermissionToRole']);
