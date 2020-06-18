<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
                background: url(https://image.freepik.com/vector-gratis/ilustracion-concepto-violencia-genero_114360-1972.jpg) no-repeat center;
            }
            .container{
                background: rgba(255, 255, 255, 0.712);
            }
        </style>
    </head>
    <body>
        <div class="container my-5">
            <div class="row">
                <div class="col">
                    <h1>Violentometro</h1>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-2 border">
                    <p>Medidor</p>
                </div>
                <div class="col">
                    <div class="row">
                        @foreach ($violencemeters as $violencemeter)    
                            <div class="col-4 my-2">
                                <h5>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="customSwitch{{$violencemeter->id}}">
                                        <label class="custom-control-label" for="customSwitch{{$violencemeter->id}}">{{$violencemeter->name}}</label>
                                    </div>
                                </h5>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
