<div id="modalasignardel" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mdltitulodel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <form method="post" id="asig_form_del">
                <div class="modal-body">
                    <input type="hidden" id="vehi_id_del" name="vehi_id_del">

                    <div class="form-group">
                        <label class="form-label" for="dir_id_asig">Direccion</label>
                        <select class="form-control form-select" id="dir_id_asig_tar" name="dir_id_asig_tar" required>

                        </select>
                    </div><br>

                    <div class="form-group">
                        <div class="col-lg-12">
                            <label class="form-label semibold" for="valueInput">Delegación</label>
                            <select class="form-control form-select" id="del_id_asig" name="del_id_asig" data-placeholder="Seleccionar" required></select>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <!-- Rounded Buttons -->
                    <button type="reset" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" name="action" value="add" id="#" class="btn btn-primary ">Asignar</button>
                </div>
            </form>
        </div>
    </div>
</div>