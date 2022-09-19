<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('admin.user.index', ['users' => $users]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if (auth()->user()->role->name !== 'admin') {
            TosterMessage('Sorry! Permission denied!', 'Error');
            return back();
        }
        $roles = Role::all();
        return view('admin.user.edit', ['user' => $user, 'roles' => $roles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if (auth()->user()->id == $user->id) {
            TosterMessage('Sorry! Permission denied!', 'Error');
            return back();
        }

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'role_id' => 'required|integer'
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role_id,
        ]);

        $user ? TosterMessage('User Updated Successfully!', 'Success') : TosterMessage('User Updating Failed!', 'Error');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user->role->name == 'admin') {
            TosterMessage('Sorry! You can\'t Delete Admin!', 'Error');
            return back();
        }

        $user->delete();

        $user ? TosterMessage('User Deleted Successfully!', 'Success') : TosterMessage('User Deleting Failed!', 'Error');
        return back();
    }
}
