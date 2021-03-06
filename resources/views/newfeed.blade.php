<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Daily Trends Prueba</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
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
                color: #636b6f;
                padding: 0 25px;
                font-size: 14px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-top position-ref full-height">
        

            <div class="content">
                <div class="title m-b-md">
                    NOTICIAS DIARIAS  
                </div>

                <div class="links">
                    <a href="../public">PORTADA</a>
                    <a href="feeds">FEEDS</a>
                    <a href="new-feed">NUEVO FEED</a>
                </div>
                <hr><br>
                <div class="row">
                 <h1>CREAR UN FEED</h1>
                  <form action="create" method="post">
                   {{ csrf_field() }}
                    <input type="text" name="title" placeholder="Titulo"><br><br>
                    <textarea name="body" placeholder="Cuerpo" cols="50" rows="20"></textarea><br><br>
                    <input type="text" name="image" placeholder="URL Imagen"><br><br>
                    <input type="text" name="source" placeholder="Fuente"><br><br>
                    <input type="text" name="publisher" placeholder="Editor"><br><br>
                    <input type="submit" value="INSERTAR">

                </form>

                </div>

            </div>
        </div>
    </body>
</html>