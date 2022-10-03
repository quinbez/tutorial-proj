@extends('layouts.blog-post')

@section('content')

    <!-- Blog Post -->

    <!-- Title -->
    <h1><br><br>{{$post->title}}</h1>

    <!-- Author -->
    <p class="lead">
        by <a href="#">{{$post->user->name}}</a>
    </p>

    <hr>

    <!-- Date/Time -->
    <p><span class="glyphicon glyphicon-time"></span> Posted {{$post->created_at->diffForHumans()}}</p>

    <hr>

    <!-- Preview Image -->
    <img class="img-responsive" src="{{$post->photo->file}}" alt="">

    <hr>

    <!-- Post Content -->
    <p>{{$post->description}}</p>
    <hr>

    <!-- Blog Comments -->

    <!-- Comments Form -->
    <div class="well">
        <h4>Leave a Comment:</h4>
       {!!Form::open(['method'=>'post', 'action'=>'App\Http\Controllers\PostCommentsController@store'])!!}
       
       <input type="hidden" name="post_id" value="{{$post->id}}">
       <div class="form-group">
            {!!Form::label('description', "Description: ")!!}
            {!!Form::textarea('description',null ,['class'=>'form-control', 'rows'=>3])!!}
        </div>   
        <div class="form-group">
           
            {!!Form::submit('Submit Comment',['class'=>'btn btn-primary'])!!}
        </div>
    </div>

    <hr>

    @if(count($comments)>0)
    <!-- Posted Comments -->
    @foreach($comments as $comment)

    <!-- Comment -->
    <div class="media">
        <a class="pull-left" href="#">
            <img class="media-object" src="http://placehold.it/64x64" alt="">
        </a>
        <div class="media-body">
            <h4 class="media-heading">{{$comment->author}}
                <small>{{$comment->created_at->diffForHumans()}}</small>
            </h4>
            <p>{{$comment->description}}</p>  


            @if(count($comment->replies) > 0)

                @foreach($comment->replies as $reply)

             <!-- Nested Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">{{$reply->author}}
                            <small>{{$reply->created_at->diffForHumans()}}</small>
                        </h4>
                        <p>{{$reply->description}}</p>       
                    </div>
                   
                    <div class="comment-reply-container">
                    
                    <button class="toggle_reply btn btn-primary pull-right" id="hideshow">Reply</button>
                    
                    <div class="comment_reply col-sm-6">

                        {!!Form::open(['method'=>'post', 'action'=>'App\Http\Controllers\CommentRepliesController@createReply'])!!}
                        <div class="form-group">
                            <input type="hidden" name="comment_id" value="{{$comment->id}}">
                            {!!Form::label('description', 'Description: ')!!}
                            {!!Form::textarea('description',null ,['class'=>'form-control','rows'=>1])!!}
                        </div>
                        <div class="form-group">
                            {!!Form::submit('Submit', ['class'=>'btn btn-primary'])!!}
                        </div>
                        {!!Form::close()!!}
                    </div>
                    </div>
                    <!-- End Nested Comment -->
                     </div>
                    @endforeach
                    @endif
                </div>
    </div>

    @endforeach

@endif
@endsection

@section('scripts')

<script>
    $("#hideshow").click(function() {
        $(".comment_reply").slideToggle();
    });
</script>

@endsection
