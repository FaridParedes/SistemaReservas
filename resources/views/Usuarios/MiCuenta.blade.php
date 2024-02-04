@extends('layouts.app')
@section('title', 'Mi cuenta')

@section('content')
    <div class="container">
        <p class="fw-medium h2 text-center">Mi cuenta</p>
        <hr>
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card">
                    <div class="card-header">
                        Información de la cuenta
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <p class="text-capitalize">nombre: {{$usuario->name}}</p>
                            </div>
                            <div class="col-md-6">
                                <p class="">Email: {{$usuario->email}}</p>
                            </div>
                            <div class="col-12">
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalInformacion">Cambiar Información</button>
                                <a class="btn btn-success" href="/cuenta/update/password">Cambiar Contraseña</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('Usuarios/modalInformacion');
    <script type="module">
        $(document).ready(function(){

            if({{$modError}}){
                Swal.fire({
                    title: "¡Error!",
                    text: "{{$mensaje}}",
                    icon: "error",
                    confirmButtonText: "Aceptar",
                }).then((result)=>{
                    if (result.isConfirmed) {
                        window.location.href = '/cuenta';
                    }
                })
            }else if({{$modCorrecta}}){
                Swal.fire({
                    title: "¡Éxito!",
                    text: "{{$mensaje}}",
                    icon: "success",
                    confirmButtonText: "Aceptar",
                }).then((result)=>{
                    if (result.isConfirmed) {
                        window.location.href = '/cuenta';
                    }
                })
            }
        });
    </script>
@endsection