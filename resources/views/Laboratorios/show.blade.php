@extends('layouts.app')

@section('title', 'Laboratorios')

@section('content')
    <div class="container">
        @if (session('mensajeModificarLab'))
            <div class="alert alert-success" id="alertaExito">
                {{ session('mensajeModificarLab') }}
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="row justify-content-center">
                    <div class="col-lg-6 text-center rounded-pill p-3 bg-success text-light">
                        <span class="h3">Laboratorios</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 mt-4">
                <a href="/laboratorios/ingreso" class="btn btn-success">Crear nuevo laboratorios</a>
            </div>
            <div class="col-12 col-lg-12 col-sm-12 mt-4">
                <div class="table-responsive">
                    <table id="laboratoriosList" class="table table-secondary align-middle table-hover table-bordered">
                        <thead class="table-dark">
                            <th>Imagen</th>
                            <th>Nombre del laboratorio</th>
                            <th>Descripcion</th>
                            <th>Estado</th>
                            <th>Fecha de ingreso</th>
                            <th>Acciones</th>
                        </thead>
                        <tbody>
                            @foreach ($consulta_laboratorios as $valor)
                                <tr class="text-center">
                                    <td>
                                        <img src="{{ asset('storage/laboratorios/' . $valor->fotografia) }}" width="150px"
                                            height="100px" alt="imagen del laboratorio">
                                        <input type="hidden" class="imgLaboratorios" value="{{ $valor->fotografia }}">
                                        <input type="hidden" class="idLaboratorios" value="{{ $valor->idLaboratorios }}">
                                    </td>
                                    <td>{{ $valor->nombreLaboratorio }}</td>
                                    <td>{{ $valor->descripcion }}</td>
                                    <td>{{ $valor->estado }}</td>
                                    <td>{{ $valor->created_at }}</td>
                                    <td>
                                        <button class="btn btn-primary btnModificar-laboratorios"><i
                                                class="fa-solid fa-pencil"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('/Laboratorios/modificarLaboratorios')
    @include('/Laboratorios/equiposModal')
    @include('/Laboratorios/herramientasModal')
    @include('/Laboratorios/materialesGastablesModal')
    <script type="module">
        $('#alertaExito').fadeOut(2500);

        $(document).ready(function() {

            var laboratorios_table = new DataTable('#laboratoriosList', {
                language: {
                    "emptyTable": "No hay datos disponibles por el momento",
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
                }
            });


            var equiposModal_table = new DataTable('#equiposModal-tabla', {
                language: {
                    "emptyTable": "No hay datos disponibles por el momento",
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
                }
            });


            var herramientasModal_table = new DataTable('#herramientasModal-tabla', {
                language: {
                    "emptyTable": "No hay datos disponibles por el momento",
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
                }
            });


            var materialesModal_table = new DataTable('#materialesModal-tabla', {
                language: {
                    "emptyTable": "No hay datos disponibles por el momento",
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
                }
            });




            // Acciones para modificar el laboratorio

            var materiales_laboratorios = new DataTable('#materiales-laboratorios', {
                language: {
                    "emptyTable": "No hay datos disponibles por el momento",
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
                }
            });

            var herramientas_laboratorios = new DataTable('#herramientas-laboratorios', {
                language: {
                    "emptyTable": "No hay datos disponibles por el momento",
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
                }
            });

            var equipos_laboratorios = new DataTable('#equipos-laboratorios', {
                language: {
                    "emptyTable": "No hay datos disponibles por el momento",
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
                }
            });



            var modificarLaboratorios = new bootstrap.Modal(document.getElementById(
                'modificarLaboratorios'));

            var equiposModal = new bootstrap.Modal(document.getElementById('equiposModalList'));

            var herramientasModal = new bootstrap.Modal(document.getElementById('herramientasModalList'));

            var materialModal = new bootstrap.Modal(document.getElementById('materialModalList'));


            $('#laboratoriosList tbody').on('click', '.btnModificar-laboratorios', function() {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                var fila = $(this).closest('tr');

                var idLaboratorios = fila.find('.idLaboratorios').val();

                var imagenLaboratorios = fila.find('.imgLaboratorios').val();

                var datos_laboratorios = laboratorios_table.row(fila).data();

                $('#nombreLab-update').val(datos_laboratorios[1]);
                $('#descripcionLab-update').val(datos_laboratorios[2]);
                $('#imgLaboratorios-update').val(imagenLaboratorios);

                $('#updateLaboratorios').attr('action', `/laboratorios/update/${idLaboratorios}`);

                $.ajax({
                    url: '/laboratorios/laboratoriosRecursos/' + idLaboratorios,
                    type: "post",
                    dataType: "json",
                    success: function(data) {

                        const materiales = [];

                        const herramientas = [];

                        const equipos = [];


                        if (data['materiales_gastables'].length > 0) {

                            $('#materiales-laboratorios').DataTable().clear()

                            for (let i in data['materiales_gastables']) {


                                $('#materiales-laboratorios').DataTable().row.add([
                                    '<img src="{{ asset('storage/materialesGastables/') }}' +
                                    '/' + data['materiales_gastables'][i].fotografia +
                                    '" width="150px" height="100px" alt="imagen del Material gastable">',
                                    data['materiales_gastables'][i].nombre,
                                    data['materiales_gastables'][i].descripcion,
                                    data['materiales_gastables'][i].stock,
                                    '<input type="checkbox" class="form-check-input" name="eliminarMateriales[]" value="' +
                                    data['materiales_gastables'][i].idMaterialGastable +
                                    '">'
                                ]);

                            }

                            $('#materiales-laboratorios').DataTable().draw(false);

                        }


                        if (data['herramientas'].length > 0) {

                            $('#herramientas-laboratorios').DataTable().clear()

                            for (let i in data['herramientas']) {

                                $('#herramientas-laboratorios').DataTable().row.add([
                                    '<img src="{{ asset('storage/herramientas/') }}' +
                                    '/' +
                                    data['herramientas'][i].fotografia +
                                    '" width="150px" height="100px" alt="imagen de la herramienta">',
                                    data['herramientas'][i].nombre,
                                    data['herramientas'][i].descripcion,
                                    '<input type="checkbox" class="form-check-input" name="eliminarHerramientas[]" value="' +
                                    data['herramientas'][i].idHerramientas + '">'
                                ]);

                            }


                            $('#herramientas-laboratorios').DataTable().draw(false);
                        }


                        if (data['equipos'].length > 0) {

                            $('#equipos-laboratorios').DataTable().clear()

                            for (let i in data['equipos']) {

                                $('#equipos-laboratorios').DataTable().row.add([
                                    '<img src="{{ asset('storage/equipos/') }}' + '/' +
                                    data[
                                        'equipos'][i].fotografia +
                                    '" width="150px" height="100px" alt="imagen del equipo">',
                                    data['equipos'][i].nombre,
                                    data['equipos'][i].sistema_operativo,
                                    data['equipos'][i].espacio_disponible,
                                    '<input type="checkbox" class="form-check-input" name="eliminarEquipos[]" value="' +
                                    data['equipos'][i].idEquipos + '">'
                                ]);

                            }

                            $('#equipos-laboratorios').DataTable().draw(false);
                        }


                        modificarLaboratorios.show();

                    },
                    error: function(error) {
                        console.log(error);
                    }
                });


            });



            //Apartado de modal equipoModal

            $('.equiposLaboratorios').click(function() {

                equiposModal.show()

            });


            equiposModal_table.on('click', 'tbody tr', function() {
                let data = equiposModal_table.row(this).data();

                $('#equipos-laboratorios').DataTable().row.add([
                    data[0],
                    data[1],
                    data[2],
                    data[3],
                    '<button type="button" class="btn btn-success btn-eliminarEquipo"><i class="fa-solid fa-trash"></i></button></button>'
                ]).draw(false);

                equiposModal_table.row(this).remove().draw(false);

                Swal.fire({
                    title: "Exito",
                    text: "Se ha agregado el equipo con exito",
                    icon: "success"
                });
            });

            equipos_laboratorios.on('click', 'tbody .btn-eliminarEquipo', function() {

                let fila = $(this).closest('tr');

                var data = equipos_laboratorios.row(fila).data();

                equiposModal_table.row.add([
                    data[0],
                    data[1],
                    data[2],
                    data[3]
                ]).draw(false);

                equipos_laboratorios.row(fila).remove().draw(false);

                Swal.fire({
                    title: "Exito",
                    text: "Se ha eliminado del listado",
                    icon: "success"
                });

            });


            $('.herramientasLaboratorios').click(function() {

                herramientasModal.show();

            });


            herramientasModal_table.on('click', 'tbody tr', function() {

                var data = herramientasModal_table.row(this).data();

                herramientas_laboratorios.row.add([
                    data[0],
                    data[1],
                    data[2],
                    '<button type="button" class="btn btn-success btn-eliminarHerra"><i class="fa-solid fa-trash"></i></button></button>'
                ]).draw(false);

                herramientasModal_table.row(this).remove().draw(false);

                Swal.fire({
                    title: "Exitos",
                    text: "Se ha agregado la herramienta con exito",
                    icon: "success"
                });

            });

            herramientas_laboratorios.on('click', 'tbody .btn-eliminarHerra', function() {

                var fila = $(this).closest('tr');

                var data = herramientas_laboratorios.row(fila).data();

                herramientasModal_table.row.add([
                    data[0],
                    data[1],
                    data[2]
                ]).draw(false);

                herramientas_laboratorios.row(fila).remove().draw(false);

                Swal.fire({
                    title: "Exito",
                    text: "Se ha eliminado con exito",
                    icon: "success"
                });

            });

            $('.materialesLaboratorios').click(function() {

                materialModal.show();

            });

            materialesModal_table.on('click', 'tbody tr', function() {

                var data = materialesModal_table.row(this).data();

                materiales_laboratorios.row.add([
                    data[0],
                    data[1],
                    data[2],
                    data[3],
                    '<button type="button" class="btn btn-success btn-eliminarMate"><i class="fa-solid fa-trash"></i></button></button>'
                ]).draw(false);

                materialesModal_table.row(this).remove().draw(false);

                Swal.fire({
                    title: "Existo",
                    text: "Se ha agregado el material con exito",
                    icon: "success"
                });

            });

            materiales_laboratorios.on('click', 'tbody .btn-eliminarMate', function() {

                var fila = $(this).closest('tr');

                var data = materiales_laboratorios.row(fila).data();

                materialesModal_table.row.add([
                    data[0],
                    data[1],
                    data[2],
                    data[3]
                ]).draw(false);

                materiales_laboratorios.row(fila).remove().draw(false);

                Swal.fire({
                    title: "Exito",
                    text: "Se ha agregado el material con exito",
                    icon: "success"
                });

            });
        });
    </script>
@endsection
