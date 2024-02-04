@extends('layouts.app')
@section('title', 'Gestionar Reserva')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card
                    {{($reserva->estado === 'Procesando' || $reserva->estado === 'procesando')? 'text-bg-info bg-opacity-25': ''}}
                    {{($reserva->estado === 'Rechazado' || $reserva->estado === 'rechazado')? 'bg-danger bg-opacity-25': ''}}
                    {{($reserva->estado === 'Aprobado' || $reserva->estado === 'aprobado')? 'bg-success bg-opacity-25': ''}}
                    {{($reserva->estado === 'Cancelado' || $reserva->estado === 'cancelado')? 'bg-warning bg-opacity-25': ''}}
                    {{($reserva->estado === 'Entregado' || $reserva->estado === 'entregado')? 'bg-primary bg-opacity-25': ''}}

                ">
                    <div class="card-header fw-bold" style="display: flex; justify-content: space-between; width: 100%;">
                        <p> Detalles de la reserva</p>
                        <p> 
                            Estado: {{$reserva->estado}}
                        </p>
                        
                    </div>
                    <div class="card-body">
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <p class="fw-bold">Identificador: </p>
                            </li>
                            <li class="list-inline-item">{{$reserva->idReservas}}</li>
                        </ul>
                        <ul class="list-inline">
                            <li class="list-inline-item"><p class="fw-bold">Docente: </p></li>
                            <li class="list-inline-item">{{$reserva->docente}}</li>
                        </ul>
                        <ul class="list-inline">
                            <li class="list-inline-item"><p class="fw-bold">Laboratorio: </p></li>
                            <li class="list-inline-item">{{$reserva->laboratorio}}</li>
                        </ul>
                        <ul class="list-inline">
                            <li class="list-inline-item"><p class="fw-bold">Módulo: </p></li>
                            <li class="list-inline-item">{{$reserva->modulo}}</li>
                        </ul>
                        @if ($reserva->fechaInicio === $reserva->fechaFinal)
                            <ul class="list-inline">
                                <li class="list-inline-item"><p class="fw-bold">Fecha: </p></li>
                                <li class="list-inline-item">{{\Carbon\Carbon::parse($reserva->fechaInicio)->format('d/m/Y')}}</li>
                                <li class="list-inline-item"><p class="fw-bold">Hora:</p></li>
                                <li class="list-inline-item">{{\Carbon\Carbon::parse($reserva->horaInicio)->format('H:i')}} - {{\Carbon\Carbon::parse($reserva->horaFinal)->format('H:i')}}</li>
                            </ul>
                        @else
                            <ul class="list-inline">
                                <li class="list-inline-item"><p class="fw-bold">Rango de fechas:</p></li>
                                <li class="list-inline-item">{{\Carbon\Carbon::parse($reserva->fechaInicio)->format('d/m/Y')}} - {{\Carbon\Carbon::parse($reserva->fechaFinal)->format('d/m/Y')}}</li>
                                <li class="list-inline-item"><p class="fw-bold">Hora:</p></li>
                                <li class="list-inline-item">{{\Carbon\Carbon::parse($reserva->horaInicio)->format('H:i')}} - {{\Carbon\Carbon::parse($reserva->horaFinal)->format('H:i')}}</li>
                            </ul>
                            <ul class="list-inline">
                                <li class="list-inline-item"><p class="fw-bold">Días seleccionados:</p></li>
                                <li class="list-inline-item text-capitalize">{{$reserva->dias}}</li>
                            </ul>
                        @endif
                        <form action="/reservas/aprobar" method="POST" id="formReserva">
                            @csrf
                            <input type="hidden" name="idReserva" value="{{$reserva->idReservas}}">
                                @if ($reserva->materiales !== "Vacio")
                                <p class="fw-bold">Materiales extras:</p>
                                <div class="table-responsive">
                                    <table class="table table-dark table-hover table-bordered align-middle">
                                        <thead>
                                            <tr class="text-center">
                                                <th>Imagen</th>
                                                <th>Nombre</th>
                                                <th>Cantidad</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($reserva->materiales as $item)
                                            <tr class="text-center">
                                                <td>
                                                    <img src="{{ asset('storage/materialesGastables/' . $item->imagen) }}"
                                                    height="100px">
                                                </td>
                                                <td> {{$item->nombre}}</td>
                                                <td>
                                                    <input type="hidden" name="materialReservaId[]" value="{{$item->id}}">
                                                    <input type="number" name="materialCantidad[]" value="{{$item->cantidad}}"
                                                    {{($reserva->estado === 'Cancelado' || $reserva->estado === 'cancelado' || $reserva->estado === 'Aprobado' || $reserva->estado === 'aprobado' || $reserva->estado === 'Rechazado' || $reserva->estado === 'rechazado' || $reserva->estado === 'Entregado' )? 'disabled': ''}}
                                                    >
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <input type="hidden" name="materialReservaId[]">
                                <input type="hidden" name="materialCantidad[]" >
                            @endif
                            @if ($reserva->herramientas !== "Vacio")
                                <p class="fw-bold">Herramientas extras:</p>
                                <div class="table-responsive">
                                    <table class="table table-dark table-hover table-bordered align-middle">
                                        <thead>
                                            <tr class="text-center">
                                                <th>Imagen</th>
                                                <th>Nombre</th>
                                                <th>Cantidad</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($reserva->herramientas as $item)
                                            <tr class="text-center">
                                                <td>
                                                    <img src="{{ asset('storage/herramientas/' . $item->imagen) }}"
                                                    height="100px" alt="imagen del laboratorio">
                                                </td>
                                                <td> {{$item->nombre}}</td>
                                                <td>
                                                    <input type="hidden" name="herramientaReservaId[]" value="{{$item->id}}">
                                                    <input type="number" name="herramientaCantidad[]" value="{{$item->cantidad}}"
                                                    {{($reserva->estado === 'Cancelado' || $reserva->estado === 'cancelado' || $reserva->estado === 'Aprobado' || $reserva->estado === 'aprobado' || $reserva->estado === 'Rechazado' || $reserva->estado === 'rechazado' || $reserva->estado === 'Entregado')? 'disabled': ''}}
                                                    >
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                            <input type="hidden" name="herramientaReservaId[]">
                            <input type="hidden" name="herramientaCantidad[]">
                            @endif
                            @if ($reserva->equipos !== "Vacio")
                            <p class="fw-bold">Equipos extras:</p>
                            <div class="table-responsive">
                                <table class="table table-dark table-hover table-bordered align-middle">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Imagen</th>
                                            <th>Nombre</th>
                                            <th>OS</th>
                                            <th>Cantidad</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($reserva->equipos as $item)
                                        <tr class="text-center">
                                            <td>
                                                <img src="{{ asset('storage/equipos/' . $item->imagen) }}"
                                                height="100px" alt="imagen del laboratorio">
                                            </td>
                                            <td> {{$item->nombre}}</td>
                                            <td>{{$item->sisOperativo}}</td>
                                            <td>
                                                <input type="hidden" name="equipoReservaId[]" value="{{$item->id}}">
                                                <input type="number" name="equipoCantidad[]" value="{{$item->cantidad}}"
                                                {{($reserva->estado === 'Cancelado' || $reserva->estado === 'cancelado' || $reserva->estado === 'Aprobado' || $reserva->estado === 'aprobado' || $reserva->estado === 'Rechazado' || $reserva->estado === 'rechazado' || $reserva->estado === 'Entregado')? 'disabled': ''}}
                                                >
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @else
                                <input type="hidden" name="equipoReservaId[]">
                                <input type="hidden" name="equipoCantidad[]">
                            @endif

                            @if ($reserva->estado === 'Cancelado' || $reserva->estado === 'cancelado' || $reserva->estado === 'Aprobado' || $reserva->estado === 'aprobado' || $reserva->estado === 'Rechazado' || $reserva->estado === 'rechazado' || $reserva->estado === 'Entregado')
                                @if ($reserva->comentario !== "Vacio")
                                    <div class="card">
                                        <div class="card-header">
                                            Comentario
                                        </div>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">{{$reserva->comentario}}</li>
                                        </ul>
                                    </div>
                                @endif
                                @if ($reserva->comentarioEntregado !== "Vacio")
                                <div class="card mt-2">
                                    <div class="card-header">
                                        Comentario al momento de entregar laboratorio
                                    </div>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">{{$reserva->comentarioEntregado}}</li>
                                    </ul>
                                </div>
                                @endif
                            @else
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="parametro">
                                    <label class="form-check-label fw-bold">Agregar comentario</label>
                                </div>

                                <div class="d-none mt-2" id="Comentario">
                                        <div class="row justify-content-center text-center">
                                            <div class="col-md-12">
                                                <textarea class="form-control" name="comentario" id="" rows="2"></textarea>
                                            </div>
                                        </div>
                                </div>
                            @endif

                            <div class="row justify-content-center text-center mt-4">
                                @if ($reserva->estado === 'Entregado')
                                    <div class="col d-md-block w-100">
                                        <button disabled class="btn btn-primary w-100" >
                                            <i class="fa-solid fa-check"></i> Laboratorio entregado
                                        </button>
                                    </div>
                                @else
                                    @if ($reserva->estado === 'Aprobado' || $reserva->estado === 'aprobado')
                                        <div class="col d-md-block w-100">
                                            <a type="submit" class="btn btn-primary w-100" href="/reservas/entregar/{{$reserva->idReservas}}">
                                                <i class="fa-solid fa-check"></i> Entregar Laboratorio
                                            </a>
                                        </div>
                                    @else
                                        <div class="col d-md-block">
                                            <button type="submit" class="btn btn-success" 
                                            {{($reserva->estado === 'Cancelado' || $reserva->estado === 'cancelado' || $reserva->estado === 'Aprobado' || $reserva->estado === 'aprobado' || $reserva->estado === 'Rechazado' || $reserva->estado === 'rechazado') ? 'disabled' : ''}}
                                            >
                                                <i class="fa-solid fa-check"></i> Aprobar
                                            </button>
                                        </div>
                                        <div class="col d-md-block">
                                            <button type="button" url="/reservas/rechazar" onclick="rechazar(this)" class="btn btn-danger" 
                                            {{($reserva->estado === 'Cancelado' || $reserva->estado === 'cancelado' || $reserva->estado === 'Aprobado' || $reserva->estado === 'aprobado' || $reserva->estado === 'Rechazado' || $reserva->estado === 'rechazado') ? 'disabled' : ''}}
                                            >
                                                <i class="fa-solid fa-xmark"></i> Rechazar
                                            </button>
                                        </div>
                                        <div class="col d-md-block">
                                            <button type="button" url="/reservas/cancelar" onclick="cancelar(this)" class="btn btn-warning" 
                                            {{($reserva->estado === 'Cancelado' || $reserva->estado === 'cancelado' || $reserva->estado === 'Aprobado' || $reserva->estado === 'aprobado' || $reserva->estado === 'Rechazado' || $reserva->estado === 'rechazado') ? 'disabled' : ''}}
                                            >
                                                <i class="fa-solid fa-ban"></i> Cancelar
                                            </button>
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            $('#parametro').change(function() {
                if ($(this).is(":checked")) {
                    $("#Comentario").removeClass("d-none");
                } else {
                    $("#Comentario").addClass("d-none");
                }
            });
    
            window.rechazar = function(e) {
                let url = e.getAttribute('url');
                Swal.fire({
                    icon: 'question',
                    title: '¿Desea continuar?',
                    text: 'Una vez rechazada no podrá ser aprobada',
                    showCancelButton: true,
                    cancelButtonText: 'Cancelar',
                    confirmButtonText: 'Aceptar'
                }).then((res) => {
                    if (res.isConfirmed) {
                        $.ajax({
                            url: url,
                            method: 'POST',
                            data: {
                                idReserva:$('input[name="idReserva"]').val(),
                                comentario:$('textarea[name="comentario"]').val(),
                                _token:$('input[name="_token"]').val(),
                            },
                            success: function(response) {
                                if (response.code === 200) {
                                    Swal.fire({
                                        icon: 'success',
                                        text: 'Reserva rechazada'
                                    }).then(response => {
                                        window.location.href = '/reservas/gestionar/{{$reserva->idReservas}}';
                                    })
                                }
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                console.error("Error en la solicitud AJAX:", textStatus, errorThrown);
                                console.log(jqXHR.responseText);
                            }
                        })
                        
                    }
                });
            };

            window.cancelar = function(e){
                let url = e.getAttribute('url');
                Swal.fire({
                    icon: 'question',
                    title: '¿Desea continuar?',
                    text: 'Una vez cancelada no podrá ser aprobada',
                    showCancelButton: true,
                    cancelButtonText: 'Cancelar',
                    confirmButtonText: 'Aceptar'
                }).then((res)=>{
                    if (res.isConfirmed) {
                        $.ajax({
                            url: url,
                            method: 'POST',
                            data: {
                                idReserva:$('input[name="idReserva"]').val(),
                                comentario:$('textarea[name="comentario"]').val(),
                                _token:$('input[name="_token"]').val(),
                            },
                            success: function(response) {
                                if (response.code === 200) {
                                    Swal.fire({
                                        icon: 'success',
                                        text: 'Reserva cancelada'
                                    }).then(response => {
                                        window.location.href = '/reservas/gestionar/{{$reserva->idReservas}}';
                                    })
                                }
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                console.error("Error en la solicitud AJAX:", textStatus, errorThrown);
                                console.log(jqXHR.responseText);
                            }
                        })
                        
                    }
                })
            };
        });
    </script>
    

@endsection
