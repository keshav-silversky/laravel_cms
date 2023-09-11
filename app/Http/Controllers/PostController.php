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
        //  $posts = Post::orderBy('id','desc')->get();
        // $posts = auth()->user()->posts;
        $posts = auth()->user()->posts()->paginate(5);

            // ddd($posts);
        // $posts = Post::all();
         return view('admin.post.index',['posts' => $posts]);
     }

    public function show(Post $post) // Route Model Binding
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
            'content' => 'required | min:3 | max:200',
            'image' => 'required | mimes:jpg,jpeg,png'
        ]);

        $file = $request->file('image');
        // $inputs['image'] = "asdfsdfasdfs";
        // $file->move('images',$filesave);

         $filesave=$file->store('uploads');


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

    public function destroy(Post $post) // Route Model Binding
    {
        $this->authorize('view',$post);

        Post::findOrFail($post->id)->delete();
        session()->flash('message','Post Deleted Successfully');
        return back();
    }

    public function edit(Post $post)
    {
        // $this->authorize('view',$post);
        return view('admin.post.edit',['post' => $post]);
    }

    public function update(Request $request,Post $post)  // Route Model Binding
    {
       $inputs = request()->validate([

        'title' => 'required | min:3 | max:50',
        // 'content' => 'required | min:3',
        'image' => 'mimes:png,jpg,jpeg'
       ]);
       
       if($file = $request->file('image'))
       {   
        $filesave = $file->store('uploads'); 
        $post->image=$filesave;
       }

 
       $post->title = $request->title;
       $post->content = $request->content;


       $this->authorize('update',$post);

       auth()->user()->posts()->save($post);
    // $post->update([$post]);

       $request->session()->flash('update','Post Updated Successfully');

       return redirect()->route('all.post');



    }

}
