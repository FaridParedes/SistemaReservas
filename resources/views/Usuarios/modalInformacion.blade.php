<div class="modal fade" id="modalInformacion">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Cambiar Información</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form method="POST" action="/cuenta/update/{{$usuario->id}}">
                @csrf
                <div class="modal-body row g-3">
                        
                        <div class="col-md-6">
                            <label class="form-label">Nombre</label>
                            <input name="name" type="text" class="form-control" value="{{$usuario->name}}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input name="email" type="email" class="form-control" value="{{$usuario->email}}">
                        </div>
                </div>
                
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Guardar</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </form>

        </div>
    </div>
</div>