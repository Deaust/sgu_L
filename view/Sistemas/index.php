<?php
    require_once("../../config/conexion.php");
    
?>
<!doctype html>
<html lang="es" data-layout="horizontal" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
<head>
    <title>Sistemas | IRCEP - Sistema de Gestión de Usuarios</title>
    <?php require_once("../html/head.php"); ?>
</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

        <?php require_once("../html/header.php"); ?>

        <?php require_once("../html/menu.php"); ?>
        <!-- Left Sidebar End -->
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">              
                                
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3>Sistemas</h3>
                                        </div>
                                        
                                        <div class="card-header">
                                            <button type="button" id="btnnuevo" class="btn btn-primary btn-label waves-effect waves-light rounded-pill"><i class="ri-user-smile-line label-icon align-middle rounded-pill fs-16 me-2"></i> Nuevo Registro</button>
                                            <button type="button" id="btnbaja" class="btn btn-success btn-label waves-effect waves-light rounded-pill"><i class="ri-user-smile-line label-icon align-middle rounded-pill fs-16 me-2"></i> Registrar Baja</button>  
                                                                                            
                                        </div>


                                        <div class="card-body">  
                                            <table id="table_data_sistemas" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 5%;">ID</th>
                                                        <th style="width: 10%;">NOMBRE</th>
                                                        <th style="width: 10%;">FECHA DE INGRESO</th>
                                                        <th style="width: 10%;">USUARIO DE INGRESO</th>
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
                </div>
            </div>

                <?php require_once("../html/footer.php"); ?>
        </div>
        <?php require_once("mantenimiento.php"); ?>

    </div>
    <?php require_once("../html/js.php"); ?>
    <script type="text/javascript" src="sistemas.js"></script>

</body>

</html>
<?php

?>