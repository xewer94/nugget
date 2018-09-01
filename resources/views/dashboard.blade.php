@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Admin panel</div>

                <div class="panel-body">
                    <a href="{{ route('watches.create') }} " class="btn btn-primary">Add Watch</a>


                    <table class="table table-hover">
                        <thead>
                          <th> </th>


                        </thead>



                     @foreach ($products as $product)
                         <tr>

                             <th><a href="{{ url('/watches/'.$product->brand->slug.'/'.$product->slug)}}"> <img style="width:8%" src="{{ asset('storage/image/' . $product->image) }}">
                                 {{$product->name}}</th></a>
                             @if(!Auth::guest())
                                 @if(!Auth::user()->id == $product->admin)
                                     <th> <a href="{{ route('watches.edit', ['product' => $product->id]) }}" class="btn btn-info">Edit</a> </th>
                                     <th>{!!Form::open(['action' => ['ProductController@destroy', $product->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                                     {{Form::hidden('_method', 'DELETE')}}
                                     {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                         {!!Form::close()!!} </th>
                                 @endif
                             @endif
                         </tr>
                         @endforeach


                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
