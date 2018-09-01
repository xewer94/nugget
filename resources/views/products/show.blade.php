@extends('layouts.app')
@section('title', $product->name)
@include('inc.messages')

@section('content')
    <a href="{{ url()->previous() }}" class="btn btn-default">Go Back</a>
    <h1>{{$product->title}}</h1>
    <br><br>
    <div class="product-section container">

            <div class="product-section-image">

                <img style="width:200px" src="{{ asset('storage/image/' . $product->image) }}">
            </div>
        <div class="product-section-image">

            <img style="width:200px" src="{{ asset('storage/image/' . $product->image) }}">
        </div>

            <div class="col-12 col-md-6">
            <div class="product-section-information">
                    <h1 class="product-section-title">{!!$product->name!!}</h1>
                    <h1 class="product-section-price"> $ {!!$product->price!!}</h1>
                    <div class="product-section-subtitle">{!!$product->details!!} </div>
                    <h1>{!!$product->description!!}</h1>
                    <a href="{{ url('compare/'. $product->id) }}" class="btn btn-info">Compare</a>

            </div>
        </div>
    </div>



<div class="cistac"></div>
    <hr>
    <div class="wrapper">
    <div class="comments">
        <ul class="list-group">
        @foreach ($product->comments as $comment)
        <li class="list-group-item">
                    <h3>{{ $comment->user->name }}</h3>
            <strong>
                    {{$comment->created_at->diffForHumans() }}: &nbsp;
            </strong>

                {{$comment->body}}
        </li>
        @endforeach
    </ul>
    </div>
    </div>
    @if(!Auth::guest())
        @if(Auth::user()->id == $product->user_id)
            <th> <a href="{{ route('watches.edit', ['product' => $product->id]) }}" class="btn btn-info">Edit</a> </th>

            {!!Form::open(['action' => ['ProductController@destroy', $product->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
            {{Form::hidden('_method', 'DELETE')}}
            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
            {!!Form::close()!!}
        @endif
    @endif
            <hr>

    <div class="card">
        <div class="card-block">
        <form method="POST" action="{{ route('watches.comment', [
            'brandSlug' => $product->brand->slug,
            'productSlug' => $product->slug,
        ]) }}">

            {{ csrf_field() }}

               


                <div class="form-group">
                    <textarea name="body" placeholder="Your comment here." class="form-control"></textarea>

                </div>

                <div class="form-group">
                        <button type="submit" class="btn btn-primary">Add comment</button>
                    </div>
        </div>
    </div>
   

@endsection