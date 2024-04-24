<div id="historico" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="mb-sm-0">Movimientos</h5><br>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>

            <input type="hidden" name="tar_idx" id="tar_idx"/>
            
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <table id="table_data_historico" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                            <thead>
                                <tr>
                                    <th style="width:10%">REF</th>
                                    <th style="width:30%">Tipo</th>
                                    <th style="width:15%">Monto</th>
                                    <th style="width:45%">Fecha</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-sm-0">Traspasos</h5><br>
                        <table id="table_data_traspasos" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                            <thead>
                                <tr>
                                    <th style="width:10%">REF</th>
                                    <th style="width:20%">TIPO</th>
                                    <th style="width:20%">ORIGEN/DESTINO</th>
                                    <th style="width:15%">Monto</th>
                                    <th style="width:35%">Fecha</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>