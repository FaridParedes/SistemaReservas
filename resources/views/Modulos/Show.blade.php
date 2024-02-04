@extends('layouts.app')
@section('title', 'Módulos')
@section('content')
    <div class="container">
        <p class="fw-medium h2 text-center">Módulos</p>
        <p class="h6 text-center">Listado de módulos</p>
        <a class="btn btn-success" href="/modulos/crear">Agregar módulo</a> 
        <hr>
        @if($modulos === "Vacio")
        <p class="fw-bold text-center">Aún no hay módulos en la base de datos.</p>
        <div class="text-center">
            <a class="btn btn-success" href="/modulos/crear">Agregar módulo</a> 
        </div>
        @else
        <section class="row justify-content-center">
            <div class="col-md-8 w-100">
                <table id="tablaModulos" class="table table-hover">
                    <thead class="table-dark">
                        <td scope="col" class="text-center">ID</td>
                        <td scope="col" class="text-center">Módulo</td>
                        <td scope="col" class="text-center">Acciones</td>
                    </thead>
                    <tbody class="table-group-divider">
                        @foreach ($modulos as $item)
                            <tr>
                                <td scope="row" class="text-center">{{$item -> idModulos}}</td>
                                <td class="text-center">{{$item -> nombreModulo}}</td>
                                <td class="text-center">
                                    <a class="btn btn-info btn-sm" href="/modulos/edit/{{$item->idModulos}}"><i class="fa-solid fa-pencil"></i></a>
                                    <button class="btn btn-danger btn-sm" url="/modulos/destroy/{{$item->idModulos}}" onclick="destroy(this)" token="{{csrf_token()}}"><i class="fa-solid fa-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
        @endif
    </div>
    <script>
        destroy = function(e){
            let url = e.getAttribute('url');
            let token = e.getAttribute('token');
            Swal.fire({
                icon: 'question',
                title: '¿Desea continuar?',
                text: 'El módulo y las reservas asociadas a este serán eliminadas',
                showCancelButton: true,
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Aceptar'
            }).then(response=>{
                if(response.isConfirmed){
                    const request = new XMLHttpRequest();
                    request.open('delete', url);
                    request.setRequestHeader('X-CSRF-TOKEN', token);
                    request.onload = () =>{
                    console.log(request);
                        if(request.status== 200){
                            e.closest('tr').remove()
                            Swal.fire({
                                icon:'success',
                                text: 'Módulo eliminado'
                            }).then(response=>{
                                window.location.href = '/modulos/show';
                            })
                        }
                    }
                    request.onerror = err => rejects(err);
                    request.send();
                }
            })
        }
    </script>
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

            new DataTable('#tablaModulos', {
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
