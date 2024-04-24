<div id="traspasos" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="lbltitulo_traspaso"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <form method="post" id="traspasos_form">
                <div class="justify-content-center row modal-body">

                    <div class="col-lg-6">
                        <h6 class="fw-bold">Tarjeta de Origen</h6>
                        <br>
                        <div class="form-group">
                            <label class="form-label" for="tar_ori">Selecionar:</label>
                            <select class="form-control form-select" id="tar_ori" name="tar_ori" data-placeholder="Seleccionar" required>
                            </select>
                        </div>
<!--                         <br>
                        <div class="form-group">
                            <label class="form-label" for="tar_ori_placa">Placa:</label>
                            <input type="text" class="form-control" id="tar_ori_placa"  readonly>
                        </div>
                        <br>
                        <div class="form-group">
                            <label class="form-label" for="tar_ori_saldo">Saldo:</label>
                            <input type="text" class="form-control" id="tar_ori_saldo"  readonly>
                        </div> -->
                    </div>
                    <div class="col-lg-6">
                        <h6 class="fw-bold">Tarjeta Destino</h6>
                        <br>
                        <div class="form-group">
                            <label class="form-label" for="tar_dest">Seleccionar:</label>
                            <select class="form-control form-select" id="tar_dest" name="tar_dest" data-placeholder="Seleccionar" required>
                            </select>
                        </div>
                        <br>
<!--                         <div class="form-group">
                            <label class="form-label" for="tar_dest_saldo">Saldo:</label>
                            <input type="text" class="form-control" id="tar_dest_saldo"  readonly>
                        </div>
                        <br>
                        <div class="form-group">
                            <label class="form-label" for="tar_dest_placa">Placa:</label>
                            <input type="text" class="form-control" id="tar_dest_placa"  readonly>
                        </div> -->
                    </div>

                    <div class="m-t-lg col-lg-6">
                        <br>
                        <label class=" form-label" for="mov_monto_trans">Monto a traspasar:</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" class="form-control" id="mov_monto_trans" name="mov_monto_trans" aria-label="Monto solicitado">
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