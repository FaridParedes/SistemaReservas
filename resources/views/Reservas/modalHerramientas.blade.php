<!-- The Modal -->
<div class="modal fade" id="modalHerramientas">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Herramientas</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="row table-responsive">
                    <div class="col-*-12">
                        <div>
                            <table id="tablaHerramientas" class="table table-hover table-bordered table-secondary"
                                style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>Imagen</th>
                                        <th>Nombre de la herramienta</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($herramientas as $valor)
                                        <tr>
                                            <td>
                                                <img src="{{ asset('storage/herramientas/' . $valor->fotografia) }}"
                                                    width="150px" alt="imagen de la herramienta" height="100px">
                                                <input type="hidden" name="idHerramientas[]"
                                                    value="{{ $valor->idHerramientas }}">
                                            </td>
                                            <td>{{ $valor->nombre }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <script type="module">
                    $(document).ready(function() {

                        let listado_herramientas = new DataTable("#tablaHerramientas", {
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

                        listado_herramientas.on('click', 'tbody tr', function() {
                            let data = listado_herramientas.row(this).data();

                            $('#herramientas').DataTable().row.add([
                                data[0],
                                data[1],
                                '<input class="form-control" type="number" name="cantidadHerramientas[]" value="1">',
                                '<button class="btn btn-danger btnEliminar">Eliminar</button>'
                            ]).draw(false);

                            listado_herramientas.row(this).remove().draw(false);

                            Swal.fire({
                                title: "Exito",
                                text: "Se ha agregado la herramienta al listado",
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
