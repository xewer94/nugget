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
    grid-gap: 60px 30px;
}

#slajder .omotac {
    height: 10%;
    position: relative;
}
well {
  display:grid;
  min-height: 20px;
  width:20px;
  padding: 19px;
  margin-bottom: 20px;
  background-color: #f5f5f5;
  border: 1px solid #e3e3e3;
  border-radius: 4px;
  box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.05);
}

/*PRODUCTS */
/*PRODUCTS*/
.product-section {
  display: grid;
  grid-template-columns: 1fr 1fr;
  grid-gap: 120px;
  padding: 100px 0 120px;


  .selected {
      border: 1px solid #979797;
  }
}


.product-section-images {
  display: grid;
  grid-template-columns: repeat(6, 1fr);
  grid-gap: 20px;
  margin-top: 20px;
}

.product-section-thumbnail {
  display: flex;
  align-items: center;
  border: 1px solid lightgray;
  min-height: 66px;
  cursor: pointer;

  &:hover {
      border: 1px solid #979797;
  }
}

.product-section-image {
  display: flex;
  justify-content: center;
  align-items: center;
  border: 1px solid #979797;
  padding: 30px;
  text-align: center;
  height: 400px;

  img {
      opacity: 0;
      transition: opacity .10s ease-in-out;
      max-height: 100%;
  }

  img.active {
      opacity: 1;
  }
}

.product-section-information {

  p {
      align-items: right;
      margin-bottom: 16px;
  }

}

.product-section-title {
  margin-bottom: 0;
}

.product-section-subtitle {
  font-size: 20px;
  font-weight: bold;
  color: $text-color-light;
}

.product-section-price {
  font-size: 38px;
  color: $text-color;
  margin-bottom: 16px;
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

   

    }

}




    </style>
