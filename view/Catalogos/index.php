<?php
    require_once("../../config/conexion.php");
    
?>
<!doctype html>
<html lang="es" data-layout="horizontal" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
<head>
    <title>Catalogos | IRCEP - Sistema de Gestión de Usuarios</title>
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
                                <div class="card-body">
                                    <div class="row card-body">
                                        <div class="card-header">
                                            <h3>Catálogos</h3>
                                        </div>
                                        <div class="col-lg-2 row mt-3" id="activadores">
                                                                                                                                        
                                        </div>

                                        <div class="col-lg-10">
                                            <div class="card">                                                                                               
                                                <div class="row" id="catalogos">
                                                     
                                                </div>
                                            </div>
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
        <?php require_once("../html/loader.php"); ?>

    </div>
    <?php require_once("../html/js.php"); ?>
    <script type="text/javascript" src="catalogos.js"></script>

</body>

</html>
<?php

?>