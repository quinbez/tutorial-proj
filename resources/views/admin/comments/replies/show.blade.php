@extends('layouts.admin')

@section('content')


@if(count($replies)>0)

<h1>replies</h1>

<table class="table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Email</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        @foreach($replies as $reply)
        <tr>
            <td>{{$reply->id}}</td>
            <td>{{$reply->author}}</td>
            <td>{{$reply->email}}</td>
            <td>{{$reply->description}}</td>
            <td><a href="{{route('home.post', $reply->comment->post->id)}}">View Post</a></td>
            <td>
                @if($reply->is_active == 1)

                {!!Form::open(['method'=>'patch', 'action'=>['App\Http\Controllers\CommentReplyController@update', $reply->id]])!!}
               <input type="hidden" name="is_active" value="0">
                    <div class="form-group">
                        {!!Form::submit("Un-approve", ['class'=> 'btn btn-success'])!!}
                    </div>
                {!!Form::close()!!}
                @else

                {!!Form::open(['method'=>'patch', 'action'=>['App\Http\Controllers\CommentReplyController@update', $reply->id]])!!}
               <input type="hidden" name="is_active" value="1">
                    <div class="form-group">
                        {!!Form::submit("Approve", ['class'=> 'btn btn-info'])!!}
                    </div>
                {!!Form::close()!!}

                @endif
            </td>
            <td>
            {!!Form::open(['method'=>'delete', 'action'=>['App\Http\Controllers\CommentReplyController@destroy', $reply->id]])!!}
                <div class="form-group">
                    {!!Form::submit("Delete", ['class'=> 'btn btn-danger'])!!}
                </div>
            {!!Form::close()!!}
            </td>
        </tr> 
        @endforeach
    </tbody>
</table>
 

@else 
   
    <h1 class="text-center">No reply</h1>

@endif

@endsection