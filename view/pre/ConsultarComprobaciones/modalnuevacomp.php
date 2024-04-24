<div id="modalnuevacomp" class="modal fade bs-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mdltitulonueva">xxxxxxx</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">

                <div class="row justify-content-center">

                

                <?php
                    if ($_SESSION["ROL_ID"] === 1||$_SESSION["ROL_ID"] === 6){
                        ?>
                            
                            <div class="card-body">
                                <form class="row gy-4" method="post" id="comprobacion_form">

                                    <input type="hidden" id="sol_idX" name="sol_idX">


                                    <div class="col-lg-3">
                                        <label class="form-label" for="km_i">Km Inicial</label>
                                        <input type="number" class="form-control" id="km_i" name="km_i" required/>
                                    </div>

                                    <div class="col-lg-3">
                                        <label class="form-label" for="km_f">Km Final</label>
                                        <input type="number" class="form-control" id="km_f" name="km_f" required/>
                                    </div>

                                    <div class="col-lg-6">
                                        <label class="form-label" for="no_ticket">No. Ticket</label>
                                        <input type="text" class="form-control" id="no_ticket" name="no_ticket" required/>
                                    </div>

                                    <div class="col-lg-3">
                                        <label class="form-label" for="precio_gas">Precio gas Por Litro</label>
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input type="number" step="0.01" class="form-control" id="precio_gas" name="precio_gas" aria-label="Monto solicitado" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <label class="form-label" for="tipo_gas">Tipo de Gasolina</label>
                                        <input type="text" class="form-control" id="tipo_gas" name="tipo_gas" required/>
                                    </div>

                                    <div class="col-lg-3">
                                        <label class="form-label" for="litros_cargados">Litros Cargados</label>
                                        <input type="number" step="0.01" class="form-control" id="litros_cargados" name="litros_cargados" required/>
                                    </div>

                                    <div class="col-lg-3">
                                        <label class="form-label" for="fech_carga">Fecha de Carga</label>
                                        <input type="date" class="form-control" id="fech_carga" name="fech_carga" required/>
                                    </div>

                                    <!-- FOTOGRAFIAS -->

                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label class="form-label semibold" for="exampleInput">Tarjeta de Circulación</label>
                                            <input type="file" name="tarjeta" id="tarjeta" class="form-control" unique>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label class="form-label semibold" for="exampleInput">Camioneta</label>
                                            <input type="file" name="camioneta" id="camioneta" class="form-control" unique>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label class="form-label semibold" for="exampleInput">Ticket Bomba</label>
                                            <input type="file" name="bomba" id="bomba" class="form-control" unique>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label class="form-label semibold" for="exampleInput">Ticket Compra</label>
                                            <input type="file" name="compra" id="compra" class="form-control" unique>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label class="form-label semibold" for="exampleInput">Odometro Inicial</label>
                                            <input type="file" name="odo_i" id="odo_i" class="form-control" unique>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label class="form-label semibold" for="exampleInput">Odometro Final</label>
                                            <input type="file" name="odo_f" id="odo_f" class="form-control" unique>
                                        </fieldset>
                                    </div>
                                    <div class="col-lg-4">
                                        <fieldset class="form-group">
                                            <label class="form-label semibold" for="exampleInput">Placa</label>
                                            <input type="file" name="placa" id="placa" class="form-control" unique>
                                        </fieldset>
                                    </div>

                                    <div class="col-lg-12">
                                        <button type="submit" name="action" value="add" class="btn btn-primary ">Guardar</button>
                                    </div>
                                </form>
                            </div>

                        <?php
                    }
                ?>               
                

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->