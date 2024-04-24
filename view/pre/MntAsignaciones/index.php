<?php
    require_once("../../config/conexion.php");
    require_once("../../models/Rol.php");
    $rol = new Rol();
    $datos = $rol->validar_acceso_2($_SESSION["USU_ID"]);
    if(isset($_SESSION["USU_ID"])){
        if(is_array($datos) and count($datos)>0){
?>
<!doctype html>
<html lang="es" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
<head>
    <title>Mantenimiento Asignaciones | IRCEP - Sistema de Gestión de Usuarios</title>
    <?php require_once("../html/head.php"); ?>
</head>

<body>

    <div id="layout-wrapper">

        <?php require_once("../html/header.php"); ?>

        <?php require_once("../html/menu.php"); ?>

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">Mantenimiento Asignaciones</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Menu</a></li>
                                        <li class="breadcrumb-item active">Asignaciones</li>
                                    </ol>
                                </div>

                            </div>
                        </div>



                        <!-- <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3>Tajeta a Vehiculo</h3>
                                </div>
                                <div class="card-body">
                                    <table id="table_data_tar" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Placa</th>
                                                <th>Numero de tarjeta</th>
                                                <th>Fecha</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> -->

                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3>Usuario a Vehiculo</h3>
                                </div>
                                <div class="card-body">
                                    <table id="table_data_usu" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Placa</th>
                                                <th>Usuario</th>
                                                <th>Fecha</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3>Vehiculo a Delegacion</h3>
                                </div>
                                <div class="card-body">
                                    <table id="table_data_del" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Placa</th>
                                                <th>Delegacion</th>
                                                <th>Fecha</th>
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

            <?php require_once("../html/footer.php"); ?>
        </div>

    </div>
    <?php require_once("../html/js.php"); ?>
    <script type="text/javascript" src="mntasignaciones.js"></script>
</body>

</html>
<?php
        }else{
            header("Location:".Conectar::ruta()."view/404/");
        }
    }else{
        header("Location:".Conectar::ruta()."view/404/");
    }
?>
