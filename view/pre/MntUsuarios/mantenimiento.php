<div id="modalmantenimiento" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
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
                        <label class="form-label" for="dir_id">Direccion</label>
                        <select class="form-control form-select" id="dir_id" name="dir_id" data-placeholder="Seleccionar" required>

                        </select>
                    </div><br>

                    <div class="form-group">
                        <label class="form-label" for="del_id">Delegacion</label>
                        <select class="form-control form-select" id="del_id" name="del_id" data-placeholder="Seleccionar" required>

                        </select>
                    </div><br>

                    <div class="row gy-2">
                        <div class="col-md-12">
                            <div>
                                <label for="valueInput" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="usu_nom" name="usu_nom" required/>
                            </div>
                        </div>
                    </div><br>

                    <div class="row gy-2">
                        <div class="col-md-12">
                            <div>
                                <label for="valueInput" class="form-label">Apellido</label>
                                <input type="text" class="form-control" id="usu_ape" name="usu_ape" required/>
                            </div>
                        </div>
                    </div><br>

                    <div class="form-group">
                        <label class="form-label" for="rol_id">Rol</label>
                        <select class="form-control form-select" id="rol_id" name="rol_id" required>
                            <option value="0">Selecionar</option>
                            <option value="1">Solicitante</option>
                            <option value="2">Consultor General</option>
                            <option value="7">Consultor Direcciones|</option>
                            <option value="8">Consultor Delegaciones</option>
                            <option value="3">Autorizador</option>
                            <option value="4">Bloqueado</option>
                            <option value="5">Mantenimiento</option>
                            <option value="6">SuperUsuario</option>

                        </select>
                    </div><br>
                    
                    <div class="row gy-2">
                        <div class="col-md-12">
                            <div>
                                <label for="valueInput" class="form-label">Correo Electronico</label>
                                <input type="email" class="form-control" id="usu_correo" name="usu_correo" required/>
                            </div>
                        </div>
                    </div><br>
                    
                    <div class="row gy-2">
                        <div class="col-md-12">
                            <div>
                                <label for="valueInput" class="form-label">Contraseña</label>
                                <input type="text" class="form-control" id="usu_pass" name="usu_pass" required/>
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