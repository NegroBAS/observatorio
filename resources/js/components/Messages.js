import React, { useEffect, useState } from 'react';
import ReactDOM from 'react-dom';
import moment from 'moment';
moment.locale('es');

function Messages() {
    const [messages, setMessages] = useState(null);
    const getMessages = async () => {
        try {
            let res = await fetch('/messages', {
                headers: {
                    'accept': 'application/json'
                }
            });
            let data = await res.json();
            setMessages(data);
        } catch (error) {
            console.log(error);
        }
    }
    const detail = async (e) => {
        try {
            let id = $(e.target).data('id');
            let res = await fetch(`/messages/${id}`);
            let data = await res.json();
            $('.modal').find('#name').text(data.name);
            $('.modal').find('#email').text(data.email);
            $('.modal').find('#phone').text(data.phone);
            $('.modal').find('#message').text(data.message);
            $('.modal').modal('toggle');
        } catch (error) {
            console.log(error);
        }
    }
    const destroy = async (e) => {
        try {
            let id = $(e.target).data('id');
            let fd = new FormData();
            fd.append('_method', 'DELETE');
            fd.append('_token', document.getElementById('token').content);
            let res = await fetch(`/messages/${id}`, {
                method:'POST',
                body:fd
            });
            let data = await res.json();
            if(data.success){
                await getMessages();
            }
        } catch (error) {
            console.log(error);
        }
    }
    useEffect(() => {
        getMessages();
    }, [])
    if (!messages) {
        return (
            <div className="row mt-3">
                <div className="col-6 mx-auto text-center">
                    <p>Cargando los datos</p>
                    <div className="spinner-border text-primary" role="status">
                        <span className="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
        );
    }
    return (
        <>
            <div className="card">
                <div className="card-header">Bandeja de entrada</div>
                <div className="card-body">
                    <button type="button" className="btn btn-outline-primary mb-2" onClick={getMessages}>Actualizar</button>
                    <table className="table">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Mensaje</th>
                                <th>Fecha</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            {messages.length > 0 ? (
                                messages.map(message => (
                                    <tr key={message.id}>
                                        <td>{message.name}</td>
                                        <td>{message.message}</td>
                                        <td>{moment(message.created_at).calendar()}</td>
                                        <td>
                                            <div className="btn-group" role="group" aria-label="Basic example">
                                                <button type="button" className="btn btn-outline-primary" data-id={message.id} onClick={detail}>Ver</button>
                                                <button type="button" className="btn btn-outline-danger" data-id={message.id} onClick={destroy}>Eliminar</button>
                                            </div>
                                        </td>
                                    </tr>
                                ))
                            ) : (
                                    <tr>
                                        <td colSpan="4" className="text-center text-muted">No hay datos disponibles</td>
                                    </tr>
                                )}
                        </tbody>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
            <div className="modal" tabIndex="-1" role="dialog">
                <div className="modal-dialog">
                    <div className="modal-content">
                        <div className="modal-header">
                            <h5 className="modal-title">Detalle</h5>
                            <button type="button" className="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div className="modal-body">
                            <div className="row mb-2">
                                <div className="col">
                                    <h5>Nombre</h5>
                                    <h6 id="name"  className="text-muted"></h6>
                                </div>
                            </div>
                            <div className="row mb-2">
                                <div className="col">
                                    <h5>Email</h5>
                                    <h6 id="email" className="text-muted"></h6>
                                </div>
                            </div>
                            <div className="row mb-2">
                                <div className="col">
                                    <h5>Telefono</h5>
                                    <h6 id="phone" className="text-muted"></h6>
                                </div>
                            </div>
                            <div className="row mb-2">
                                <div className="col">
                                    <h5>Mensaje</h5>
                                    <h6 id="message" className="text-muted"></h6>
                                </div>
                            </div>
                        </div>
                        <div className="modal-footer">
                            <button type="button" className="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </>
    )
}

export default Messages;

if (document.getElementById('messages')) {
    ReactDOM.render(<Messages />, document.getElementById('messages'));
}