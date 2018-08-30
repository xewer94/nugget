@extends('layouts.app')

@section('content')
    <h1>Edit</h1>
    {!! Form::open(['route' => ['watches.update', $product->id], 'method' => 'put', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('name', 'Name')}}
            {{Form::text('name', $product->name, ['class' => 'form-control', 'placeholder' => 'Name'])}}
        </div>
        <div class="form-group">
            {{Form::label('slug', 'Slug')}}
            {{Form::text('slug', $product->slug, ['class' => 'form-control', 'placeholder' => 'Slug'])}}
        </div>
        <div class="form-group">
            {{Form::label('price', 'Price')}}
            {{Form::text('price', $product->price, ['class' => 'form-control', 'placeholder' => 'Price'])}}
        </div>
        <div class="form-group">
            {{Form::label('details', 'Details')}}
            {{Form::text('details', $product->details, ['class' => 'form-control', 'placeholder' => 'Details'])}}
        </div>

        <div class="form-group">
            {{Form::label('description', 'Description')}}
            {{Form::textarea('description', $product->description, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Description'])}}
        </div>
        <div class="form-group">
            {{Form::file('image')}}
            <div class="well">
                <img src="{{ asset('storage/image/' . $product->image) }}">
            </div>
        </div>
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection