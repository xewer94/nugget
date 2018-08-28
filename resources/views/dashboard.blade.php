@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

              
               
                <div class="panel-body">
                    @if(Auth::user()->user_id ==1)
                    <a href="/nugget/public/watches/create" class="btn btn-primary">Add Watch</a>
                    @else <script>window.location = "/nugget/public";</script>
                    @endif  
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
