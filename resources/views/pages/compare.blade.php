@extends('layouts.app')

@section('content')
    <a href="{{ url('/watches') }}" class="btn btn-default">Back to Watches</a>

    <div class="product1-section container">

        <div class="product1-section-image">

            <img style="width:200px" src="{{ asset('storage/image/' . $product1->image) }}">
        </div>

        <div class="col-12 col-md-6">
            <div class="product1-section-information">
                <h1 class="product-section-title">{!!$product1->name!!}</h1>
                <h1 class="product-section-price"> $ {!!$product1->price!!}</h1>
                <div class="product-section-subtitle">{!!$product1->details!!} </div>
                <h1>{!!$product1->description!!}</h1>
            </div>
        </div>
    </div>

    <div class="product2-section container">

        <div class="product2-section-image">

            <img style="width:200px" src="{{ asset('storage/image/' . $product2->image) }}">
        </div>

        <div class="col-12 col-md-6">
            <div class="product2-section-information">
                <h1 class="product-section-title">{!!$product2->name!!}</h1>
                <h1 class="product-section-price"> $ {!!$product2->price!!}</h1>
                <div class="product-section-subtitle">{!!$product2->details!!} </div>
                <h1>{!!$product2->description!!}</h1>
            </div>
        </div>
    </div>

@endsection


@section ('appendCss')
    <style>

.col-md-6 {
width: 600px;
margin-top: 200px;
}
.product1-section-information {
    align-items: center;
    text-align: center;
    margin-top: -500px;
    margin-left: 80px;
}

.product2-section-information {
    align-items: center;
    text-align: center;
    margin-top: -500px;
    margin-left: -80px;
}


.product1-section-image {
    display: left;
    justify-content: center;
    align-items: center;
    padding: 30px;
    text-align: left;
    height: 300px;
    width: 200px;
    margin-top: 100px;
}
.product2-section-image {
    display: right;
    justify-content: center;
    align-items: center;
    padding: 30px;
    text-align: right;
    height: 300px;
    margin-top: -300px;

}


element.style {
    width: 200px;
}

</style>