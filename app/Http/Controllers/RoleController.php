<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Str;
use Throwable;

class RoleController extends Controller
{
    public function index()
    {
        return view('admin.roles.index',['roles' => Role::all()]);
    }
    public function store(Request $request)
    {
        $request->validate([
                'name' => ['required' , 'min:3']
        ]);

        try{
            Role::create([
                'name' => Str::ucfirst(Str::lower($request->name)),
                'slug' => Str::lower($request->name)
            ]);    
        session()->flash('created','Role Created Successfully');
        return back();
            }
            catch(Throwable $e)
            {
     session()->flash('already_created','Role Already Exists');
        return back();
            }
    }

    public function edit(Role $role)
    {
        return view('admin.roles.edit',
        [
            'role'=>$role,
            'permissions' => Permission::get()
    ]);
    }

    public function update(Role $role,Request $request)
    {
        $request->validate([
            'name' => ['required' , 'min:3',"unique:roles,name,{$role->id}"]
        ]);

        $role->name = Str::ucfirst(Str::lower($request->name));
        $role->slug = Str::lower($request->name);

        if($role->isDirty('name'))  // isClean() is work opposite to this
        {
            session()->flash('updated','Role Updated Successfully');
            $role->save();
            return back();

        }
        else
        {
            session()->flash('not_update',"Nothing To Update");
            return back();

        }

        
    }



    public function attach(Role $role)
    {
        $role->permissions()->attach(request('permission'));
        session()->flash('attached',"Permission Attached Successfully");
        return back();
    }
    public function detach(Role $role)
    {
        $role->permissions()->detach(request('permission'));
        session()->flash('detached',"Permission Detached Successfully");
        return back();
    }





    public function destroy(Role $role)
    {
        $role->delete();
        session()->flash('deleted',"$role->name Deleted Successfully");
        return back();
    }
}
