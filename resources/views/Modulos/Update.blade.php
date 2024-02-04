@extends('layouts.app')
@section('title', 'Modificar Módulo')

@section('content')
    <div class="container">
        <p class="fw-medium h2 text-center">Módulos</p>
        <p class="h6 text-center">Modificar módulo</p>
        <hr>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Modificar módulo
                    </div>
                    <div class="card-body">
                        <form class="row g-3" action="/modulos/update/{{$modulo->idModulos}}" method="POST">
                            @csrf
                            <div class="input-group">
                                <div class="form-floating">
                                    <input value="{{$modulo->nombreModulo}}" id="titulo_del_modulo" placeholder="Título del módulo" name="titulo_del_modulo" type="text" class="form-control" maxlength="100" required>
                                    <label for="">Título del módulo</label>   
                                </div>
                                <span id="charCount" class="input-group-text">0/100 caracteres</span>
                                @error('titulo_del_modulo')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-success">Modificar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var inputTitulo = document.getElementById('titulo_del_modulo');
            var charCountSpan = document.getElementById('charCount');

            if(inputTitulo.value.length>0){
                var charCount = inputTitulo.value.length;
                charCountSpan.textContent = charCount + '/100 caracteres';
            };
            inputTitulo.addEventListener('input', function () {
                var charCount = inputTitulo.value.length;
                charCountSpan.textContent = charCount + '/100 caracteres';
            });
        });
    </script>
@endsection