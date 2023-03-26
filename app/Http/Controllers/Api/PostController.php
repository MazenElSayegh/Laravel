<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;
use App\Http\Controllers\Api\RegistrationSuccess;

class PostController extends Controller
{
    public function index(){
        // $allPosts = Post::paginate(5);
        $allPosts = Post::all();

        // foreach ($allPosts as $post) {
        //     if (User::for($post)->active('notifications-beta')) {
        //         $post->notify(new RegistrationSuccess);
        //     }
        // }

        return PostResource::collection($allPosts);

        // $response=[];
        // foreach ($allPosts as $post){
        //     $response[]=[
        //         'id'=> $post->id,
        //         'title'=>$post->title,
        //         'description'=>$post->description,
        //     ];
        // }
        // return $response;
    }

    public function show($id)
    {
        $post= Post::find($id);
        // dd($user->name);
        // $response=[
        //     'id'=> $post->id,
        //     'title'=>$post->title,
        //     'description'=>$post->description,
        // ];

        return new PostResource($post);
    }

    public function store(StorePostRequest $request)
    {
        $title= request()->title;
        $description= request()->description;
        $postCreator=request()->post_creator;

        $post=Post::create([
            'title'=>$title,
            'description'=>$description,
            'user_id'=>$postCreator,
        ]);

        return new PostResource($post);
    } 
}
