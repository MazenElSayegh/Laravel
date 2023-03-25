<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{
    public function store($id)
    {
        // dd(request(), $request);
        $user_id= request()->post_creator;
        $body= request()->body;
        // $id= request()->id;
        $post= Post::find($id);
        // dd($user_id,$body);
        $post->comments()->create([
            'user_id' => $user_id,
            'body' => $body,
        ]);
        
        return back();
    }
}
