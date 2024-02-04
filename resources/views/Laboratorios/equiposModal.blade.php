<div class="modal fade" id="equiposModalList">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Listado de equipos</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body" style="overflow: scroll; height: 430px;">
                <div class="row">
                    <div class="col-lg-12 mt-4">
                        <div class="table-responsive mt-3">
                            <table id="equiposModal-tabla"
                                class="table align-middle table-secondary table-hover">
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
                                                <img src="{{ asset('storage/equipos/' . $valor->fotografia) }}"
                                                    width="150px" height="100px" alt="imagen del equipo">
                                                <input type="hidden" name="nuevoEquipos[]" value="{{ $valor->idEquipos }}">
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
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger"
                    data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
