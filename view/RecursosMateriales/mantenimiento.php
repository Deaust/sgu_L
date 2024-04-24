<div id="mantenimiento" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="lbltitulo"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <form method="post" id="mantenimiento_form">
                <div class="modal-body">
                    <input type="hidden" name="usu_id" id="usu_id"/>

                    <div class="form-group">
                        <label class="form-label" for="delegacion_modal">Delegación</label>
                        <select class="form-control form-select" id="delegacion_modal" name="delegacion_modal" data-placeholder="Seleccionar" required>

                        </select>
                    </div><br>

                    <div class="form-group">
                        <label class="form-label" for="departamento_modal">Departamento</label>
                        <select class="form-control form-select" id="departamento_modal" name="departamento_modal" data-placeholder="Seleccionar" required>

                        </select>
                    </div><br>

                    <div class="form-group">
                        <label class="form-label" for="cargo_modal">Cargo</label>
                        <select class="form-control form-select" id="cargo_modal" name="cargo_modal" data-placeholder="Seleccionar" required>

                        </select>
                    </div><br>

                    <div class="row gy-2">
                        <div class="col-md-12">
                            <div>
                                <label for="valueInput" class="form-label">Nombre Completo</label>
                                <input type="text" class="form-control" id="nombre_modal" name="nombre_modal" required/>
                            </div>
                        </div>
                    </div><br>

                    <div class="row gy-2">
                        <div class="col-md-12">
                            <div>
                                <label for="valueInput" class="form-label">Número de Expediente</label>
                                <input type="number" class="form-control" id="expediente_modal" name="expediente_modal" required/>
                            </div>
                        </div>
                    </div><br>
                    
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" name="action" value="add" class="btn btn-primary ">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>