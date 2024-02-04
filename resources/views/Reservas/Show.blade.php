@extends('layouts.app')
@section('title', 'Mis Reservas')
@section('content')
    <div class="container">
        <p class="fw-medium h2 text-center">Reservas</p>
        <p class="h6 text-center">Listado de mis reservas</p>
        <a class="btn btn-success" href="/reservas/crear">Crear reserva</a> 
        <hr>
        @if ($Reservas === "Vacio")
            <p class="fw-bold text-center">No has realizado ninguna reservación, haz clic en el siguiente botón.</p>
            <div class="text-center">
                <a class="btn btn-success" href="/reservas/crear">Crear reserva</a> 
            </div>        
        @else
            <section style="margin-top: 20px;">
                <table id="tablaReservas" class="table table-hover">
                    <thead class="table-dark">
                        <td scope="col">ID</td>
                        <td scope="col">Fechas</td>
                        <td scope="col">Horas</td>
                        <td scope="col">Laboratorio</td>
                        <td scope="col">Módulo</td>
                        <td scope="col">Estado</td>
                        <td scope="col">Acciones</td>
                    </thead>
                    <tbody class="table-group-divider">
                        @foreach ($Reservas as $reserva)
                            <tr class="{{($reserva->estado === "Rechazado" || $reserva->estado === "rechazado")? 'table-danger': ''}} 
                                {{($reserva->estado === "Aprobado" || $reserva->estado === "aprobado")? 'table-success': ''}}
                                {{($reserva->estado === 'Cancelado' || $reserva->estado === 'cancelado')? 'table-warning': ''}}
                                {{($reserva->estado === 'Procesando' || $reserva->estado === 'procesando')? '': ''}}
                                {{($reserva->estado === 'Entregado' || $reserva->estado === 'entregado')? 'table-primary bg-opacity-25': ''}}

                                ">
                                <td scope="row">{{$reserva->idReservas}}</td>
                                <td class="text-capitalize">
                                    @if($reserva->fechaInicio !== $reserva->fechaFinal)
                                        {{\Carbon\Carbon::parse($reserva->fechaInicio)->format('d/m/Y')}} - {{\Carbon\Carbon::parse($reserva->fechaFinal)->format('d/m/Y')}}
                                    @else
                                        {{\Carbon\Carbon::parse($reserva->fechaInicio)->format('d/m/Y')}}
                                    @endif
                                </td>
                                <td>{{\Carbon\Carbon::parse($reserva->horaInicio)->format('H:i')}} a {{\Carbon\Carbon::parse($reserva->horaFinal)->format('H:i')}}</td>
                                <td class="text-capitalize">{{$reserva->laboratorio}}</td>
                                <td class="text-capitalize">{{$reserva->modulo}}</td>
                                <td class="text-capitalize">{{$reserva->estado}}</td>
                                <td>
                                    <a class="btn btn-info btn-sm" href="/reservas/detalles/{{$reserva->idReservas}}"><i class="fa-solid fa-eye"></i></a>
                                    {{-- <a class="btn btn-info btn-sm" href="/usuarios/rol/{{$user->id}}"><i class="fa-solid fa-pencil"></i></a>
                                    <button class="btn btn-danger btn-sm" url="/usuario/destroy/{{$user->id}}" onclick="destroy(this)" token="{{csrf_token()}}"><i class="fa-solid fa-trash"></i></button> --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </section>
        @endif
    </div>
    <script type="module">
        if({{$alertSuccess}}){
            Swal.fire({
                title: "¡Éxito!",
                text: "{{$mensaje}}",
                icon:"success",
                confirmButtonText: "Aceptar",
            })
        };
        if({{$alertError}}){
            Swal.fire({
                title: "¡Error!",
                text: "{{$mensaje}}",
                icon: "error",
                confirmButtonText: "Aceptar",
            })
        };
        $(document).ready(function() {

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

        });
    </script>
@endsection
