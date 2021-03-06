<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daily Trends Prueba</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <!-- Bootstrap para estilos -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Styles -->
    <style>
        html,
        body {
            background-color: #fff;
            color: #111;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }
        
        .full-height {
            height: 100vh;
        }
        
        .flex-top {
            align-items: top;
            display: flex;
            justify-content: center;
            margin-top: 30px;
        }
        
        .position-ref {
            position: relative;
        }
        
        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }
        
        .content {
            text-align: center;
        }
        
        .title {
            font-size: 84px;
        }
        
        .links > a {
            color: #111;
            padding: 0 25px;
            font-size: 14px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }
        
        h2 {
            font-weight: bold;
            padding-top: 20px;
        }
        
        .container {
            font-weight: 600;
            text-align: justify;
        }
        
        .m-b-md {
            margin-bottom: 30px;
        }
        
        img {
            width: 100%;
            float: left;
        }
        
        span.fuerte {
            color: brown;
            font-weight: 900 !important;
        }
    </style>
</head>

<body>
    <div class="flex-top position-ref full-height"> @if (Route::has('login'))
        <div class="top-right links"> @if (Auth::check()) <a href="{{ url('/home') }}">Home</a> @else <a href="{{ url('/login') }}">Login</a> <a href="{{ url('/register') }}">Register</a> @endif </div> @endif
        <div class="content">
            <div class="title m-b-md"> NOTICIAS DIARIAS </div>
            <div class="links"> <a href="../public">PORTADA</a> <a href="feeds">FEEDS</a> <a href="new-feed">NUEVO FEED</a> </div>
            <hr>
            <br>
            <div class="container">
                <div class="row"> @foreach($ultimasNoticias as $n => $data)
                    <div class="col-md-6" style="color:#111;">
                        <div class="col-md-12">
                            <a href="unico/{{$data->id}}"><h2>{{$data->title}}</h2></a> </div>
                        <div class="col-md-12"> <img src="{{$data->image}}" alt=""> {{$data->body}}
                            <br> <span class="fuerte">{{$data->source}}</span> - <span class="fuerte">{{$data->publisher}}</span> </div>
                    </div> @endforeach </div>
            </div>
            <hr>
            <footer style="font-weight:bold;">Oscar Pitarch Millet - Daily Trends App</footer>
        </div>
    </div>
</body>

</html>