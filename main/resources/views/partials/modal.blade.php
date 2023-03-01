<!-- Modal -->

<div class="modal fade" id="fileModal" tabindex="-1" role="dialog" aria-labelledby="fileModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="fileModalUpLabel">Importar Listado de capacitacion
                </h5> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span
                        aria-hidden="true">&times;
                    </span> </button>
            </div>
            <form action="" method="post" enctype="multipart/form-data"> {{ csrf_field() }} <div
                    class="modal-body">

                    <div class="col-12">
                        <label for="candidato_id" class="form-label">Candidato</label>
                        <select class="form-control" name="candidato_id" id="candidato_id" required></select>
                        <div class="invalid-feedback">
                            Este campo es requerido.
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="creador" class="form-label">Quien lo diligencia</label>
                        <select class="form-control" name="creador" id="creador" required
                            @if (Auth::user()->hasRole('simple')) disabled @endif>
                            @if (Auth::user()->hasRole('simple'))
                                <option value="{{ Auth::user()->id }}">{{ Auth::user()->name }}</option>
                            @else
                                <option value=""></option>
                            @endif
                        </select>
                        <div class="invalid-feedback">
                            Este campo es requerido.
                        </div>
                    </div>

                    <input type="file" class="custom-up" name="file" id="fileUp">
                </div>
                <div class="modal-footer"> <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar
                    </button>
                    <button type="submit" class="btn btn-success">Eviar</button>
                </div>
            </form>
        </div>
    </div>
</div>
