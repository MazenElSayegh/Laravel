@extends('layouts.app')

@section('title') Show @endsection

@section('content')
    <div class="card mt-10" style="margin-top: 10px">
        <div class="card-header mt-10">
            Post Info
        </div>
        <div class="card-body">
            <h5 class="card-title">Title: <span style="font-size: 18px">{{$post['title']}}</span></h5>
            <p class="card-text">Description: {{$post['description']}}</p>
        </div>
    </div>

    <div class="card my-10" style="margin-top: 10px">
        <div class="card-header">
            Post Creator Info
        </div>
        <div class="card-body">
            <h5 class="card-title">Name: <span style="font-size: 18px">{{$post->user->name}}</span></h5>
            <h5 class="card-title">Email: <span style="font-size: 18px">{{$post->user->email}}</span></h5>
            <h5 class="card-title">Created At: <span style="font-size: 18px">{{$post->created_at->format("Y-m-d")}}</span></h5>
        </div>
    </div>

    <div class="card" style="margin-top: 10px">
        <div class="card-header bg-success p-2 text-dark bg-opacity-50">
            Comments
        </div>
        <div class="card-body">
            {{-- @dd(count($post->comments)) --}}
            @if(count($post->comments) > 0)
                @foreach($post->comments as $comment)
                <div class="card" style="margin: 10px">
                    <div class="card-body bg-dark p-2 text-white bg-opacity-75 rounded-3">
                        <p >{{$comment->user->name}}&nbsp; <i style="font-size: 12px">{{$comment->created_at->format("d/m/Y")}}</i></p>
                        <p>"<i>{{$comment->body}}</i>"</p>
                    </div>
                </div>
                @endforeach
            @else
            <div class="card" style="margin: 10px">
                <div class="card-body bg-dark p-2 text-white bg-opacity-75 rounded-3">
                    <p ><i>No comments</i></p>
                </div>
            </div>
            @endif
        </div>
    </div>


    <div class="card" style="margin-top: 10px; padding: 20px">
        <div class="card-header">
            Add Comment
        </div>
        <form action="{{route('comments.store',['id'=>$post['id']])}}" method="POST">
            @csrf
            <div class="mb-3" style="margin-top: 30px">
                <textarea name="body" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>

            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Commentor</label>
                <select name="post_creator" class="form-control">
                    @foreach($users as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Comment</button>
        </form>
    </div> 
    {{-- @dd($post->image_path) --}}
    {{-- <img src="../../storage/app/{{$post->image_path}}"> --}}

@endsection