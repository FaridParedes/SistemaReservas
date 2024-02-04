<!-- The Modal -->
<div class="modal fade" id="modificarMaterialGastable">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="modificarMaterialesGastables" method="POST" enctype="multipart/form-data" autocomplete="off">
                @csrf
                @method('PUT')

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Formulario para modificar el material gastable</h4>
                    <button type="button" class="btn-close cerrarModificar" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6 col-sm-12 mt-lg-2">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="nombreMaterialUpdate"
                                    placeholder="Ingresar el nombre del material" name="nombre">
                                <label for="nombreMaterialUpdate">Nombre del material</label>
                            </div>
                            <div class="alert alert-danger mensajeMaterial">Se require ingresar el nombre del material
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 mt-lg-2 mt-sm-4 mt-4">
                            <div class="form-floating">
                                <input type="file" class="form-control" id="fotografiaMaterialUpdate"
                                    name="fotografiaUpdate">
                                <label for="fotografiaMaterialUpdate">Imagen del material</label>
                            </div>
                            <input type="hidden" name="fotografia" id="fotografiaIngresada">
                        </div>
                        <div class="col-lg-6 col-sm-12 mt-lg-4 mt-sm-4 mt-4">
                            <div class="form-floating">
                                <textarea name="descripcion" id="descripcionMaterialUpdate" class="form-control"
                                    placeholder="Ingresar la descripcion del material" cols="30" rows="10" value="{{ old('marca') }}"></textarea>
                                <label for="descripcionMaterial">Descripcion del Material</label>
                            </div>
                            <div class="alert alert-danger mensajeDescripcion">Se require ingresar la descripcion del
                                material</div>
                        </div>
                        <div class="col-lg-6 col-sm-12 mt-lg-4 mt-sm-4 mt-4">
                            <div class="row">
                                <div class="col-12">
                                    <select name="idTipos_cantidades" class="form-select p-3"
                                        aria-label="cantidad selectida determinada" id="tiposCantidadesUpdate">
                                        <option value="" selected>Seleccionar el tipo de cantidad del material
                                        </option>
                                        @foreach ($tiposCantidades as $valor)
                                            <option value="{{ $valor->idTipos_cantidades }}">{{ $valor->tipo }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="alert alert-danger mensajeTipo_cantidad">Se require seleccionar el tipo de cantidad del
                                        material</div>
                                </div>
                                <div class="col-lg-12 mt-4">
                                    <div class="form-floating">
                                        <input type="number" class="form-control" id="stockMaterialUpdate"
                                            placeholder="Ingresar el cantidad del material" min="0"
                                            step="0.01" name="stock">
                                        <label for="stockMaterialUpdate">Cantidad del material</label>
                                    </div>
                                    <div class="alert alert-danger mensajeStock">Se require ingresar el stock del
                                        material</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <input type="submit" class="btn btn-success" value="Modificar datos">
                    <button type="button" class="btn btn-danger cerrarModificar"
                        data-bs-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
