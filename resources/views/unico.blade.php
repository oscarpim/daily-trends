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
    <link rel="stylesheet" href="../css/bootstrap.min.css">
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
            margin-top: 0px;
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
    <div class="flex-top position-ref full-height"> 
        <div class="content">
            <div class="title m-b-md"> NOTICIAS DIARIAS </div>
            <div class="links"> <a href="../">PORTADA</a> <a href="../feeds">FEEDS</a> <a href="../new-feed">NUEVO FEED</a> </div>
            <hr>

            <div class="container">
                <div class="row"> @foreach($feed as $data)
                    <div class="col-md-12" style="color:#111;">
                        <div class="col-md-12">
                            <h2>{{$data->title}}</h2></div>
                        <div class="col-md-12"> <img src="{{$data->image}}" alt=""> {{$data->body}}
                            <br> <span class="fuerte">{{$data->source}}</span> - <span class="fuerte">{{$data->publisher}}</span> </div>
                    </div> @endforeach </div>
            </div>
            <div style="font-weight:bold;">Oscar Pitarch Millet - Daily Trends App</div>
        </div>
    </div>
</body>

</html>