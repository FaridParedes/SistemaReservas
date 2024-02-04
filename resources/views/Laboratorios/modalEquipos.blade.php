<!-- The Modal -->
<div class="modal fade" id="modalEquipos">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Equipos</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="row table-responsive">
                    <div>
                        <div>
                            <table id="tablaEquipos" class="table align-middle table-hover table-secondary">
                                <thead>
                                    <tr>
                                        <th>Imagen</th>
                                        <th>Nombre equipo</th>
                                        <th>sistema operativo</th>
                                        <th>espacio disponible</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @foreach ($equipos as $valor)
                                        <tr>
                                            <td>
                                                <img src="{{ asset('storage/equipos/' . $valor->fotografia) }}" width="150px"
                                                    alt="">
                                                <input type="hidden" name="idEquipos[]" value="{{ $valor->idEquipos }}">
                                            </td>
                                            <td>{{ $valor->nombre }}</td>
                                            <td>{{ $valor->sistema_operativo }}</td>
                                            <td>{{ $valor->espacio_disponible }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <script type="module">
                    $(document).ready(function() {

                        let listado_equipos = new DataTable("#tablaEquipos", {
                            language: {
                                "emptyTable": "No hay datos disponibles por el momento",
                                "info": "Mostrando _START_ de _END_ teniendo _TOTAL_ datos",
                                "infoEmpty": "Mostrando 0 de 0 a 0 datos",
                                "infoFiltered": "(Filtrando from _MAX_ total datos)",
                                "lengthMenu": "Mostrar _MENU_ datos",
                                "loadingRecords": "Cargando...",
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

                        listado_equipos.on('click', 'tbody tr', function() {
                            let data = listado_equipos.row(this).data();

                            $('#equipos').DataTable().row.add([
                                data[0],
                                data[1],
                                data[2],
                                data[3],
                                '<button class="btn btn-danger btnEliminar2">Eliminar</button>'
                            ]).draw(false);

                            listado_equipos.row(this).remove().draw(false);

                            Swal.fire({
                                title: "Exito",
                                text: "Se ha agregado el equipo con exito",
                                icon: "success"
                            });
                        });

                    });
                </script>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
            </div>

        </div>
    </div>
</div>
