<div id="detalle" class="modal fade bs-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mdltitulosol">xxxxxxx</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">

                <div class="row justify-content-center">
         
                    <!-- Base Example -->
                    <div class="accordion custom-accordionwithicon custom-accordion-border accordion-border-box accordion-primary" id="default-accordion-example">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Detalle
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#default-accordion-example">
                                <div class="accordion-body">
                                    <table class="table table-ligth align-middle mb-0">
                                        <tbody>
                                            <tr>
                                                <td class="fw-small"><strong>Nombre de Usuario</strong></td>
                                                <td><span id="nombre_detalle">XXXX</span> </td>
                                            </tr>
                                            <tr>
                                                <td class="fw-small"><strong>Delegacion</strong></td>
                                                <td id="delegacion_detalle">XXXX</td>
                                            </tr>
                                            <tr>
                                                <td class="fw-small"><strong>Departamento</strong></td>
                                                <td id="departamento_detalle">XXXX</td>
                                            </tr>
                                            <tr>
                                                <td class="fw-small"><strong>Número de Expediente</strong></td>
                                                <td id="expediente_detalle">XXXX</td>
                                            </tr>
                                            <tr>
                                                <td class="fw-small"><strong>Estado</strong></td>
                                                <td id="estado_detalle">XXXX</td>
                                            </tr>
                                            <tr>
                                                <td class="fw-small"><strong>Fecha de Alta</strong></td>
                                                <td id="alta_detalle">XXXX</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="accordionnestingaccordionnesting">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Usuarios
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#default-accordion-example">
                                <div class="accordion-body">
                                    <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#nuevo" aria-expanded="false" aria-controls="imagenes">
                                        Nuevo Registro
                                    </button>
                                </div>
                            
                                <div class="collapse" id="nuevo" data-bs-parent="#imagenes">
                                    <div class="card mb-0">
                                        <div class="card-body">

                                            <form method="post" id="sistema_form">
                                                <div class="row" id="filtros">
                                                    <input type="hidden" name="usu_id_in" id="usu_id_in"/>
                                                    <input type="hidden" name="usu_id_personal" id="usu_id_personal"/>
                                                    <div class="col-lg-2 mb-2">
                                                        <div class="form-group">
                                                            <label class="form-label" for="delegacion_sistema">Sistema</label>
                                                            <select class="form-control form-select" id="delegacion_sistema" name="delegacion_sistema" data-placeholder="Seleccionar">
                                                                <option label="Seleccionar"></option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 mb-2">
                                                        <div class="form-group">
                                                            <label for="valueInput" class="form-label">Usuario</label>
                                                            <input type="text" class="form-control" id="nombre_sistema" name="nombre_sistema" required/>
                                                        </div>
                                                    </div>   
                                                    <div class="col-lg-2 mb-2">
                                                        <div class="form-group">
                                                            <label for="valueInput" class="form-label">Contraseña</label>
                                                            <input type="text" class="form-control" id="pass_sistema" name="pass_sistema" required/>
                                                        </div>
                                                    </div>   
                                                    <div class="col-lg-2 mb-2">
                                                        <div class="form-group">
                                                            <button type="submit" name="action" value="add" class="btn btn-dark mt-4">Guardar</button>
                                                        </div>
                                                    </div>                                                  
                                                </div>
                                                
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div id="resguardobody">
                                    
                                </div>                              

                                <div class="card-body">   
                                    <table id="table_sistemas" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th style="width: 10%;">SISTEMA</th>
                                                <th style="width: 10%;">USUARIO</th>
                                                <th style="width: 10%;">CONTRASEÑA</th>
                                                <th style="width: 10%;">FECHA DE CREACIÓN</th>
                                                <th style="width: 5%;">RESGUARDO</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Equipo de Computo
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#default-accordion-example">
                                <div class="accordion-body">
                                Now that you have a general idea of the amount of texts you will need per month, simply find a plan size that allows you to have this allotment, plus some extra for growth. Don't worry, there are no mistakes to be made here. You can always upgrade and downgrade.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Mobiliario
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#default-accordion-example">
                                <div class="accordion-body">
                                Now that you have a general idea of the amount of texts you will need per month, simply find a plan size that allows you to have this allotment, plus some extra for growth. Don't worry, there are no mistakes to be made here. You can always upgrade and downgrade.
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- end row -->
                
                

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->