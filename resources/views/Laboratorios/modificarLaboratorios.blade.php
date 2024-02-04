<!-- The Modal -->
<div class="modal fade" id="modificarLaboratorios">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form id="updateLaboratorios" method="POST" enctype="multipart/form-data" autocomplete="off">
                @csrf
                @method('PUT')

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Formulario para modificar el laboratorio</h4>
                    <button type="button" class="btn-close cerrarModificar-Laboratorio"
                        data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body" style="overflow: scroll; height: 430px;">
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <div class="form-floating">
                                <input type="text" name="nombreLaboratorio"
                                    placeholder="Ingresar nombre del laboratorio" class="form-control" id="nombreLab-update">
                                <label for="nombreLab-update">Nombre del laboratorio</label>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12 mt-lg-0 mt-4">
                            <div class="form-floating">
                                <input type="text" placeholder="Ingresar Descripcion" name="descripcion"
                                    class="form-control" id="descripcionLab-update">
                                <label for="descripcionLab-update">Descripcion</label>
                            </div>
                        </div>
                        <div class="col-lg-7 col-12 mt-lg-4 mt-4">
                            <div class="form-floating">
                                <input type="file" placeholder="Seleccionar imagen" name="fotografiaUpdate"
                                    class="form-control" id="imgLab">
                                <label for="imgLab">Imagen del laboratorio</label>
                            </div>
                            <input type="hidden" name="fotografia" id="imgLaboratorios-update">
                        </div>
                        <div class="col-lg-12 mt-4">
                            <button type="button" class="btn btn-success materialesLaboratorios">
                                <i class="fa-solid fa-plus"></i>
                            </button>
                            <div class="table-responsive mt-3">
                                <table id="materiales-laboratorios" class="table align-middle table-secondary table-hover">
                                    <thead>
                                        <tr>
                                            <th>Imagen</th>
                                            <th>Nombre del material</th>
                                            <th>Descripcion</th>
                                            <th>Cantidad</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-12 mt-4">
                            <button type="button" class="btn btn-success herramientasLaboratorios">
                                <i class="fa-solid fa-plus"></i>
                            </button>
                            <div class="table-responsive mt-3">
                                <table id="herramientas-laboratorios" class="table align-middle table-secondary table-hover">
                                    <thead>
                                        <tr>
                                            <th>Imagen</th>
                                            <th>Nombre de la herramienta</th>
                                            <th>Descripcion</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-12 mt-lg-4">
                            <button type="button" class="btn btn-success equiposLaboratorios">
                                <i class="fa-solid fa-plus"></i>
                            </button>
                            <div class="table-responsive mt-3">
                                <table id="equipos-laboratorios" class="table align-middle table-secondary table-hover">
                                    <thead>
                                        <tr>
                                            <th>Imagen</th>
                                            <th>Nombre equipo</th>
                                            <th>sistema operativo</th>
                                            <th>espacio disponible</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value="Modificar datos">
                    <button type="button" class="btn btn-danger cerrarModificar-Laboratorio"
                        data-bs-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
