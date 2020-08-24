<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/violenceLevel.css') }}" rel="stylesheet">

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

    <style>
        html,
        body {
            background-color: #D9D9D9;

        }

        div.nivel-violentometro {
            display: block;
            margin-right: auto;
            margin-left: auto;
            margin-top: 30px;
            width: 50px;
            height: 600px;
            border-radius: 25px;
            transition: 1s;
            background-color: darkgray;
        }

        h1.title-violence {
            color: #3A388D;
            font-weight: bolder;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col title-header">
                <h1 class="title-violence ">VIOLENTÓMETRO</h1>
                <h5 class="title-violence ">LA VIOLENCIA TAMBIEN SE MIDE</h5>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-md-10 col-lg-10">
                <div class="espiral">
                    @foreach ($violencemeters as $violencemeter)
                    <div class="items item{{$violencemeter->id}}">
                        <input onchange="onChange(this)" data-value="{{$violencemeter->level}}" type="checkbox" class="custom-control-input checks" id="customSwitch0{{$violencemeter->id}}">
                        <label class="item-violencemeter" for="customSwitch0{{$violencemeter->id}}">{{$violencemeter->name}}</label>
                        <input type="hidden" name="message" id="message" value="{{ $violencemeter->attention_route }}">
                        <input type="hidden" name="action_to_take" id="action_to_take" value="{{$violencemeter->action_to_take}}">
                    </div>

                    @endforeach
                </div>
            </div>
            <div class="col-sm-3 col-md-2 col-lg-2">
                <div class="nivel">
                    <div class="level" id="level"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="buttons">
                <a href="#" class="btn option-button btn-help" data-toggle="modal" data-target="#info-ayuda">-----------------</a>
                <a href="observatorio-master\public\attention_route.pdf" download="Ruta de Atención" class="btn option-button btn-attention-route">---------------</a>
                <a href="tel:123" class="btn option-button btn-emergency-call">---------------</a>
                <a href="https://api.whatsapp.com/send?phone=573215831916&text=Chat%20de%20prueba%20de%20whatsapp" class="btn option-button btn-talk-us">
                    ---------------
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col ">
                <div class="logo"></div>
            </div>
        </div>



        <div id="toast-message" role="alert" aria-live="assertive" aria-atomic="true" class="toast toast-message" data-autohide="false">
            <div class="toast-header header-toast">
                <strong class="mr-auto action-to-take" id="action-to-take"></strong>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body" id="toast">
            </div>
        </div>
        <div class="modal fade" id="info-ayuda" tabindex="-1" role="dialog" aria-labelledby="info-ayuda" aria-hidden="true">
            <div class="modal-dialog modal-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">¿Necesitas Ayuda?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="form" action="{{route('messages.store')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="nombre" class="col-form-label">Nombre:</label>
                                <input type="text" class="form-control" id="nombre" name="name">
                            </div>
                            <div class="form-group">
                                <label for="telefono" class="col-form-label">Telefono:</label>
                                <input type="text" class="form-control" id="telefono" name="phone">
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-form-label">email:</label>
                                <input type="text" class="form-control" id="email" name="email">
                            </div>
                            <div class="form-group">
                                <label for="mensaje" class="col-form-label">Mensaje:</label>
                                <textarea class="form-control" id="mensaje" name="message"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="submit" form="form" class="btn btn-success">Enviar</button>
                    </div>
                </div>
            </div>
        </div>




    </div>
    <script src="{{ asset('js/violenceLevel.js') }}"></script>
</body>

</html>