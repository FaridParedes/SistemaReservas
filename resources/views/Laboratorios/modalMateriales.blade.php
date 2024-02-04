<!-- The Modal -->
<div class="modal fade" id="modalMateriales">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Materiales Gastables</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="row table-responsive">
                    <div class="col-*-12">
                        <div>
                            <table id="tablaMateriales" class="table align-middle table-hover table-bordered table-secondary"
                                style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>Imagen</th>
                                        <th>Nombre del material</th>
                                        <th>Descripcion</th>
                                        <th>Cantidad</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @foreach ($materialGastable as $valor)
                                        <tr>
                                            <td>
                                                <img src="{{ asset('storage/materialesGastables/' . $valor->fotografia) }}"
                                                    width="150px" alt="imagen del material" height="100px">
                                                <input type="hidden" name="idMaterialGastable[]"
                                                    value="{{ $valor->idMaterialGastable }}">
                                            </td>
                                            <td>{{ $valor->nombre }}</td>
                                            <td>{{ $valor->descripcion }}</td>
                                            <td>{{ $valor->stock }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <script type="module">
                    $(document).ready(function() {

                        let material_gastable = new DataTable("#tablaMateriales", {
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

                        material_gastable.on('click', 'tbody tr', function() {
                            let data = material_gastable.row(this).data();

                            $('#materiales').DataTable().row.add([
                                data[0],
                                data[1],
                                data[2],
                                data[3],
                                '<button class="btn btn-danger btnEliminar3">Eliminar</button>'
                            ]).draw(false);

                            material_gastable.row(this).remove().draw(false);

                            Swal.fire({
                                title: "Exito",
                                text: "Se ha agregado el material al listado",
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
