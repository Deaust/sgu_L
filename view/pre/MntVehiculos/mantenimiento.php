<div id="modalmantenimiento" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="lbltitulo"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <form method="post" id="mantenimiento_form">
                <div class="modal-body">
                    <input type="hidden" name="vehi_id_editar" id="vehi_id_editar"/>

                    <div class="row gy-2">
                        <div class="col-md-12">
                            <div>
                                <label for="valueInput" class="form-label">Marca</label>
                                <input type="text" class="form-control" id="vehi_marca" name="vehi_marca" required/>
                            </div>
                        </div>
                    </div><br>
                    <div class="row gy-2">
                        <div class="col-md-12">
                            <div>
                                <label for="valueInput" class="form-label">Modelo</label>
                                <input type="text" class="form-control" id="vehi_tipo" name="vehi_tipo" required/>
                            </div>
                        </div>
                    </div><br>
                    <div class="row gy-2">
                        <div class="col-md-12">
                            <div>
                                <label for="valueInput" class="form-label">Año</label>
                                <input type="number" class="form-control" id="vehi_modelo" name="vehi_modelo" required/>
                            </div>
                        </div>
                    </div><br>
                    <div class="row gy-2">
                        <div class="col-md-12">
                            <div>
                                <label for="valueInput" class="form-label">Placas</label>
                                <input type="text" class="form-control" id="vehi_placas" name="vehi_placas" required/>
                            </div>
                        </div>
                    </div><br>
                    <div class="row gy-2">
                        <div class="col-md-12">
                            <div>
                                <label for="valueInput" class="form-label">Numero de Serie</label>
                                <input type="text" class="form-control" id="vehi_ns" name="vehi_ns" required/>
                            </div>
                        </div>
                    </div><br>
                    <div class="row gy-2">
                        <div class="col-md-12">
                            <div>
                                <label for="valueInput" class="form-label">Color</label>
                                <input type="text" class="form-control" id="vehi_color" name="vehi_color" required/>
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