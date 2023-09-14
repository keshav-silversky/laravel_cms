<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Throwable;

class PermissionController extends Controller
{
    public function index()
    {
        
        return view('admin.permissions.index',[
            'permissions' => Permission::get()
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required','min:3']
        ]);

        try{
            Permission::create([
                'name' => Str::ucfirst(Str::lower($request->name)),
                'slug' => Str::lower($request->name)
            ]);    
        session()->flash('created','Permission Created Successfully');
        return back();
            }
            catch(Throwable $e)
            {
     session()->flash('already_created','Permission Already Exists');
        return back();
            }
    }


    public function edit(Permission $permission)
    {
        return view('admin.permissions.edit',['permission' => $permission]);

    }


    public function update(Permission $permission,Request $request)
    {
        $request->validate([
            'name' => ['required' , 'min:3',"unique:permissions,name,{$permission->id}"]
        ]);

        $permission->name = Str::ucfirst(Str::lower($request->name));
        $permission->slug = Str::lower($request->name);

        if($permission->isDirty('name'))  // isClean() is work opposite to this
        {
            session()->flash('updated','Permission Updated Successfully');
            $permission->save();
            return back();  

        }
        else
        {
            session()->flash('not_update',"Nothing To Update");
            return back();

        }
    }


    public function destroy(Permission $permission)
    {
        $permission->delete();
        session()->flash('deleted',"$permission->name Deleted Successfully");
        return back();
    }


}
