@extends('layouts.app')
@section('title', 'Cambiar rol')
@section('content')
    <div class="container">
        <p class="fw-medium h2 text-center">Usuarios</p>
        <p class="h6 text-center">Cambiar rol</p>
        <hr>
        <div class="row justify-content-center">
            <div class="w-100">
                <div class="card">
                    <div class="card-header">
                        Formulario
                    </div>
                    <div class="card-body">
                        <form class="row g-3" action="/usuarios/rol/update/{{$usuario->id}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="col-md-6">
                                <label class="form-label">Nombre</label>
                                <input name="name" type="text" class="form-control" value="{{$usuario->name}}" disabled readonly>
                            </div>
                            <div class="col-md-6">
                                <label  class="form-label">Correo</label>
                                <input name="email" type="text" class="form-control" value="{{$usuario->email}}" disabled readonly>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Rol</label>
                                <select name="idRoles" class="form-select" required>
                                    @foreach ($roles as $rol)
                                        <option value="{{$rol->idRoles}}" {{($rol->idRoles === $usuario->idRoles)? 'selected':''}}>{{$rol->estado}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-success">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection