@extends('layouts.app')


@section('title') Index @endsection

@section('content')
    <div class="text-center w-100">
        <button type="button" class="mt-4 btn btn-success border border-dark"><a style="text-decoration: none; color:black" href="{{route('posts.create')}}">Create Post</a></button>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Posted By</th>
            <th scope="col">Created At</th>
            <th scope="col">Slug</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>

        @foreach($posts as $post)
            <tr>
                <td>{{$post->id}}</td>
                <td>{{$post->title}}</td>
                @if($post->user)
                    <td>{{$post->user->name}}</td>
                @else 
                    <td>Not Found</td>
                @endif
                <td>{{$post->created_at->format("Y-m-d")}}</td>
                <td>{{$post->slug}}</td>
                <td>
                    <a href="{{route('posts.show', [$post['id'],$post['slug']])}}" class="btn btn-info">View</a>
                    <a href="{{route('posts.edit',$post["id"]),"/edit"}}" class="btn btn-primary">Edit</a>
                    <form action="{{route('posts.destroy',$post['id'])}}" style="display: inline" method="Post">
                        @csrf
                        @method("DELETE")
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach



        </tbody>
    </table>
    {{$posts->links('pagination::bootstrap-4')}}

@endsection