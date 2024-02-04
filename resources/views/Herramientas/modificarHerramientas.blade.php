<!-- The Modal -->
<div class="modal fade" id="modificarHerramientas">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="modificarHerramienta" method="POST" enctype="multipart/form-data" autocomplete="off">
                @csrf
                @method('PUT')

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Formulario para modificar herramientas</h4>
                    <button type="button" class="btn-close cerrarModificar" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6 col-sm-12 mt-lg-2">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('nombre') is-invalid @enderror"
                                    id="nombreUpdate" placeholder="Ingresar el nombre de un herramienta" name="nombre">
                                <label for="nombre">Nombre de la herramienta<span class="text-danger">*</span></label>
                            </div>
                            @error('nombre')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-6 col-sm-12 mt-lg-2 mt-sm-4 mt-3">
                            <div class="form-floating">
                                <input type="file" class="form-control @error('imgHerramienta') is-invalid @enderror"
                                    id="imgHerramienta" name="imgHerramienta">
                                <label for="imgHerramienta">Imagen de la herramienta<span
                                        class="text-danger">*</span></label>
                                <input type="hidden" name="fotoHerramienta" id="fotoHerramienta">
                            </div>
                            @error('imgHerramienta')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-6 col-sm-12 mt-lg-4 mt-sm-4 mt-3">
                            <div class="form-floating">
                                <textarea name="descripcion"
                                class="form-control @error('descripcion') is-invalid @enderror" 
                                placeholder="Ingresar una descripcion de la herramienta"
                                id="descripcionMod" cols="30" rows="10"></textarea>
                                <label for="descripcionMod">Descripcion de la herramienta<span class="text-danger">*</span></label>
                            </div>
                            @error('descripcion')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-6 col-sm-12 mt-lg-4 mt-sm-4 mt-3">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('marca') is-invalid @enderror"
                                    id="inputMarcaUpdate" placeholder="Ingresar el nombre de la marca" name="marca">
                                <label for="inputMarca">Marca<span class="text-danger">*</span></label>
                            </div>
                            @error('marca')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-6 col-sm-12 mt-lg-4 mt-sm-4 mt-3">
                            <div class="form-floating">
                                <input type="number" name="stockUpdate" id="stock_update"
                                class="form-control @error('stockUpdate') is-invalid @enderror"
                                placeholder="Ingresar el stock de la herramienta">
                                <label for="stock_update">Stock de la herramienta <span class="text-danger">*</span></label>
                            </div>
                            @error('stockUpdate')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
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
