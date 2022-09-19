<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::whereNotIn('name', ['admin'])->with('permissions')->withCount('permissions')->paginate(10);
        return view('admin.role.index', ['roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:roles,name'
        ]);

        $created = Role::create([
            'name' => $request->name
        ]);

        $created ? TosterMessage('Role Created Successfully!', 'Success') : TosterMessage('Role Creation Failed!', 'Error');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        $permissions = Permission::all();
        return view('admin.role.set-permission', ['role' => $role, 'permissions' => $permissions]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        if($role->name == 'admin') {
            TosterMessage('Sorry! Permission denied!', 'Error');
            return back();
        }
        return view('admin.role.edit', ['role' => $role]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|string|unique:roles,name,'.$role->id
        ]);

        $updated = $role->update([
            'name' => $request->name
        ]);

        $updated ? TosterMessage('Role Updated Successfully!', 'Success') : TosterMessage('Role Updating Failed!', 'Error');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        if($role->name == 'admin') {
            TosterMessage('Sorry! Permission denied!', 'Error');
            return back();
        }
        $deleted = $role->delete();
        $deleted ? TosterMessage('Role Deleted Successfully!', 'Success') : TosterMessage('Role Deleting Failed!', 'Error');
        return back();
    }

    public function setPermissions(Role $role, Request $request)
    {
        $sync = $role->permissions()->sync($request->permissions);
        $sync ? TosterMessage('Permissions Updated Successfully!', 'Success') : TosterMessage('Permission Updating Failed!', 'Error');
        return back();
    }
}
