@extends('layouts.main')
@section('content')
    <div id="admin">
        <h1>Categories Admin Panel</h1>
        <hr>
        <p>Here you can view edit category</p>
        <h2>Categories</h2>
        <hr>
        <ul>
            @foreach($categories as $category)
                <li>
                    {{$category->name}} -
                    {{Form::open(array('url'=>'admin/categories/'.$category->id,'class'=>'form-inline'))}}
                    {{ method_field('delete') }}
                    {{Form::submit('Delete')}}
                    {{Form::close()}}
                </li>
            @endforeach
        </ul>

        <h2>Create New Category</h2>
        <hr>

        @if($errors->has('name'))
            <div id="form-errors">

                <p>The following errors have occurred</p>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{Form::open(array('url'=>'admin/categories'))}}
        <p>
            {{Form::label('Name')}}
            {{Form::text('name')}}
        </p>

        {{Form::submit('Create Category',array('class'=>'secondary-cart-btn'))}}
        {{Form::close()}}
    </div>
@stop