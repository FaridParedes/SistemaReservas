@extends('layouts.app')
@section('title', 'Detalles de Reserva')
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
                                                height="100px" alt="imagen del laboratorio">
                                            </td>
                                            <td> {{$item->nombre}}</td>
                                            <td> {{$item->cantidad}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
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
                                            <td> {{$item->cantidad}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
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
                                        <td> {{$item->cantidad}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection