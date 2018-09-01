<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app">
        @include('inc.navbar')
        <div class="container">
            @include('inc.messages')
            @yield('content')
        </div>
    </div>

    

</body>
</html>

@section ('appendCss')
<style>
    .navbar-inverse {
  background-color: white;
  border-color: white;
}
.products {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    grid-gap: 60px 1px;
    margin-top: -45px;

}

#slajder .omotac {
    height: 10%;
    position: relative;
}

    .product-section-image {
        display: left;
        justify-content: center;
        align-items: center;
        border: 1px solid #979797;
        padding: 30px;
        text-align: left;
        height: 300px;
        width: 300px;
        margin-top: -120px;
    }

    .product-section-information {
        align-items: right;
        text-align: right;
        margin-top: -448px;
    }

 /*MENI*/

#meni ul li {
    font-size: 25px;
    display: inline-grid;
	padding: 15px 30px;
	color: rgb(162,120,106);
	border-radius: 5px;
	margin-top: 36px;
	text-transform: uppercase;
	font-size: 20px;


/*SEARCH*/
    }
    .well {
        display: grid;
        min-height: 80px;
        padding: 10px;
        margin-top: -120px;
        margin-left: 120px;
        margin-bottom: 120px;
        background-color: #f5f5f5;
        border: 1px solid #e3e3e3;
        border-radius: 24px;
        box-shadow:
    }

    input, button, select, textarea {
        margin-left: -60px;
        font-family: inherit;
        font-size: inherit;
        line-height: 20px;
        border-radius: 24px;
        border: 1px solid #e3e3e3;
        background-color: #f5f5f5;
    }
    .btn-primary {
        color: #fff;
        background-color: darkgray;
        border-color: darkgray;
        margin-top: -44px;
        margin-left: 100px;
    }

    .nothing {

        margin-left: 420px;
        margin-top: -100px;
        width: 300px;
    }

    /*COMMENT MODIFICATIONS*/
    textarea.form-control {
        height: auto;
        margin-left: 0px;
    }
    .btn-primary {
        color: #fff;
        background-color: darkgray;
        border-color: darkgray;
        margin-top: -2px;
        margin-left: 0px;
    }
    /*COMPARE BUTTON*/
    .modal_pro_compare {
        margin-left: 10px;
    }
    .form-horizontal .control-label {
        text-align: center;
        margin-bottom: 0;
        padding-top: 7px;
    }

    .form-control {
        display: block;
        width: 100%;
        margin-left: 0px;
    }
    input[type="file"] {
        display: block;
        margin-left: 0px;
    }
    </style>
