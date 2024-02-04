@extends('layouts.app')

@section('title', 'Listado de herramientas')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="row justify-content-center">
                    <div class="col-lg-6 text-center rounded-pill p-3 bg-success text-light">
                        <span class="h3">Herramientas</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 mt-4">
                <a href="/herramientas/ingreso" class="btn btn-success">Ingresar un nueva herramienta</a>
            </div>
            <div class="col-12 col-lg-12 col-sm-12 mt-lg-4 mt-4">
                <div class="table-responsive">
                    <table id="herramientasList" class="table table-secondary align-middle table-hover table-bordered">
                        <thead class="table-dark">
                            <th>Imagen</th>
                            <th>Nombre de la herramienta</th>
                            <th>Detalles de la herramienta</th>
                            <th>Fecha de ingreso</th>
                            <th>Acciones</th>
                        </thead>
                        <tbody>
                            @foreach ($consulta_herramientas as $valor)
                                <tr>
                                    <td class="text-center">
                                        <img src="{{ asset('storage/herramientas/' . $valor->fotografia) }}" width="150px"
                                            alt="imagen de la herramienta" height="100px">
                                        <input type="hidden" class="fotografiaHerramienta"
                                            value="{{ $valor->fotografia }}">
                                        <input type="hidden" class="idHerramientas" value="{{ $valor->idHerramientas }}">
                                    </td>
                                    <td class="text-center">{{ $valor->nombre }}</td>
                                    <td>
                                        <p>
                                            <input type="hidden" class="marcaHerra" value="{{ $valor->marca }}">
                                            <input type="hidden" class="stockHerra" value="{{ $valor->stock }}">
                                            <input type="hidden" class="descripcionHerra"
                                                value="{{ $valor->descripcion }}">
                                            <b>Marca: </b>{{ $valor->marca }}
                                            <br><br>
                                            <b>Descripcion: </b>{{ $valor->descripcion }}
                                        </p>
                                    </td>
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
    @include('/herramientas/modificarHerramientas')
    <script type="module">
        $(document).ready(function() {

            var herramientas_tabla = new DataTable('#herramientasList', {
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


            var modificarHerramienta = new bootstrap.Modal(document.getElementById('modificarHerramientas'));

            $('#herramientasList tbody').on('click', '.btnModificar', function() {

                var fila = $(this).closest('tr');

                var imagen = fila.find('.fotografiaHerramienta').val();
                var idHerramienta = fila.find('.idHerramientas').val();
                var marcaHerra = fila.find('.marcaHerra').val();
                var descripcionHerra = fila.find('.descripcionHerra').val();
                var stockHerra = fila.find('.stockHerra').val();

                var datos_fila = herramientas_tabla.row(fila).data();


                $('#fotoHerramienta').val(imagen);
                $('#nombreUpdate').val(datos_fila[1]);
                $('#descripcionMod').val(descripcionHerra);
                $('#inputMarcaUpdate').val(marcaHerra);
                $('#stock_update').val(stockHerra);

                $('#modificarHerramienta').attr('action', `/herramientas/update/${idHerramienta}`);

                modificarHerramienta.show();

            });

        });
    </script>
@endsection
