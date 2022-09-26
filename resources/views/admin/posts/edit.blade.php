@extends('layouts.admin')
@section('content')


<h1>Edit Post</h1>

<div class="row">
<div class="col-sm-3">
    <img src="{{$post->photo->file}}" alt="" class="img-responsive">
</div>


<div class="col-sm-9">
    {!!Form::model($post, ['method'=>'patch','action'=>['App\Http\Controllers\AdminPostsController@update', $post->id], 'files'=>true])!!}
    <div class="form-group">
        {!!Form::label('title','Title: ')!!}
        {!!Form::text('title',null,['class'=>'form-control'])!!}
    </div>
    <div class="form-group">
        {!!Form::label('category_id','Category: ')!!}
        {!!Form::select('category_id',[''=>'Choose Categories'] + $categories,null,['class'=>'form-control'])!!}
    </div>
    <div class="form-group">
        {!!Form::label('photo_id','Photo: ')!!}
        {!!Form::file('photo_id', null, ['class'=>'form-control'])!!}
    </div>
    <div class="form-group">
        {!!Form::label('description','Description: ')!!}
        {!!Form::textarea('description',null,['class'=>'form-control'])!!}
    </div>

    <div class="form-group">
        {!!Form::submit('Edit', ['class' => 'btn btn-primary col-sm-6'])!!}
    </div>
    
    {!!Form::close()!!}

    {!!Form::open(['method'=>'delete', 'action'=>['App\Http\Controllers\AdminPostsController@destroy', $post->id]])!!}

    <div class="form-group">
        {!!Form::submit('Delete', ['class'=> "btn btn-danger col-sm-6"])!!}
    </div>
    {!!Form::close()!!}
    </div>
</div>

<div class='row'>
@include('includes.form_error')
</div>

@stop