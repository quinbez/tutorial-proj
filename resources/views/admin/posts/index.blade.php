@extends('layouts.admin')
@section('content')


<h1>Posts</h1>
<table class='table'>
    <thead>
        <tr>
            <th>Id</th>
            <th>User</th>
            <th>Category</th>
            <th>Photo</th>
            <th>Title</th>
            <th>Description</th>
            <th>Created</th>
            <th>Updated</th>
        </tr>
    </thead>
    
    <tbody>
    @if($posts)

        @foreach($posts as $post)

        <tr>
            <td>{{$post->id}}</td>
            <td><a href="{{route('admin.posts.edit', $post->id)}}">{{$post->user->name ?? 'None'}}</a></td>
            <td>{{$post->category ? $post->category->name : "Uncategorized"}}</td>
            <td><img height = "50" src="{{$post->photo ? $post->photo->file: 'no photo'}}" alt=""></td>
            <td>{{$post->title}}</td>
            <td>{{$post->description}}</td>
            <td>{{$post->created_at->diffForHumans()}}</td>
            <td>{{$post->updated_at->diffForHumans()}}</td>

        </tr>

        @endforeach

    @endif
    
    </tbody>
</table>


@stop