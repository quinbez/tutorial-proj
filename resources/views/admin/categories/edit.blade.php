@extends('layouts.admin')

@section('content')

    <h1>Edit Category</h1>

        <div class="col-sm-6">
            {!!Form::model($category, ['method'=>'patch', 'action'=>['App\Http\Controllers\AdminCategoriesController@update',$category->id]])!!}
            <div class="form-group">
                {!!Form::label('name', 'Name: ')!!}
                {!!Form::text('name', null, ['class'=>'form-control'])!!}
            </div>
            <div class="form-group">
                {!!Form::submit('Edit Category',['class'=>'btn btn-primary col-sm-6'])!!}
            </div>
            {!!Form::close()!!}
            
            {!!Form::open(['method'=>'delete', 'action'=>['App\Http\Controllers\AdminCategoriesController@destroy', $category -> id]])!!}
            <div class="form-group">
                {!!Form::submit('Delete', ['class'=>'btn btn-danger col-sm-6'])!!}
            </div>
            {!!Form::close()!!}
        </div>

@endsection