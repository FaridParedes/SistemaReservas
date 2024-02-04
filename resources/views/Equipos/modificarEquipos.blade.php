<!-- The Modal -->
<div class="modal fade" id="modificarEquipos">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="modificarEquipo" method="POST" enctype="multipart/form-data" autocomplete="off">
                @csrf
                @method('PUT')

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Formulario para modificar equipos</h4>
                    <button type="button" class="btn-close cerrarModificar" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-*-12">
                            <div class="row">
                                <div class="col-lg-6 col-sm-12 mt-lg-2">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="nombreUpdate"
                                            placeholder="Ingresar el nombre de un equipo" name="nombreEquipo">
                                        <label for="nombreUpdate">Nombre del equipo</label>
                                    </div>
                                    <div id="alertaNombre" class="alert alert-danger">Debe ingresar un nombre al equipo
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12 mt-lg-2 mt-sm-4">
                                    <div class="form-floating">
                                        <input type="file" class="form-control" id="imgEquipoUpdate"
                                            placeholder="Ingresar el nombre de un equipo" name="imgEquipo">
                                        <input type="hidden" name="fotografia" id="fotografiaUpdate">
                                        <label for="imgEquipoUpdate">Imagen del equipo</label>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12 mt-lg-4 mt-sm-4">
                                    <select class="form-select mb-3" name="sistemaOperativo" id="sl-sistemaOperativos">
                                        @foreach ($sistemasOperativos_list as $valor)
                                            <option value="{{ $valor->idSistemasOperativos }}">{{ $valor->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div id="alertaSistema_operativo" class="alert alert-danger">Debe ingresar el
                                        sistema operativo</div>
                                </div>
                                <div class="col-lg-6 col-sm-12 mt-lg-4 mt-sm-4">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="espacioDisponibleUpdate"
                                            placeholder="Ingresar la cantidad de espacio disponible"
                                            name="espacioDisponible">
                                        <label for="espacioDisponibleUpdate">Espacio disponible</label>
                                    </div>
                                    <div id="alertaEspacio_disponible" class="alert alert-danger">Debe ingresar el
                                        espacio disponible del equipo</div>
                                </div>
                                <div class="col-lg-6 col-sm-12 mt-lg-4 mt-sm-4">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="ramUpdate"
                                            placeholder="Ingresar la cantidad de ram" name="ram">
                                        <label for="ramUpdate">Ram</label>
                                    </div>
                                    <div id="alertaRam" class="alert alert-danger">Debe ingresar la ram del equipo</div>
                                </div>
                                <div class="col-lg-6 col-sm-12 mt-lg-4 mt-sm-4">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="procesadorUpdate"
                                            placeholder="Ingresar el procesador" name="procesador">
                                        <label for="procesadorUpdate">Procesador</label>
                                    </div>
                                    <div id="alertaProcesador" class="alert alert-danger">Debe ingresar el nombre del
                                        procesador</div>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-floating">
                                                <input type="text" placeholder="Ingresar nombre del programa"
                                                    id="nuevoPrograma" class="form-control">
                                                <label for="nuevoPrograma">Nombre del programa</label>
                                            </div>
                                        </div>
                                        <div class="col-auto mt-lg-2">
                                            <button type="button" class="btn btn-success" id="add-nuevoPrograma">
                                                <i class="fa-solid fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-lg-4">
                                    <h3>Listado de programas</h3>
                                </div>
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table id="programasList"
                                            class="table table-secondary align-middle table-hover table-bordered w-100">
                                            <thead>
                                                <th>#</th>
                                                <th>Nombre del Programa</th>
                                                <th>Acciones</th>
                                            </thead>
                                            <tbody class="text-center"></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value="Guardar datos">
                    <button type="button" class="btn btn-danger cerrarModificar"
                        data-bs-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
