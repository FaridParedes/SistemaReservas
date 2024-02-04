@extends('layouts.app')

@section('title', 'Ingreso del material gastable')

@section('content')
    <div class="container">
        @if (session('mensajeMaterial'))
            <div class="alert alert-success" id="alertaExito">
                {{ session('mensajeMaterial') }}
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="w-100">
                <div class="card">
                    <div class="card-header">
                        Formulario de ingreso para un material
                    </div>
                    <div class="card-body">
                        <form action="/materialGastable/store" method="POST" enctype="multipart/form-data"
                            autocomplete="off">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 col-sm-12 mt-lg-2">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="nombreMaterial"
                                            placeholder="Ingresar el nombre del material" name="nombre"
                                            value="{{ old('nombre') }}">
                                        <label for="nombreMaterial">Nombre del material</label>
                                    </div>
                                    @error('nombre')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-6 col-sm-12 mt-lg-2 mt-sm-4 mt-4">
                                    <div class="form-floating">
                                        <input type="file" class="form-control" id="fotografiaMaterial"
                                            name="fotografia">
                                        <label for="fotografiaMaterial">Imagen del material</label>
                                    </div>
                                    @error('fotografia')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-6 col-sm-12 mt-lg-4 mt-sm-4 mt-4">
                                    <div class="form-floating">
                                        <textarea name="descripcion" id="descripcionMaterial" class="form-control"
                                            placeholder="Ingresar la descripcion del material" cols="30" rows="10" value="{{ old('marca') }}"></textarea>
                                        <label for="descripcionMaterial">Descripcion del Material</label>
                                    </div>
                                    @error('descripcion')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-6 col-sm-12 mt-lg-4 mt-sm-4 mt-4">
                                    <div class="row">
                                        <div class="col-lg-12" id="tiposCantidades-select">
                                            <select name="idTipos_cantidades" class="form-select p-3"
                                                aria-label="cantidad selectida determinada" id="tiposCantidades">
                                                <option value="" selected>Seleccionar el tipo de cantidad del material</option>
                                                @foreach ($tiposCantidades as $valor)
                                                    <option value="{{ $valor->idTipos_cantidades }}">{{ $valor->tipo }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-12 d-none mt-4" id="cantidadMaterial">
                                            <div class="form-floating">
                                                <input type="number" class="form-control" id="stockMaterial"
                                                    placeholder="Ingresar el stock del material" name="stock"
                                                    min="0" step="00.01" value="{{ old('stock') }}">
                                                <label for="stockMaterial">Cantidad del material</label>
                                            </div>
                                            @error('stock')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12 mt-lg4 mt-sm-4 mt-4">
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

            $('#tiposCantidades').change(function () {
               
                if ($(this).val() != "") {
                    
                    $('#cantidadMaterial').removeClass('d-none');

                } else {

                    $('#cantidadMaterial').addClass('d-none');

                }
                
            });

        });
    </script>
@endsection
