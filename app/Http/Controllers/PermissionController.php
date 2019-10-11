<?php

namespace App\Http\Controllers;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::whereIn('id',[1,2])->get();
        $permissions = Permission::all();
        return view('backend.permissions',compact('roles','permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
        'name' => 'required|max:255',
     ]);
        $permission = Permission::create(request(['name']));
        $permission->syncRoles($request->roles);
        return redirect('backend/permissions');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $permissions = Permission::orderBy('id')->get();
        foreach ($permissions as $permission) {
            $permissionToSave = Permission::findOrFail($permission->id);
            $roles = Role::orderBy('id')->get();
            foreach ($roles as $role) {
                $name = "permission-".$permissionToSave->id."-".$role->id;
                if ($request->$name != NULL) {
                    $permissionToSave->assignRole($role);
                } else {
                    $permissionToSave->removeRole($role);
                }
            } 
        }    
        return redirect('backend/permissions');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
