<div id="modaldetallesol" class="modal fade bs-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mdltitulosol">xxxxxxx</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">

                <div class="row justify-content-center">

                <?php
                    if ($_SESSION["ROL_ID"] === 3||$_SESSION["ROL_ID"] === 6){
                        ?>
                            
                            <div class="col-xxl-10">
                                <div class="card">
                                    <div class="row g-50">

                                        <div class="col-md-4">
                                            <div class="card-header align-items-center d-flex">
                                            </div>
                                            <div class="card bg-dark shadow-lg card-height-80">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-sm flex-shrink-0">
                                                            <span class="avatar-title bg-soft-light text-white rounded-2 fs-2">
                                                                <i class="ri-bank-card-2-fill"></i>
                                                            </span>
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <p class="text-uppercase fw-medium text-white-50 mb-3" id="tar_numero_info">xxxx-xxxx-xxxx-xxxx</p>
                                                            <h4 class="fs-4 mb-3 text-white" id="tar_saldo_info"><span >$5000</span></h4>
                                                            <p class="text-white-50 mb-0" id="vehi_placa_info">XXXXX</p>
                                                        </div>
                                                    </div>
                                                </div><!-- end card body -->
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            
                                        </div>

                                        <div class="col-md-4" >
                                            <form method="post" id="aut_monto">
                                                
                                            </form>                                                
                                        </div>   

                                    </div>
                                </div><!-- end card -->

                            </div><!-- end col -->
                        <?php
                    }
                ?>

                    

                    
                    
                    <div class="col-xxl-12">
                        <div class="card">
                            <div class="row g-50">

                                <div class="col-md-4">
                                    <div class="card-header align-items-center d-flex">
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="table-responsive table-card">
                                                <table class="table table-ligth align-middle mb-0">
                                                    <tbody>
                                                        <tr>
                                                            <td class="fw-small"><strong>Solicitud No.</strong></td>
                                                            <td><span id="sol_no">135</span> </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-small"><strong>Delegacion</strong></td>
                                                            <td id="del_info">XXXX</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-small"><strong>Usuario Solicitante</strong></td>
                                                            <td id="usu_info">XXXX</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-small"><strong>Placas del Vehiculo</strong></td>
                                                            <td id="placas_info">XXXX</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-small"><strong>Monto Solicitado</strong></td>
                                                            <td id="monto_info">XXXX</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="fw-small"><strong>Monto Autorizado</strong></td>
                                                            <td id="monto_aut_info">XXXX</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <!--end card-body-->
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <div class="card-header align-items-center d-flex">
                                    </div>
                                    <div class="card">                                        
                                        <div class="card-body">
                                            <div class="accordion" id="default-accordion-example">
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingOne">
                                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                            Información Vehicular
                                                        </button>
                                                    </h2>
                                                    <div id="collapseOne" class="accordion-collapse collapse " aria-labelledby="headingOne" data-bs-parent="#default-accordion-example">
                                                        <div class="accordion-body">
                                                            <ul class="list-group">
                                                                <li class="list-group-item" id="marca_info"><i class="mdi mdi-check-bold align-middle lh-1 me-2"></i> XXXXXX</li>
                                                                <li class="list-group-item" id="modelo_info"><i class="mdi mdi-check-bold align-middle lh-1 me-2"></i> XXXXXX</li>
                                                                <li class="list-group-item" id="anno_info"><i class="mdi mdi-check-bold align-middle lh-1 me-2"></i> XXXXXX</li>
                                                                <li class="list-group-item" id="color_info"><i class="mdi mdi-check-bold align-middle lh-1 me-2"></i> XXXXXX</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body" id="imagen">

                                        </div>
                                    </div>
                                </div>

                                
                            </div>
                        </div><!-- end card -->
                    </div><!-- end col -->
                </div><!-- end row -->
                
                

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->