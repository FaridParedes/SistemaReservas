@extends('layouts.app')
@section('title', 'Gestionar Reservas')
@section('content')
    <div class="container">
        <p class="fw-medium h2 text-center">Reservas</p>
        <p class="h6 text-center">Gestión de reservas</p>
        <hr>
        @if ($Reservas === "Vacio")
        <p class="fw-bold text-center">No se ha realizado ninguna reservación.</p>
        @else
            <section style="margin-top: 20px;">
                <table id="tablaReservas" class="table table-hover align-middle">
                    <thead class="table-dark">
                        <td scope="col">ID</td>
                        <td scope="col">Fechas</td>
                        <td scope="col">Laboratorios</td>
                        <td scope="col">Docente</td>
                        <td scope="col">Estado</td>
                        <td scope="col">Detalles</td>
                        <td scope="col">Acciones</td>
                    </thead>
                    <tbody class="table-group-divider">
                        @foreach ($Reservas as $reserva)
                            <tr class="{{($reserva->estado === "Rechazado" || $reserva->estado === "rechazado")? 'table-danger': ''}} 
                                {{($reserva->estado === "Aprobado" || $reserva->estado === "aprobado")? 'table-success': ''}}
                                {{($reserva->estado === 'Cancelado' || $reserva->estado === 'cancelado')? 'table-warning': ''}}
                                {{($reserva->estado === 'Procesando' || $reserva->estado === 'procesando')? '': ''}}
                                {{($reserva->estado === 'Entregado' || $reserva->estado === 'entregado')? 'table-primary': ''}}

                                ">
                                <td scope="row">{{$reserva->idReservas}}</td>
                                <td class="text-capitalize">
                                    @if($reserva->fechaInicio !== $reserva->fechaFinal)
                                        {{\Carbon\Carbon::parse($reserva->fechaInicio)->format('d/m/Y')}} - {{\Carbon\Carbon::parse($reserva->fechaFinal)->format('d/m/Y')}}
                                    @else
                                        {{\Carbon\Carbon::parse($reserva->fechaInicio)->format('d/m/Y')}}
                                    @endif
                                </td>
                                <td class="text-capitalize">{{$reserva->laboratorio}}</td>
                                <td class="text-capitalize">{{$reserva->docente}}</td>
                                <td>
                                    {{$reserva->estado}}
                                </td>
                                <td>
                                   @if ($reserva->fechaInicio !== $reserva->fechaFinal)
                                        <ul class="list-inline">
                                            <li class="list-inline-item fw-bold">Hora:</li>
                                            <li class="list-inline-item">{{\Carbon\Carbon::parse($reserva->horaInicio)->format('H:i')}} - {{\Carbon\Carbon::parse($reserva->horaFinal)->format('H:i')}}</li>
                                        </ul>
                                        <ul class="list-inline">
                                            <li class="list-inline-item fw-bold">Módulo:</li>
                                            <li class="list-inline-item">{{$reserva->modulo}}</li>
                                        </ul>
                                        <ul class="list-inline">
                                            <li class="list-inline-item fw-bold">Días seleccionados:</li>
                                            <li class="list-inline-item">{{$reserva->dias}}</li>
                                        </ul>
                                   @else
                                        <ul class="list-inline">
                                            <li class="list-inline-item fw-bold">Hora:</li>
                                            <li class="list-inline-item">{{\Carbon\Carbon::parse($reserva->horaInicio)->format('H:i')}} - {{\Carbon\Carbon::parse($reserva->horaFinal)->format('H:i')}}</li>
                                        </ul>
                                        <ul class="list-inline">
                                            <li class="list-inline-item fw-bold">Módulo:</li>
                                            <li class="list-inline-item">{{$reserva->modulo}}</li>
                                        </ul>
                                   @endif 
                                </td>
                                
                                <td>
                                    <a class="btn btn-info" href="/reservas/gestionar/{{$reserva->idReservas}}"> Gestionar <i class="fa-solid fa-gears"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </section>
        @endif
    </div>
    <script type="module">
        
        let tablaReservas = new DataTable('#tablaReservas', {
            language: {
                "emptyTable": "No hay datos disponibles por el momento",
                "info": "Mostrando _START_ de _END_ teniendo _TOTAL_ datos",
                "infoEmpty": "Mostrando 0 de 0 a 0 datos",
                "infoFiltered": "(Filntrando from _MAX_ total datos)",
                "lengthMenu": "Mostrar _MENU_ datos",
                "loadingRecords": "Loading...",
                "search": "Buscar:",
                "zeroRecords": "No se ha encontrado ninguna coincidencia",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Atras"
                }
            }
        });
    </script>
@endsection
