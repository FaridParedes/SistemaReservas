@extends('layouts.app')

@section('title', 'Materiales Gastables')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="row justify-content-center">
                    <div class="col-lg-6 text-center rounded-pill p-3 bg-success text-light">
                        <span class="h3">Materiales Gastables</span>
                    </div>
                </div>
                @if (session('mensajeMaterialGastable1'))
                    <div class="alert alert-success mt-4 mensajeExito">
                        {{ session('mensajeMaterialGastable1') }}
                    </div>
                @endif
                @if (session('mensajeMaterialGastable2'))
                    <div class="alert alert-success mt-4 mensajeExito">
                        {{ session('mensajeMaterialGastable2') }}
                    </div>
                @endif
            </div>
            <div class="col-lg-12 mt-4">
                <a href="/materialGastable/ingreso" class="btn btn-success">Ingresar un nuevo material</a>
            </div>
            <div class="col-12 col-lg-12 col-sm-12 mt-4">
                <div class="table-responsive">
                    <table id="materialGastableList" class="table align-middle table-secondary table-hover table-bordered">
                        <thead class="table-dark">
                            <th>Imagen</th>
                            <th>Nombre del material</th>
                            <th>Descripcion del material</th>
                            <th>Cantidad</th>
                            <th>Fecha de ingreso</th>
                            <th>Acciones</th>
                        </thead>
                        <tbody>
                            @foreach ($consulta_materialGastable as $valor)
                                <tr class="text-center">
                                    <td>
                                        <img src="{{ asset('storage/materialesGastables/' . $valor->fotografia) }}"
                                            width="150px" height="100px" alt="Imagen del material">
                                        <input type="hidden" class="fotografiaMaterialGastable"
                                            value="{{ $valor->fotografia }}">
                                        <input type="hidden" class="idMaterialGastable"
                                            value="{{ $valor->idMaterialGastable }}">
                                    </td>
                                    <td>{{ $valor->nombre }}</td>
                                    <td>{{ $valor->descripcion }}</td>
                                    <td>
                                        {{ $valor->stock }} {{ $valor->tipo }}
                                        <input type="hidden" class="stockGet" value="{{ $valor->stock }}">
                                        <input type="hidden" class="tipoCantidad"
                                            value="{{ $valor->idTipos_cantidades }}">
                                    </td>
                                    <td>{{ $valor->created_at }}</td>
                                    <td>
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
    @include('/MaterialGastable/modificarMaterialGastable')
    <script type="module">
        $(document).ready(function() {

            $('.mensajeExito').fadeOut(2500);

            $('.mensajeMaterial').hide();
            $('.mensajeDescripcion').hide();
            $('.mensajeStock').hide();

            var tabla_materialGastable = new DataTable('#materialGastableList', {
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


            var modificarMaterialGastable = new bootstrap.Modal(document.getElementById(
                'modificarMaterialGastable'));

            $('#materialGastableList tbody').on('click', '.btnModificar', function() {

                var fila = $(this).closest('tr');

                var imagen = fila.find('.fotografiaMaterialGastable').val();
                var idMaterialGastable = fila.find('.idMaterialGastable').val();
                var idTipos_cantidades = fila.find('.tipoCantidad').val();
                var stock = fila.find('.stockGet').val();

                var datos_fila = tabla_materialGastable.row(fila).data();


                $('#fotografiaIngresada').val(imagen);
                $('#nombreMaterialUpdate').val(datos_fila[1]);
                $('#descripcionMaterialUpdate').val(datos_fila[2]);
                $('#tiposCantidadesUpdate').val(idTipos_cantidades);
                $('#stockMaterialUpdate').val(stock);

                if ($('#tiposCantidadesUpdate').val() != "") {

                    $('.mensajeTipo_cantidad').hide();

                } else {

                    $('.mensajeTipo_cantidad').show();

                }

                $('#modificarMaterialesGastables').attr('action',
                    `/materialGastable/update/${idMaterialGastable}`);

                modificarMaterialGastable.show();

            });

            $('#nombreMaterialUpdate').keyup(function() {

                if ($(this).val() == "") {

                    $('.mensajeMaterial').show();

                } else {

                    $('.mensajeMaterial').hide();

                }

            });

            $('#descripcionMaterialUpdate').keyup(function() {

                if ($(this).val() == "") {

                    $('.mensajeDescripcion').show();

                } else {

                    $('.mensajeDescripcion').hide();

                }

            });

            $('#tiposCantidadesUpdate').change(function() {

                if ($(this).val() == "") {

                    $('.mensajeTipo_cantidad').show();

                } else {

                    $('.mensajeTipo_cantidad').hide();

                }

            });

            $('#stockMaterialUpdate').keyup(function() {

                if ($(this).val() == "") {

                    $('.mensajeStock').show();

                } else {

                    $('.mensajeStock').hide();

                }

            });


            $('.cerrarModificar').click(function() {

                $('#nombreMaterialUpdate').val("");
                $('#descripcionMaterialUpdate').val("");
                $('#stockMaterialUpdate').val("");
                $('#fotografiaIngresada').val("");

                $('.mensajeMaterial').hide();
                $('.mensajeDescripcion').hide();
                $('.mensajeStock').hide();

                $('#modificarMaterialesGastables').removeAttr('action');

                modificarMaterialGastable.hide();

            });


        });
    </script>
@endsection
