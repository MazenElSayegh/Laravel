@extends('layouts.app')


@section('title') Update @endsection

@section('content')

<form action=" {{route('posts.update',$post)}}" method="POST">  
  @csrf
  @method ("PUT")
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Title</label>
      <input name="title" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$post->title}}">
    </div>
    <div class="mb-3">
      <label for="exampleFormControlTextarea1" class="form-label">Description</label>
      <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3">{{$post->description}}</textarea>
    </div>
    <div class="mb-3">
      <label for="exampleFormControlTextarea1" class="form-label">Post Creator</label>
      <select name="post_creator" class="form-control">
          <option value="{{$post->user->id}}">{{$post->user->name}}</option>
          @foreach($users as $user)
            @if($user->id==$post->user->id)
              @continue;
            @else
              <option value="{{$user->id}}">{{$user->name}}</option>
            @endif
          @endforeach
      </select>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
  </form>


@endsection