<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $allPosts = Post::paginate(7);
        // dd($allPosts);

        return view('posts.index', ['posts' => $allPosts]);
    }

    public function show($id)
    {
        $post= Post::find($id);
        $users= User::all();
        // dd($user->name);

        return view('posts.show', ['post' => $post], ['users'=>$users]);
    }

    public function create()
    {
        // dd("hello");
        $users= User::all();
        return view('posts.create',['users'=>$users]);
    }

    public function store(Request $request)
    {
        $title= request()->title;
        $description= request()->description;
        $postCreator=request()->post_creator;
        // $allData=$request->all();

        // dd($title,$description,$postCreator);
        Post::create([
            'title'=>$title,
            'description'=>$description,
            'user_id'=>$postCreator,
        ]);

        return to_route('posts.index');
    }

    public function edit($id)
    
    {
        $users= User::all();
        $post= Post::find($id);
        return view('posts.edit',['users'=>$users], ['post'=>$post]);
    }

    public function update($id)
    {
        $title= request()->title;
        $description= request()->description;
        $postCreator=request()->post_creator;
        // $id=request()->id;
        // dd(request(),$id);

        // $allData=$request->all();
        Post::where('id',$id)
            ->update([
            'title'=>$title,
            'description'=>$description,
            'user_id'=>$postCreator,
        ]);   
        return redirect()->route('posts.index');        
    }

    public function destroy($id)
    {
        Post::destroy($id);
        return redirect()->route('posts.index');
    }
}