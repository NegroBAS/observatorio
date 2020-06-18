@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col">
                <h3>Violentometro</h3>
            </div>
            <div class="col-2 text-right">
                <button class="btn btn-success" id="btnCreate">Agregar</button>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div id="violencemeters"></div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title"></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form id="form" method="POST">
                  @csrf
                  <div class="form-group">
                      <label for="name">Nombre</label>
                      <input type="text" name="name" id="name" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="risk_level">Nivel de riesgo</label>
                    <select name="risk_level" id="risk_level" class="form-control">
                        <option value="alert">Alerta</option>
                        <option value="reaction">Reacciona</option>
                        <option value="urgent">Urgente</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="attention_route">Ruta de atencion</label>
                    <textarea name="attention_route" id="attention_route" class="form-control"></textarea>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-primary" form="form">Guardar</button>
            </div>
          </div>
        </div>
    </div>
@endsection