@extends('layouts.app')

@section('title', 'Listado de equipos')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="row justify-content-center">
                    <div class="col-lg-6 text-center rounded-pill p-3 bg-success text-light">
                        <span class="h3">Equipos</span>
                    </div>
                </div>
                @if (session('mensaje'))
                    <div class="alert alert-success mt-4" id="alertaExito">
                        {{ session('mensaje') }}
                    </div>
                @endif
            </div>
            <div class="col-lg-12 mt-4">
                <a href="/equipos/ingreso" class="btn btn-success">Ingresar un nuevo equipo</a>
            </div>
            <div class="col-12 col-lg-12 col-sm-12 mt-4">
                <div class="table-responsive">
                    <table id="equiposList" class="table table-secondary align-middle table-hover table-bordered w-100">
                        <thead class="table-dark">
                            <th scope="col">Imagen</th>
                            <th scope="col">Nombre del equipo</th>
                            <th scope="col">Detalles del equipo</th>
                            <th scope="col">Programas</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Fecha de ingreso</th>
                            <th scope="col">Acciones</th>
                        </thead>
                        <tbody>
                            @foreach ($consulta_equipos as $valor)
                                <tr>
                                    <td class="text-center">
                                        <img src="{{ asset('storage/equipos/' . $valor->fotografia) }}" width="150px"
                                            alt="">
                                        <input type="hidden" class="fotografia" value="{{ $valor->fotografia }}">
                                        <input type="hidden" class="idEquipos" value="{{ $valor->idEquipos }}">
                                    </td>
                                    <td class="text-center">{{ $valor->nombre }}</td>
                                    <td>
                                        <p>
                                            <b>Sistema operativo: </b>  {{ $valor->sistema_operativo }}<input type="hidden" class="sistemaOperativo" value="{{ $valor->idSistemasOperativos }}"> <br>
                                            <b>Espacio Diponible: </b>  {{ $valor->espacio_disponible }}<br>
                                            <b>RAM: </b> {{ $valor->ram }}<br>
                                            <b>Porcesador: </b> {{ $valor->procesador }} <br>
                                        </p>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-primary btn-listadoProgramas">
                                            <i class="fa-solid fa-bars"></i>
                                        </button>
                                    </td>
                                    <td class="text-center">{{ $valor->estado }}</td>
                                    <td class="text-center">{{ $valor->created_at }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-primary btnModificar"><i
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
    @include('Equipos/modificarEquipos');
    @include('Equipos/programas')
    <script type="module">
        $(document).ready(function() {

            $('#alertaExito').fadeOut(2500);

            let equipos_tabla = new DataTable('#equiposList', {
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

            let programas_tabla = new DataTable('#programasList', {
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

            var modalModificar = new bootstrap.Modal(document.getElementById('modificarEquipos'));
            var modalProgramas = new bootstrap.Modal(document.getElementById('modalProgramas'));



            $('#equiposList tbody').on('click', '.btnModificar', function() {

                var fila = $(this).closest('tr');

                var imagen = fila.find('.fotografia').val();
                var idEquipos = fila.find('.idEquipos').val();
                var idSistemasOperativos = fila.find('.sistemaOperativo').val();

                var datos_fila = equipos_tabla.row(fila).data();


                $('#fotografiaUpdate').val(imagen);
                $('#nombreUpdate').val(datos_fila[1]);
                $('#sl-sistemaOperativos').val(idSistemasOperativos);
                $('#espacioDisponibleUpdate').val(datos_fila[3]);
                $('#ramUpdate').val(datos_fila[4]);
                $('#procesadorUpdate').val(datos_fila[5]);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                var idEquipos = fila.find('.idEquipos').val();

                $.ajax({
                    url: '/equipos/programas/' + idEquipos,
                    type: "get",
                    dataType: "json",
                    success: function(data) {

                        $('#programasList').DataTable().clear().draw();

                        const listado_programas = [];

                        $.each(data, function(index, programa) {
                            const fila = [
                                (Number(index) + 1),
                                programa.nombre_programa,
                                `<input class="form-check-input" type="checkbox" name="programasEliminar[]" value="${programa.idProgramas_equipos}">`
                            ];
                            listado_programas.push(fila);
                        });

                        // Agregar las filas a la tabla
                        $('#programasList').DataTable().rows.add(listado_programas).draw(false);

                    }
                });

                $('#modificarEquipo').attr('action', `/equipos/update/${idEquipos}`);

                modalModificar.show();

            });

            $('#equiposList tbody').on('click', '.btn-listadoProgramas', function() {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                var fila = $(this).closest('tr');

                var idEquipos = fila.find('.idEquipos').val();

                $.ajax({
                    url: '/equipos/programas/' + idEquipos,
                    type: "get",
                    dataType: "json",
                    success: function(data) {

                        $('#programasTabla').DataTable().clear().draw();

                        const listado_programas = [];

                        $.each(data, function(index, programa) {
                            const fila = [
                                (Number(index) + 1),
                                programa.nombre_programa
                            ];
                            listado_programas.push(fila);
                        });

                        // Agregar las filas a la tabla
                        $('#programasTabla').DataTable().rows.add(listado_programas).draw(
                            false);

                    }
                });

                modalProgramas.show();

            });




            //Acciones para el modal al modificar

            $('#alertaNombre').hide();
            $('#alertaSistema_operativo').hide();
            $('#alertaEspacio_disponible').hide();
            $('#alertaRam').hide();
            $('#alertaProcesador').hide();

            $('#nombreUpdate').keyup(function() {

                if ($(this).val() == "") {

                    $('#alertaNombre').show();

                } else {

                    $('#alertaNombre').hide();

                }

            });


            $('#sistemaOperativoUpdate').keyup(function() {

                if ($(this).val() == "") {

                    $('#alertaSistema_operativo').show();

                } else {

                    $('#alertaSistema_operativo').hide();

                }

            });


            $('#espacioDisponibleUpdate').keyup(function() {

                if ($(this).val() == "") {

                    $('#alertaEspacio_disponible').show();

                } else {

                    $('#alertaEspacio_disponible').hide();

                }

            });


            $('#ramUpdate').keyup(function() {

                if ($(this).val() == "") {

                    $('#alertaRam').show();

                } else {

                    $('#alertaRam').hide();

                }

            });


            $('#procesadorUpdate').keyup(function() {

                if ($(this).val() == "") {

                    $('#alertaProcesador').show();

                } else {

                    $('#alertaProcesador').hide();

                }

            });


            $('.cerrarModificar').click(function() {

                $('#nombreUpdate').val("");
                $('#sistemaOperativoUpdate').val("");
                $('#espacioDisponibleUpdate').val("");
                $('#ramUpdate').val("");
                $('#procesadorUpdate').val("");
                $('#fotografiaUpdate').val("");

                $('#alertaNombre').hide();
                $('#alertaSistema_operativo').hide();
                $('#alertaEspacio_disponible').hide();
                $('#alertaRam').hide();
                $('#alertaProcesador').hide();

                $('#modificarEquipo').removeAttr('action');

                modalModificar.hide();

            });


            var conteo_programas = 0;


            $('#add-nuevoPrograma').click(function() {

                var conteoFilas = programas_tabla.rows().count();

                if (conteoFilas == 0) {
                    conteo_programas = conteo_programas + 1;
                } else {
                    conteo_programas = conteoFilas + 1;
                }

                var nombre_programa = $('#nuevoPrograma').val();

                programas_tabla.row.add([
                    conteo_programas,
                    nombre_programa +
                    `<input type="hidden" name="nuevosProgramas[]" value="${nombre_programa}">`,
                    `<button type="button" class="btn btn-danger eliminarProgramas_update">
                    <i class="fa-solid fa-trash"></i></button>`

                ]).draw(false);

                Swal.fire({
                    title: "Exito",
                    text: "Se ha enlistado el programa",
                    icon: "success"
                });


                $('#nuevoPrograma').val("");

            });


            $('#programasList tbody').on('click', '.eliminarProgramas_update', function() {

                var fila = $(this).closest('tr');

                $('#programasList').DataTable().row(fila).remove().draw(false);

                Swal.fire({
                    title: "Exito",
                    text: "Se ha removido con exito",
                    icon: "success"
                });

            });

        });
    </script>
@endsection
