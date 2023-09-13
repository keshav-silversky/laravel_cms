<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\Role;
use Error;
use Throwable;

class UserController extends Controller
{

    public function index()
    {
        $users = User::all();

    

        return view('admin.user.index',['users' => $users]);
    }


    public function show(User $user)
    {
        $roles = Role::all();
        return view('admin.profile',['user' => $user,'roles' => $roles]);
    }
    public function update(User $user,Request $request)
    {
        $current_id = auth()->user()->id;
  
        // $inputs = $request->validate([
        //     'username' => ['required' , Rule::unique('users')->ignore(auth()->user()->id) ]
        // ]);
       $inputs = $request->validate([
        'username' => "required | max:255 | string  | unique:users,username,{$current_id}", 
        'name' => 'required | max:255',
        'email' => 'required | max:255',
        'avatar' => 'mimes:jpeg,jpg,png'
       ]);

       if($request->has('avatar'))
       {
        $inputs['avatar'] = $request->avatar->store('uploads');
       }
       $user->update($inputs);
       $request->session()->flash('message','Profile Updated successfully');
       return back();

    }



    public function destroy(User $user)
    {
        $user->delete();
        session()->flash('user-deleted',"User Deleted Successfully");
        return back();

    }

    public function attach(User $user)
    {
   
        try
        {
        $user->roles()->attach([request('role')]);
        session()->flash('attached','Role Attached ');
        return back();
        }
        catch(Throwable $e)
        {
            session()->flash('already_attached','Role Already Attached');
            return back();
                
        }
    }
    public function detach(User $user)
    {
       $role = $user->roles()->whereId(request('role'))->first();
        if($role->name =='Admin')
        {
            session()->flash('already_attached','Cannot Detach Admin Role');
            return back();
        }
        
        $user->roles()->detach([request('role')]);
        session()->flash('detached','Role Detached Successfully');
        return back();
    }



}
