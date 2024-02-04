<div class="modal fade" id="materialModalList">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Listado de Materiales Gastables</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body" style="overflow: scroll; height: 430px;">
                <div class="row">
                    <div class="col-lg-12 mt-4">
                        <div class="table-responsive mt-3">
                            <table id="materialesModal-tabla"
                                class="table align-middle table-secondary table-bordered table-hover">
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
                                                    width="150px" height="100px" alt="imagen de la herramienta">
                                                <input type="hidden" name="nuevoMateriales[]"
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
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
