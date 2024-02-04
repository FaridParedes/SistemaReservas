@extends('layouts.app')
@section('title', 'Crear Reserva')
@section('content')
    <div class="container">
        <p class="fw-medium h2 text-center">Reservas</p>
        <p class="h6 text-center">Crear reserva</p>
        <div class="w-100">
            <ul class="nav nav-underline">
                @if ($id != 0)
                    <li class="nav-item">
                        <a class="nav-link text-success" aria-current="page" href="/reservas/crear/{{$id}}">Reservar por rango de fechas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/reservas/crear/dia/{{$id}}">Reservar por un día</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link text-success" aria-current="page" href="/reservas/crear">Reservar por rango de fechas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/reservas/crear/dia">Reservar por un día</a>
                    </li>
                @endif
              </ul>
        </div>
        <hr>
        <div class="row justify-content-center">
            <div class="w-100">
                @if (session('mensajeError'))
                    <div class="alert alert-danger alert-dismissible fade show"  role="alert">
                        <strong>{{ session('mensajeError') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        Formulario
                    </div>
                    <div class="card-body">
                        <form class="row g-3" method="POST" action="/reservas/store/dia">
                            @csrf
                            <div class="col-md-6">
                                <label class="form-label">Módulo</label>
                                <select name="modulo" class="form-select" required>
                                    @if ($modulos === "Vacio")
                                        <option selected>Aún no hay módulos</option>
                                    @else
                                        <option>Elige uno...</option>
                                        @foreach ($modulos as $item)
                                            <option value="{{$item->idModulos}}" {{ old('modulo') == $item->idModulos ? 'selected' : '' }}>{{$item->nombreModulo}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('modulo')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label  class="form-label">Laboratorio</label>
                                <select name="laboratorio" class="form-select" required>
                                    @if ($laboratorios === "Vacio")
                                    <option selected>Aún no hay laboratorios</option>
                                    @else
                                        <option>Elige uno...</option>
                                        @foreach ($laboratorios as $item)
                                            @if (old('laboratorio') == $item->idLaboratorios)
                                                <option value="{{$item->idLaboratorios}}" selected>{{$item->nombreLaboratorio}}</option>
                                            @else
                                                <option value="{{$item->idLaboratorios}}" {{($item->idLaboratorios === $id)? 'selected':''}}>{{$item->nombreLaboratorio}}</option>
                                            @endif
                                        @endforeach
                                    @endif
                                </select>
                                @error('laboratorio')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Fecha de reservación</label>
                                <input name="fechaReservacion" type="date" class="form-control" value="{{ old('fechaReservacion')}}" required>
                                @error('fechaReservacion')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Hora de inicio</label>
                                <input name="horaInicio" type="time" class="form-control" value="{{ old('horaInicio')}}" required>
                                @error('horaInicio')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label  class="form-label">Hora de finalización</label>
                                <input name="horaFinal" type="time" class="form-control" value="{{ old('horaFinal')}}" required>
                                @error('horaFinal')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <hr>
                            <div class="col-md-12">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="parametro" id="parametro">
                                    <label class="form-check-label text">¿Desea agregar un equipo, una herramienta o un material extra?</label>
                                </div>
                            </div>
                            <div class="col-md-12 d-none" id="Tablas">
                                <div class="col-lg-12 mt-4">
                                    <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                                        data-bs-target="#modalMateriales">
                                        Seleccionar material extra
                                    </button>
                                    <div class="table-responsive mt-3">
                                        <table id="materiales" class="table align-middle table-secondary table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Imagen</th>
                                                    <th>Nombre del material</th>
                                                    <th>Cantidad</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-lg-12 mt-4">
                                    <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                                        data-bs-target="#modalHerramientas">
                                        Seleccionar herramienta extra
                                    </button>
                                    <div class="table-responsive mt-3">
                                        <table id="herramientas" class="table align-middle table-secondary table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Imagen</th>
                                                    <th>Nombre de la herramienta</th>
                                                    <th>Cantidad</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-lg-12 mt-lg-4">
                                    <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                                        data-bs-target="#modalEquipos">
                                        Seleccionar equipo extra
                                    </button>
                                    <div class="table-responsive mt-3">
                                        <table id="equipos" class="table align-middle table-secondary table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Imagen</th>
                                                    <th>Nombre equipo</th>
                                                    <th>Sistema operativo</th>
                                                    <th>Cantidad</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-success">Reservar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('Reservas/modalHerramientas')
    @include('Reservas/modalEquipos')
    @include('Reservas/modalMateriales')
    <script type="module">
        $(document).ready(function(){

            $('#parametro').change(function(){
                if($(this).is(":checked")){
                    $("#Tablas").removeClass("d-none");
                }else{
                    $("#Tablas").addClass("d-none");
                }
            });

            new DataTable('#herramientas', {
                language: {
                    "emptyTable": "No ha seleccionado herramienta extra",
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
                },
                responsive: true
            });

            $('#herramientas tbody').on('click', '.btnEliminar', function() {
                // Obtener la fila
                var fila = $(this).closest('tr');

                var datos_fila = $('#herramientas').DataTable().row(fila).data();

                $('#herramientas').DataTable().row(fila).remove().draw(false);

                $('#tablaHerramientas').DataTable().row.add([
                    datos_fila[0],
                    datos_fila[1],
                    datos_fila[2],
                    datos_fila[3]
                ]).draw(false);

                Swal.fire({
                    title: "Exito",
                    text: "Se ha removido con exito",
                    icon: "success"
                });
            });

            new DataTable('#equipos', {
                language: {
                    "emptyTable": "No ha seleccionado equipo extra",
                    "info": "Mostrando _START_ de _END_ teniendo _TOTAL_ datos",
                    "infoEmpty": "Mostrando 0 de 0 a 0 datos",
                    "infoFiltered": "(Filtrando from _MAX_ total datos)",
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
                },
                responsive: true
            });

            $('#equipos tbody').on('click', '.btnEliminar2', function() {
                // Obtener la fila
                var fila = $(this).closest('tr');

                var datos_fila = $('#equipos').DataTable().row(fila).data();

                $('#equipos').DataTable().row(fila).remove().draw(false);

                $('#tablaEquipos').DataTable().row.add([
                    datos_fila[0],
                    datos_fila[1],
                    datos_fila[2],
                    datos_fila[3]
                ]).draw(false);

                Swal.fire({
                    title: "Exito",
                    text: "Se ha removido con exito",
                    icon: "success"
                });
            });


            new DataTable('#materiales', {
                language: {
                    "emptyTable": "No ha seleccionado material extra",
                    "info": "Mostrando _START_ de _END_ teniendo _TOTAL_ datos",
                    "infoEmpty": "Mostrando 0 de 0 a 0 datos",
                    "infoFiltered": "(Filtrando from _MAX_ total datos)",
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
                },
                responsive: true
            });

            $('#materiales tbody').on('click', '.btnEliminar3', function() {
                // Obtener la fila
                var fila = $(this).closest('tr');

                var datos_fila = $('#materiales').DataTable().row(fila).data();

                $('#materiales').DataTable().row(fila).remove().draw(false);

                $('#tablaMateriales').DataTable().row.add([
                    datos_fila[0],
                    datos_fila[1],
                    datos_fila[2],
                    datos_fila[3]
                ]).draw(false);

                Swal.fire({
                    title: "Exito",
                    text: "Se ha removido con exito",
                    icon: "success"
                });
            });

        });
    </script>
@endsection