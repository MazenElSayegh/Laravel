@extends('layouts.app')


@section('title') Create @endsection

@section('content')

@if ($errors->any())
<br>
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{route('posts.store')}}" method="POST">
  @csrf
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Title</label>
      <input name="title" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
      <label for="exampleFormControlTextarea1" class="form-label">Description</label>
      <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
    </div>
    {{-- <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Slug</label>
      <input name="slug" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    </div>     --}}
    <div class="mb-3">
      <label for="exampleFormControlTextarea1" class="form-label">Post Creator</label>
      <select name="post_creator" class="form-control">
        {{-- <option selected hidden value="{{$user->id}}">{{$user->name}}</option>  --}}
        {{-- <option value="{{$post->user->id}}">{{$post->user->name}}</option> --}}
          @foreach($users as $user)
              <option value="{{$user->id}}">{{$user->name}}</option>
          @endforeach
      </select>
    </div>
    <button type="submit" class="btn btn-success">Create</button>
  </form>
 

@endsection