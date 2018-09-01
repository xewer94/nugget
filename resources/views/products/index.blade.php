@extends('layouts.app')

@section('content')
<div class="products-section container">
    <div class="sidebar">
        <h3>Brands</h3>
        <ul>

            @if(Route::getCurrentRoute()->uri() == 'watches' || Route::getCurrentRoute()->uri() == 'search')
                @foreach($brands as $brand)
                    <li><a href="{{ route('watches.index', ['brand' => $brand->name]) }}"> {{$brand->name}} </a></li>
                @endforeach
            @else
                @php
                $path = Request::getPathInfo();
                $parameters = explode('/', $path);
                @endphp
                @foreach($brands as $brand)
                    <li><a href="{{ route('watches.show', ['slug' => $parameters[2], 'brand' => $brand->slug]) }}"> {{$brand->name}} </a></li>
                @endforeach
            @endif
        </ul>
    </div>
    <div class="products text-center">
    @if(isset($products) && count($products) > 0)
        @foreach($products as $product)
            
            <div class="well">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <a href="{{ url('/watches/'.$product->brand->slug.'/'.$product->slug)}}"> <img style="width:100%" src="{{ asset('storage/image/' . $product->image) }}"></a>
                        </div>
                    <div class="col-md-8 col-sm-8">
                    <h3><a href="{{ url('/watches/'.$product->brand->slug.'/'.$product->slug)}}">{{$product->name}}</a></h3>
                        
                            
                    </div>
                    
                </div>
            </div>
        
        @endforeach
        </div>
        {{$products->links()}}
    @else
        <div class="nothing">
        <h1>No watches found</h1>
        </div>
    @endif
    
</div>
@endsection

