@extends('layouts.app')
@section('title', 'Usuarios')

@section('content')
    <div class="container">
        <p class="fw-medium h2 text-center">Usuarios</p>
        <p class="h6 text-center">Listado usuarios registrados</p>
        <a class="btn btn-success" href="/usuarios/crear">Crear usuario</a> 
        <hr>
        @if ($usuarios->isEmpty())
        <p class="fw-bold text-center">No hay ningún usuario registrado.</p>
        <div class="text-center">
            <a class="btn btn-success" href="/usuarios/crear">Crear usuario</a> 
        </div>    
        @else
            <section style="margin-top: 20px;">
                <table id="tablaUsuarios" class="table table-hover">
                    <thead class="table-dark">
                        <td scope="col" class="text-center">ID</td>
                        <td scope="col" class="text-center">Nombre</td>
                        <td scope="col" class="text-center">Email</td>
                        <td scope="col" class="text-center">Rol</td>
                        <td scope="col" class="text-center">Registro</td>
                        <td scope="col" class="text-center">Acciones</td>
                    </thead>
                    <tbody class="table-group-divider">
                        @foreach ($usuarios as $user)
                            <tr>
                                <td scope="row" class="text-center">{{$user->id}}</td>
                                <td class="text-capitalize text-center">{{$user->name}}</td>
                                <td class="text-center">{{$user->email}}</td>
                                <td class="text-capitalize text-center">{{$user->rol}}</td>
                                <td class="text-center">{{$user->registro}}</td>
                                <td class="text-center">
                                    <a class="btn btn-info btn-sm" href="/usuarios/rol/{{$user->id}}"><i class="fa-solid fa-pencil"></i></a>
                                    <button class="btn btn-danger btn-sm" url="/usuario/destroy/{{$user->id}}" onclick="destroy(this)" token="{{csrf_token()}}"><i class="fa-solid fa-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </section>
        @endif
    </div>
    <script type="module">
        $(document).ready(function(){

            if({{$alertError}}){
                Swal.fire({
                    title: "¡Error!",
                    text: "{{$mensaje}}",
                    icon: "error",
                    confirmButtonText: "Aceptar",
                })
            }else if({{$alertSuccess}}){
                Swal.fire({
                    title: "¡Éxito!",
                    text: "{{$mensaje}}",
                    icon: "success",
                    confirmButtonText: "Aceptar",
                })
            }
        });
    </script>
    <script>
        destroy = function(e){
            let url = e.getAttribute('url')
            let token = e.getAttribute('token')
            Swal.fire({
                icon: 'question',
                title: '¿Desea continuar?',
                text: 'El usuario y las reservas asociadas a este serán eliminadas',
                showCancelButton: true,
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Aceptar'
            }).then((res)=>{
                if(res.isConfirmed){
                    const request = new XMLHttpRequest();
                    request.open('delete', url);
                    request.setRequestHeader('X-CSRF-TOKEN', token);
                    request.onload = () => {
                        console.log(request);
                        if (request.status==200) {
                            e.closest('tr').remove()
                            Swal.fire({
                                icon: 'success',
                                text: 'Usuario eliminado'
                            }).then(response=>{
                                window.location.href = '/usuarios/show';
                            })
                        }
                    }
                    request.onerror = () => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Hubo un problema al realizar la solicitud. Por favor, inténtelo de nuevo.'
                        });
                    };
                    request.send();
                }
            })
        }
    </script>
    <script type="module">
        $(document).ready(function() {

            new DataTable('#tablaUsuarios', {
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