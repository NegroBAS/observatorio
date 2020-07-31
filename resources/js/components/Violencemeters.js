import React, { useEffect, useState } from 'react';
import ReactDOM from 'react-dom';
import Swal from 'sweetalert';
import { ToastProvider, useToasts } from 'react-toast-notifications'

function Violencemeter() {
    const { addToast } = useToasts();
    const [edit, setEdit] = useState(false);
    const [id, setId] = useState(null);
    const [violencemeters, serViolencemeters] = useState(null);
    const getData = async () => {
        try {
            let res = await fetch('/violencemeters', {
                headers: {
                    'Accept': 'application/json'
                }
            });
            let data = await res.json();
            serViolencemeters(data.violencemeters);
        } catch (error) {
            console.log(error);
        }
    }
    useEffect(() => {
        getData();
    }, []);
    const getViolencemeter = async (e) => {
        try {
            setEdit(true);
            let id = $(e.target).data('id');
            console.log(id);
            let res = await fetch('/violencemeters/' + id);
            let data = await res.json();
            $('.modal').find('.modal-title').text('Editar item');
            $('.modal').find('#name').val(data.name);
            $('.modal').find('#risk_level').val(data.risk_level);
            $('.modal').find('#level').val(data.level);
            $('.modal').find('#action_to_take').val(data.action_to_take);
            $('.modal').find('#attention_route').val(data.attention_route);
            $('.modal').modal('toggle');
            setId(id);
        } catch (error) {
            console.log(error);
        }
    }
    const deleteViolencemeter = async function (e) {
        try {
            let id = $(e.target).data('id');
            setId(id);
            swal({
                title: "¿Estás seguro?",
                text: "¡No podras revertir esto!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    let fd = new FormData();
                    fd.append('_method', 'DELETE');
                    fd.append('_token', document.getElementById('token').content);
                    let res = fetch('/violencemeters/' + id, {
                        method: 'POST',
                        body: fd
                    }).then(data => {
                        data.json().then(resp => {
                            if (resp.status === 200) {
                                getData();
                                swal(`${resp.message}!`, {
                                    icon: "success",
                                });
                            } else {
                                console.log(resp);
                            }
                        });
                    })
                }
            });
        } catch (error) {
            console.log(error);
        }
    }
    document.getElementById('btnCreate').onclick = function () {
        $('.modal #form').trigger('reset');
        $('.modal').find('.modal-title').text('Crear');
        $('.modal').modal('toggle');
    }
    document.getElementById('form').onsubmit = async function (e) {
        e.preventDefault();
        if (edit) {
            let fd = new FormData(this);
            fd.append('_method', 'PUT');
            let res = await fetch('/violencemeters/' + id, {
                method: 'POST',
                body: fd
            });
            let data = await res.json();
            if (data.status === 200) {
                $('.modal').modal('toggle');
                addToast(data.message, { appearance: 'success' });
            }
        } else {
            let res = await fetch('/violencemeters', {
                method: 'POST',
                body: new FormData(this)
            });
            let data = await res.json();
            if (data.status === 201) {
                $('.modal').modal('toggle');
                addToast(data.message, { appearance: 'success' });
            }
        }
        getData();
    }
    if (violencemeters === null) {
        return (
            <div className="row mt-3">
                <div className="col-6 mx-auto text-center">
                    <h4>Cargando los datos</h4>
                    <div className="spinner-border text-primary" role="status">
                        <span className="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
        );
    }
    if (violencemeters.length > 0) {
        return (
            <div className="row mt-3">
                <div className="col">
                    <table className="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Nivel de riesgo</th>
                                <th>Nivel</th>
                                <th>Acción a tomar</th>
                                <th>Ruta de atencion</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            {violencemeters.map(violencemeter => (
                                <tr key={violencemeter.id}>
                                    <td>{violencemeter.name}</td>
                                    <td>{violencemeter.risk_level}</td>
                                    <td>{violencemeter.level}</td>
                                    <td>{violencemeter.action_to_take}</td>
                                    <td>{violencemeter.attention_route}</td>
                                    <td>
                                        <div className="btn-group" role="group" aria-label="Basic example">
                                            <button type="button" data-id={violencemeter.id} onClick={getViolencemeter} className="btn btn-outline-primary">Editar</button>
                                            <button type="button" data-id={violencemeter.id} onClick={deleteViolencemeter} className="btn btn-outline-danger">Eliminar</button>
                                        </div>
                                    </td>
                                </tr>
                            ))}
                        </tbody>
                    </table>
                </div>
            </div>
        );
    }
    return (
        <div className="row mt-3">
            <div className="col">
                <h5 className="text-muted">No hay datos para mostrar</h5>
            </div>
        </div>
    );
}
export default Violencemeter;

if (document.getElementById('violencemeters')) {
    ReactDOM.render(<ToastProvider><Violencemeter /></ToastProvider>, document.getElementById('violencemeters'));
}
