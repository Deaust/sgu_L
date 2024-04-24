<div id="recargas" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="lbltitulo_recarga"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <form method="post" id="recargas_form">
                <div class="modal-body">

                    <input type="hidden" id="tar_id_re" name="tar_id_re">

                    <div class="col-lg-12">
                        <label class="form-label" for="mov_monto_re">Monto Autorizado</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" class="form-control" id="mov_monto_re" name="mov_monto_re" aria-label="Monto solicitado">
                            <span class="input-group-text">.00</span>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" name="action" value="add" class="btn btn-primary ">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>