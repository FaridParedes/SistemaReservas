@extends('layouts.app')
@section('title', 'Entregar Laboratorio')
@section('content')
    <div class="container">
        <p class="fw-medium h2 text-center">Reservas</p>
        <p class="h6 text-center">Entregar Laboratorio</p>
        <hr>
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if (session('mensajeError'))
                    <div class="alert alert-danger alert-dismissible fade show"  role="alert">
                        <strong>{{ session('mensajeError') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div> 
                @endif
                @if (session('mensajeSuccess'))
                    <div class="alert alert-success alert-dismissible fade show"  role="alert">
                        <strong>{{ session('mensajeSuccess') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div> 
                @endif
                <div class="card shadow-lg mb-3 ">
                    <div class="card-header fw-bold" style="display: flex; justify-content: space-between; width: 100%;">
                        <div>
                            Entrega de Laboratorio
                        </div>
                        <div>
                            Identificador de reserva: {{$reserva->idReservas}}
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <p class="fw-bold">Docente: </p>
                            </li>
                            <li class="list-inline-item">{{$reserva->docente}}</li>
                        </ul>
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <p class="fw-bold">Laboratorio: </p>
                            </li>
                            <li class="list-inline-item">{{$reserva->laboratorio}}</li>
                        </ul>
                        <form action="/reservas/aprobar-entrega" method="POST">
                            @csrf
                            <input type="hidden" name="idReserva" value="{{$reserva->idReservas}}">
                            @if ($reserva->herramientas !== "Vacio")
                                <p class="fw-bold">Herramientas extras brindadas:</p>
                                <div class="table-responsive">
                                    <table class="table table-dark table-hover table-bordered align-middle">
                                        <thead>
                                            <tr class="text-center">
                                                <th>Imagen</th>
                                                <th>Nombre</th>
                                                <th>Cantidad</th>
                                                <th>Entregado</th>
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
                                                    <input type="number" value="{{$item->cantidad}}"
                                                    {{($reserva->estado === 'Cancelado' || $reserva->estado === 'cancelado' || $reserva->estado === 'Aprobado' || $reserva->estado === 'aprobado' || $reserva->estado === 'Rechazado' || $reserva->estado === 'rechazado')? 'disabled': ''}}
                                                    >
                                                </td>
                                                <td>
                                                    <input type="hidden" name="herramientaEntregadaId[]" value="{{$item->id}}">
                                                    <input type="number" name="herramientaEntregadaCantidad[]" required>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                            <input type="hidden" name="herramientaEntregadaId[]">
                            <input type="hidden" name="herramientaEntregadaCantidad[]">
                            @endif
                            @if ($reserva->equipos !== "Vacio")
                            <p class="fw-bold">Equipos extras brindados:</p>
                            <div class="table-responsive">
                                <table class="table table-dark table-hover table-bordered align-middle">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Imagen</th>
                                            <th>Nombre</th>
                                            <th>OS</th>
                                            <th>Cantidad</th>
                                            <th>Entregado</th>
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
                                                <input type="number" value="{{$item->cantidad}}"
                                                {{($reserva->estado === 'Cancelado' || $reserva->estado === 'cancelado' || $reserva->estado === 'Aprobado' || $reserva->estado === 'aprobado' || $reserva->estado === 'Rechazado' || $reserva->estado === 'rechazado')? 'disabled': ''}}
                                                >
                                            </td>
                                            <td> 
                                                <input type="hidden" name="equipoEntregadoId[]" value="{{$item->id}}">
                                                <input type="number" name="equipoEntregadoCantidad[]" required>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @else
                                <input type="hidden" name="equipoEntregadoId[]">
                                <input type="hidden" name="equipoEntregadoCantidad[]">
                            @endif
                            <div class="mt-2 mb-3">
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Deja un comentario aquí" id="floatingTextarea" name="comentario" id="" rows="2" required></textarea>
                                    <label for="floatingTextarea">Comentario</label>
                                </div>
                            </div>
                            <div class="col d-md-block w-100">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fa-solid fa-check"></i> Entregar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
@endsection
