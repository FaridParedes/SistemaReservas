@extends('layouts.app')
@section('title', 'Inicio')
@section('content')
<div class="container">
    <div class="text-center">
        <p class="text-uppercase fw-medium h4">¡Bienvenido {{ Auth::user()->name }}!</p>
    </div>
    @if ($laboratorios === 'Vacio')
        <p class="text-uppercase fw-medium h4">No hay laboratorios en la base de datos.</p>
    @else
        <div class="row g-3">
            @foreach ($laboratorios as $item)
                <div class="col-md-4">
                    <div class="card shadow-lg mb-3 p-3">
                        <img src="{{asset('storage/laboratorios/'. $item->fotografia)}}" class="card-img-top" loading="lazy" style="min-height:200px; max-height:200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">{{$item->nombreLaboratorio}}</h5>
                            <p class="card-text">{{$item->descripcion}}</p>
                            <a href="/reservas/crear/{{$item->idLaboratorios}}" class="btn btn-success" >Reservar</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
