<div class="modal" id="changeStatus" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmar Problematica</h5>
                <button type="button" class="btn-close close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="POST">
                <div class="modal-body">
                    <div class="d-flex justify-content-center align-items-center">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="problem_id">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label for="tipo_zona">Tipo de Ubicacion</label>
                                    <select name="tipo_zona" id="tipo_zona" class="form-select" required>
                                        <option value="0" selected disabled>Seleccione el tipo de zona</option>
                                        <option value="Comuna">Comuna</option>
                                        <option value="Corregimiento">Corregimiento</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label for="zona" id="label_zona">Comuna/Corregimiento</label>
                                    <select name="zona" id="zona" class="form-select" required>
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger close" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-success">Confirmar</button>
                </div>
            </form>
        </div>
    </div>
</div>