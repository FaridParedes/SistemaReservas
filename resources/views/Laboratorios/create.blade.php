@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('mensajeLaboratorio'))
            <div class="alert alert-success" id="alertaExito">
                {{ session('mensajeLaboratorio') }}
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-10">
                <div class="card">
                    <div class="card-header text-center p-3">
                        <span class="h4">Formulario de ingreso de laboratorios</span>
                    </div>
                    <form action="/laboratorios/store" method="POST" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        <div class="card-body">
                            <div class="row p-3">
                                <div class="col-lg-6 col-12">
                                    <div class="form-floating">
                                        <input type="text" name="nombreLaboratorio"
                                            placeholder="Ingresar nombre del laboratorio" class="form-control"
                                            id="nombreLab">
                                        <label for="nombreLab">Nombre del laboratorio</label>
                                    </div>
                                    @error('nombreLaboratorio')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-6 col-12 mt-lg-0 mt-4">
                                    <div class="form-floating">
                                        <textarea placeholder="Ingresar Descripcion" name="descripcion"
                                            class="form-control" id="descripcion" cols="30" rows="10"></textarea>
                                        <label for="descripcion">Descripcion</label>
                                    </div>
                                    @error('descripcion')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-8 col-12 mt-lg-4 mt-4">
                                    <div class="form-floating">
                                        <input type="file" placeholder="Seleccionar imagen" name="fotografia"
                                            class="form-control" id="imgLab">
                                        <label for="imgLab">Imagen del laboratorio</label>
                                    </div>
                                    @error('fotografia')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-12 mt-4">
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                        data-bs-target="#modalMateriales">
                                        <i class="fa-solid fa-plus"></i>
                                    </button>
                                    <div class="table-responsive mt-3">
                                        <table id="materiales" class="table align-middle table-secondary tablee-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Imagen</th>
                                                    <th>Nombre del material</th>
                                                    <th>Descripcion</th>
                                                    <th>Cantidad</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-center">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-lg-12 mt-4">
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                        data-bs-target="#modalHerramientas">
                                        <i class="fa-solid fa-plus"></i>
                                    </button>
                                    <div class="table-responsive mt-3">
                                        <table id="herramientas" class="table align-middle table-secondary table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Imagen</th>
                                                    <th>Nombre</th>
                                                    <th>Descripcion</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-center">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-lg-12 mt-lg-4">
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                        data-bs-target="#modalEquipos">
                                        <i class="fa-solid fa-plus"></i>
                                    </button>
                                    <div class="table-responsive mt-3">
                                        <table id="equipos" class="table align-middle table-secondary table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Imagen</th>
                                                    <th>Nombre equipo</th>
                                                    <th>sistema operativo</th>
                                                    <th>espacio disponible</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-center">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <input type="submit" value="Guardar Laboratorio" class="btn btn-success">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('Laboratorios/modalHerramientas');
    @include('Laboratorios/modalEquipos');
    @include('Laboratorios/modalMateriales');
    <script type="module">
        $(document).ready(function() {

            $('#alertaExito').fadeOut(2500);

            new DataTable('#herramientas', {
                language: {
                    "emptyTable": "No hay herramientas disponibles por el momento",
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
                    datos_fila[2]
                ]).draw(false);

                Swal.fire({
                    title: "Exito",
                    text: "Se ha removido con exito",
                    icon: "success"
                });
            });

            new DataTable('#equipos', {
                language: {
                    "emptyTable": "No hay equipos disponibles por el momento",
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
                    "emptyTable": "No hay materiales disponibles por el momento",
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
