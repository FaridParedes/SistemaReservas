@extends('layouts.app')

@section('title', 'Ingreso de herramientas')

@section('content')
    <div class="container">
        @if (session('mensaje'))
            <div class="alert alert-success" id="alertaExito">
                {{ session('mensaje') }}
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="w-100">
                <div class="card">
                    <div class="card-header">
                        Formulario para ingreso de herramientas
                    </div>
                    <div class="card-body">
                        <form action="/herramientas/store" method="POST" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 col-sm-12 mt-lg-2">
                                    <div class="form-floating">
                                        <input type="text"
                                            class="form-control @error('nombre') is-invalid @enderror"
                                            id="nombre" placeholder="Ingresar el nombre de un herramienta"
                                            name="nombre">
                                        <label for="nombre">Nombre de la herramienta<span
                                                class="text-danger">*</span></label>
                                    </div>
                                    @error('nombre')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-6 col-sm-12 mt-lg-2 mt-sm-4">
                                    <div class="form-floating">
                                        <input type="file"
                                            class="form-control @error('imgHerramienta') is-invalid @enderror"
                                            id="imgHerramienta" name="imgHerramienta">
                                        <label for="imgHerramienta">Imagen de la herramienta<span
                                                class="text-danger">*</span></label>
                                    </div>
                                    @error('imgHerramienta')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-6 col-sm-12 mt-lg-4 mt-sm-4">
                                    <div class="form-floating">
                                        <textarea name="descripcion" id="descripcionHerramienta"
                                        class="form-control" placeholder="Ingresar detalle de la herramienta"
                                        cols="30" rows="10"></textarea>
                                        <label for="detalleHerramienta">Descricion de la herramienta<span class="text-danger">*</span></label>
                                    </div>
                                    @error('detalle')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-6 col-sm-12 mt-lg-4 mt-sm-4">
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('marca') is-invalid @enderror"
                                            id="inputMarca" placeholder="Ingresar el nombre de la marca" name="marca">
                                        <label for="inputMarca">Marca<span class="text-danger">*</span></label>
                                    </div>
                                    @error('marca')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-6 col-sm-12 mt-lg-4 mt-sm-4">
                                    <div class="form-floating">
                                        <input type="number" name="stock" id="stockHerramienta"
                                        class="form-control @error('stock') is-invalid @enderror"
                                        placeholder="Ingresar el stock de la herramienta">
                                        <label for="stockHerramienta">Stock de la herramienta <span class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-sm-12 mt-lg4 mt-sm-4">
                                    <input type="submit" class="btn btn-success" value="Guardar datos">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="module">
        $(document).ready(function() {

            $('#alertaExito').fadeOut(2500);

        });
    </script>
@endsection
