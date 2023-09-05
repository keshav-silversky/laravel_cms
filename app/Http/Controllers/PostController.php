<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Exception;
use Illuminate\Contracts\Session\Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller

{
    public function __construct()
    {
        $this->middleware('auth');
            
    }


        public function index()
        {
            $posts = Post::all();
            return view('admin.post.index',['posts' => $posts]);
        }

    public function show(Post $post)
    {
        return view('blog-post',['post' => $post]);
    }
    public function create()
    {
        return view('admin.post.create');
    }
    /*
    |--------------------------------------------------------------------------
    | Store Post in Database
    |--------------------------------------------------------------------------
    |
*/

    public function store(Request $request)
    {
        $inputs = $request->validate([
            'title' => 'required | min:3 | max:50',
            'content' => 'required | min:8 | max:200',
            'image' => 'required | mimes:jpg,jpeg,png'
        ]);

        $file = $request->file('image');
        // $inputs['image'] = "asdfsdfasdfs";
        // $file->move('images',$filesave);
         $filesave=$file->store('public');


        //  echo basename($filesave);
        $user = auth()->user();   

        // Auth()->user()->posts()->create($inputs);

        Post::create(
            [
                "title" => $request->title,
                "content" => $request->content ,
                "user_id" => $user->id, 
                "image" => $filesave
            ]
        ); 
        return redirect()->back()->with('message',"Post Created Successfully");
        
        

    }
}
