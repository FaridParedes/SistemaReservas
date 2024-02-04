@extends('layouts.app')

@section('title', 'Ingreso de equipos')

@section('content')
    <div class="container">
        @if (session('mensaje'))
            <div class="alert alert-success" id="alertaExito">
                {{ session('mensaje') }}
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="w-100">
                <div class="card">
                    <div class="card-header">
                        Formulario para ingreso de equipos
                    </div>
                    <div class="card-body">
                        <form action="/equipos/store" method="POST" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 col-sm-12 mt-lg-2">
                                    <div class="form-floating">
                                        <input type="text"
                                            class="form-control @error('nombreEquipo') is-invalid @enderror" id="nombre"
                                            placeholder="Ingresar el nombre de un equipo" name="nombreEquipo"
                                            value="{{ old('nombreEquipo') }}">
                                        <label for="nombre">Nombre del equipo<span class="text-danger">*</span></label>
                                    </div>
                                    @error('nombreEquipo')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-6 col-sm-12 mt-lg-2 mt-sm-4">
                                    <div class="form-floating">
                                        <input type="file" class="form-control @error('imgEquipo') is-invalid @enderror"
                                            id="imgEquipo" placeholder="Ingresar el nombre de un equipo" name="imgEquipo"
                                            value="{{ old('imgEquipo') }}">
                                        <label for="imgEquipo">Imagen del equipo<span class="text-danger">*</span></label>
                                    </div>
                                    @error('imgEquipo')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-6 col-sm-12 mt-lg-4 mt-sm-4">
                                    <select class="form-select mb-3 @error('nuevoSistema') d-none @enderror"
                                        name="sistemaOperativo" id="select-sistemasOperativos">
                                        @foreach ($sistemas_operativos as $valor)
                                            @if (old('sistemaOperativo') == $valor)
                                                <option value="{{ $valor->idSistemasOperativos }}" selected>
                                                    {{ $valor->nombre }}
                                                </option>
                                            @else
                                                <option value="{{ $valor->idSistemasOperativos }}">{{ $valor->nombre }}
                                                </option>
                                            @endif
                                        @endforeach
                                        @if (old('sistemaOperativo') == 'nuevo')
                                            <option value="nuevo" selected>Agregar uno nuevo</option>
                                        @else
                                            <option value="nuevo">Agregar uno nuevo</option>
                                        @endif
                                    </select>
                                    <div class="form-floating d-none divNuevo_sistema">
                                        <input type="text" name="nuevoSistema" id="nuevo_sistemaInput"
                                            class="form-control" placeholder="Ingresar el nombre del nuevo sistema"
                                            value="{{ old('nuevoSistema') }}">
                                        <label for="nuevo_sistemaInput">nombre del nuevo sistema <span
                                                class="text-danger">*</span></label>
                                    </div>
                                    @error('sistemaOperativo')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    @error('nuevoSistema')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-6 col-sm-12 mt-lg-4 mt-sm-4">
                                    <div class="form-floating">
                                        <input type="text"
                                            class="form-control @error('espacioDisponible') is-invalid @enderror"
                                            id="espacioDisponible" placeholder="Ingresar la cantidad de espacio disponible"
                                            name="espacioDisponible" value="{{ old('espacioDisponible') }}">
                                        <label for="espacioDisponible">Espacio disponible<span
                                                class="text-danger">*</span></label>
                                    </div>
                                    @error('espacioDisponible')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-6 col-sm-12 mt-lg-4 mt-sm-4">
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('ram') is-invalid @enderror"
                                            id="ram" placeholder="Ingresar la cantidad de ram" name="ram"
                                            value="{{ old('ram') }}">
                                        <label for="ram">Ram<span class="text-danger">*</span></label>
                                    </div>
                                    @error('ram')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-lg-6 col-sm-12 mt-lg-4 mt-sm-4">
                                    <div class="form-floating">
                                        <input type="text" class="form-control @error('procesador') is-invalid @enderror"
                                            id="procesador" placeholder="Ingresar el procesador" name="procesador"
                                            value="{{ old('procesador') }}">
                                        <label for="procesador">Procesador<span class="text-danger">*</span></label>
                                    </div>
                                    @error('procesador')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-lg-12 mt-lg-5">
                                    <h4>Ingreso de programas instalado en el equipo</h4>
                                </div>
                                <div class="col-lg-6 col-sm-12 mt-lg-4 mt-sm-4">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="nombreSoftware"
                                            placeholder="Ingresar el nombre del software"
                                            value="{{ old('nombreSoftware') }}">
                                        <label for="nombreSoftware">Nombre del software <span
                                                class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="col-lg-auto col-sm-auto mt-lg-4">
                                    <button type="button" class="btn btn-primary" id="agregarProgramas"><i
                                            class="fa-solid fa-plus"></i></button>
                                </div>
                                <div class="col-lg-7 col-sm-12 mt-lg-4">
                                    <div class="table-responsive">
                                        <table id="programasIngresados"
                                            class="table table-secondary align-middle table-hover table-bordered w-100">
                                            <thead>
                                                <th>#</th>
                                                <th>Nombre del programa</th>
                                                <th>Acciones</th>
                                            </thead>
                                            <tbody class="text-center">
                                                @if (old('programas') !== null)
                                                    @foreach (old('programas') as $i => $valor)
                                                        <tr>
                                                            <td>{{ $i + 1 }}</td>
                                                            <td>
                                                                {{ $valor }}
                                                                <input type="hidden" name="programas[]"
                                                                    value="{{ $valor }}">
                                                            </td>
                                                            <td>
                                                                <button type="button"
                                                                    class="btn btn-danger eliminarProgramas">
                                                                    <i class="fa-solid fa-trash"></i></button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12 mt-lg4 mt-sm-4">
                                <input type="submit" class="btn btn-success" value="Guardar datos">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="module">
        $(document).ready(function() {

            

            if ($('#select-sistemasOperativos').val() == "nuevo") {
                
                $('.divNuevo_sistema').removeClass('d-none');

                $('#select-sistemasOperativos').addClass('d-none');
                
            }

            $('#alertaExito').fadeOut(2500);


            $('#select-sistemasOperativos').change(function() {

                if ($(this).val() == "nuevo") {

                    $('.divNuevo_sistema').removeClass('d-none');

                } else {

                    $('.divNuevo_sistema').addClass('d-none');

                }

            });


            let programas_tabla = new DataTable('#programasIngresados', {
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

            var conteo_programas = 0;

            $('#agregarProgramas').click(function() {

                var conteoFilas = programas_tabla.rows().count();

                if (conteoFilas == 0) {
                    conteo_programas = conteo_programas + 1;
                } else {
                    conteo_programas = conteoFilas + 1;
                }

                var nombre_programa = $('#nombreSoftware').val();

                programas_tabla.row.add([
                    conteo_programas,
                    nombre_programa +
                    `<input type="hidden" name="programas[]" value="${nombre_programa}">`,
                    `<button type="button" class="btn btn-danger eliminarProgramas">
                        <i class="fa-solid fa-trash"></i></button>`

                ]).draw(false);

                Swal.fire({
                    title: "Exito",
                    text: "Se ha enlistado el programa",
                    icon: "success"
                });


                $('#nombreSoftware').val("");

            });

            $('#programasIngresados tbody').on('click', '.eliminarProgramas', function() {

                var fila = $(this).closest('tr');

                $('#programasIngresados').DataTable().row(fila).remove().draw(false);

                Swal.fire({
                    title: "Exito",
                    text: "Se ha removido con exito",
                    icon: "success"
                });

            });

        });
    </script>
@endsection
