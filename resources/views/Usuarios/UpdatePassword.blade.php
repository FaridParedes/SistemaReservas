@extends('layouts.app')
@section('title', 'Cambiar Contraseña')

@section('content')
    <div class="container">
        <p class="fw-medium h2 text-center">Mi cuenta</p>
        <p class="h6 text-center">Cambiar Contraseña</p>
        <hr>
        <div class="row justify-content-center">
            <div class="col-md-6">
                @if (Session::get('alertSuccess'))
                    <div class="alert alert-success" role="alert">
                        <strong>¡Exito! </strong> {{ Session::get('mensaje') }}
                    </div>
                @endif
                @if (Session::get('alertError'))
                    <div class="alert alert-danger" role="alert">
                        <strong>Error! </strong> {{ Session::get('mensaje') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        Cambiar la contraseña
                    </div>
                    <div class="card-body">
                        <form action="/cuenta/update-password" method="POST" class="row g-3">
                            @csrf
                            <div class="col-md-12">
                                <label class="form-label">Contraseña actual</label>
                                <input name="contraseña_actual" type="password" class="form-control" >
                                @error('contraseña_actual')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Contraseña nueva</label>
                                <input name="contraseña_nueva" type="password" class="form-control">
                                @error('contraseña_nueva')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Repite la contraseña nueva</label>
                                <input name="Repite_la_contraseña_nueva" type="password" class="form-control" >
                                @error('Repite_la_contraseña_nueva')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-success">Cambiar Contraseña</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection