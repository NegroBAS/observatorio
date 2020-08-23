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
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;

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

        .container {
            background: rgba(255, 255, 255, 0.712);
        }
    </style>
</head>

<body>

    <div class="container my-5">

        <div class="row">
            <div class="col titles">
                <h1>Violentometro</h1>
                <h4>La violencia tambien se mide</h4>
            </div>
            <div class="col">
                <div class="options">
                    <button type="button" class="btn btn-info btn-help btn-sm" data-toggle="modal" data-target="#info-ayuda">¿Necesitas
                        Ayuda?</button>
                    <a href="observatorio-master\public\attention_route.pdf" class="btn btn-sm btn-success btn-ruta" download="Ruta de Atención">Descargar ruta de atención</a>
                    <a class="btn btn-sm btn-llamar btn-warning my-1" href="tel:123">Llama ya a la linea: 123</a>
                    <a class="btn btn-sm btn-success btn-chat" href="https://api.whatsapp.com/send?phone=573215831916&text=Chat%20de%20prueba%20de%20whatsapp">Habla
                        con Nosotros</a>
                </div>
            </div>
        </div>
        <div class="row alert-name">
            <div class="col-2 vacio"></div>
            <div class="alert yellow col-3 p-2"> Alerta</div>
            <div class="alert orange col-3 p-2">Amigx Date Cuenta</div>
            <div class="alert red col-3 p-2">No estas solx</div>
        </div>
        <button onclick="resetItems()" class="btn btn-sm btn-info">Resetear</button>

        <div class="row mt-5">
            <div class="col-2">
                <div class="col-2 violentometro" id="violentometro">
                    <div class="nivel-violentometro  violentometro-cont" id="nivel-violentometro">
                        <div class="level" id="level"></div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="row items-violencemeter">
                    @foreach ($violencemeters as $violencemeter)
                    <div class="col-sm-12 col-md-4 my-2 item">
                        <h5>
                            <div class="custom-control custom-switch">
                                <input onchange="onChange(this)" data-value="{{$violencemeter->level}}" type="checkbox" class="custom-control-input checks" id="customSwitch0{{$violencemeter->id}}">
                                <label class="custom-control-label" for="customSwitch0{{$violencemeter->id}}">{{$violencemeter->name}}</label>

                                <input type="hidden" name="message" id="message" value="{{ $violencemeter->attention_route }}">
                                <input type="hidden" name="action_to_take" id="action_to_take" value="{{$violencemeter->action_to_take}}">
                            </div>
                        </h5>
                    </div>
                    @endforeach
                </div>
            </div>
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


    <script src="{{ asset('js/violenceLevel.js') }}"></script>
</body>

</html>