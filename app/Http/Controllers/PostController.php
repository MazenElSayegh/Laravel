<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use App\Models\User;
use App\Http\Requests\UpdatePostRequest;
use App\Jobs\PruneOldPostsJob;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $allPosts = Post::paginate(5);
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

    public function store(StorePostRequest $request)
    {
        $title= request()->title;
        $description= request()->description;
        $postCreator=request()->post_creator;
        // $allData=$request->all();

        // dd($title,$description,$postCreator);
        $post=Post::create([
            'title'=>$title,
            'description'=>$description,
            'user_id'=>$postCreator,
        ]);
        // $slug = SlugService::createSlug(Post::class, 'slug', request()->title);
        if ($request->hasFile('fileToUpload')) {
            $image = $request->file('fileToUpload');
            $filename = $image->getClientOriginalName();
            $path = Storage::putFileAs('postsImages', $image, $filename);
            $post->image_path = $path;
            $post->save();
        }

        return to_route('posts.index');
    }

    public function edit($id)
    
    {
        $users= User::all();
        $post= Post::find($id);
        return view('posts.edit',['users'=>$users], ['post'=>$post]);
    }

    public function update(UpdatePostRequest $request,$id)
    {
        // dd($request);
        // dd($request['id'],$id,request()->id);
        $post = Post::findOrFail($id);

        if ($request->hasFile('fileToUpload')) {
            if ($post->image_path) {
                Storage::delete($post->image_path);
            }
            $image = $request->file('fileToUpload');
            $filename = $image->getClientOriginalName();
            $path = Storage::putFileAs('postsImages', $image, $filename);
            $post->image_path = $path;
            $post->save();
        }

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
            'slug' => Str::slug($title),
        ]);   

        return redirect()->route('posts.index');        
    }

    public function destroy($id)
    {
    $post = Post::findOrFail($id);
    Post::destroy($id);
    if ($post->image_path && Storage::exists($post->image_path)) {
        Storage::delete($post->image_path);
    }
    return redirect()->route('posts.index');
}

    public function removeOldPosts()
    {
        // dispatch(new PruneOldPostsJob);
        
        PruneOldPostsJob::dispatch();
        
        return to_route('posts.index');
    }
}