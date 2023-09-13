<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        $users = User::all();

        return view('admin.user.index',['users' => $users]);
    }


    public function show(User $user)
    {
        return view('admin.profile',['user' => $user]);
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
}
