@extends('layouts.admin')

@section('content')

<h1>Edit User</h1>

<div class="col-sm-3">
    <img src="{{$user->photo ? $user->photo->file: 'no photo added'}}" alt="" class="img-reponsive img-rounded">
</div>


<div class="col-sm-9">

    {!!Form::model($user,['method'=>'patch','action'=>['App\Http\Controllers\AdminUsersController@update',$user->id], 'files'=>true])!!}
    <div class="form-group">
        {!!Form::label('name','Name: ')!!}
        {!!Form::text('name',null,['class'=>'form-control'])!!}
    </div>
    <div class="form-group">
        {!!Form::label('email','Email: ')!!}
        {!!Form::email('email',null,['class'=>'form-control'])!!}
    </div>
    <div class="form-group">
        {!!Form::label('role_id','Role: ')!!}
        {!!Form::select('role_id',array(''=>'Choose Options') + $roles  ,null ,['class'=>'form-control'])!!}
    </div>
    <div class="form-group">
        {!!Form::label('is_active','Status: ')!!}
        {!!Form::select('is_active',array(1 =>'Active', 0 =>'Non-Active'), 0 ,['class'=>'form-control'])!!}
    </div>
    <div class="form-group">
        {!!Form::label('photo_id','File: ')!!}
        {!!Form::file('photo_id', ['class'=>'form-control'])!!}
    </div>
    <div class="form-group">
        {!!Form::label('password','Password: ')!!}
        {!!Form::password('password', ['class'=>'form-control'])!!}
    </div>
    <div class="form-group">
        {!!Form::submit('Edit', ['class'=>'btn btn-primary'])!!}
    </div>
    {!!Form::close()!!}

    @include('includes.form_error')

    @endsection
</div>    