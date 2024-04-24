<?php
    require_once("../../config/conexion.php");
    require_once("../../models/Rol.php");
    $rol = new Rol();
    $datos = $rol->validar_acceso_3($_SESSION["USU_ID"]);
    if(isset($_SESSION["USU_ID"])){
        if(is_array($datos) and count($datos)>0){
?>
<!doctype html>
<html lang="es" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
<head>
    <title>Consultar Solicitudes | IRCEP - Sistema de Gestión de Usuarios</title>
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
                                <h4 class="mb-sm-0">Consultar Solicitudes</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Menu</a></li>
                                        <li class="breadcrumb-item active">Solicitudes</li>
                                    </ol>
                                </div>

                            </div>
                        </div>

                        <?php
                        $c=$_SESSION["ROL_ID"];
                            if ($c=== 1 ||$c=== 4){
                                ?>
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <table id="data_table_1" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                        <th style="width: 5%;">Id</th>
                                                        <th style="width: 20%;">Fecha de Solicitud</th>
                                                        <th style="width: 15%;">Monto solicitado</th>
                                                        <th style="width: 25%;">Placa</th>
                                                        <th style="width: 15%;">Estatus</th>                                            
                                                        <th class="text-center" style="width: 5%;"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                <?php
                            }else if ($c=== 2){
                                ?>
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <table id="data_table_2" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                        <th style="width: 5%;">Id</th>
                                                        <th style="width: 20%;">Usuario</th>
                                                        <th style="width: 10%;">Fecha de Solicitud</th>
                                                        <th style="width: 10%;">Monto solicitado</th>
                                                        <th style="width: 10%;">Placa</th>   
                                                        <th style="width: 15%;">Estatus</th>                                     
                                                        <th class="text-center" style="width: 5%;"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                <?php
                            }else if ($c=== 8){
                                ?>
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <table id="data_table_3" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                        <th style="width: 5%;">Id</th>
                                                        <th style="width: 15%;">Nivel 2</th>
                                                        <th style="width: 20%;">Usuario</th>
                                                        <th style="width: 10%;">Fecha de Solicitud</th>
                                                        <th style="width: 10%;">Monto solicitado</th>
                                                        <th style="width: 10%;">Placa</th>    
                                                        <th style="width: 15%;">Estatus</th>                                           
                                                        <th class="text-center" style="width: 5%;"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                <?php
                            }else if ($c=== 6||$c===7||$c===3){
                                ?>

                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <table id="data_table_4" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                        <th style="width: 5%;">Id</th>
                                                        <th style="width: 15%;">Nivel 1</th>
                                                        <th style="width: 15%;">Nivel 2</th>
                                                        <th style="width: 20%;">Usuario</th>
                                                        <th style="width: 10%;">Fecha de Solicitud</th>
                                                        <th style="width: 10%;">Monto solicitado</th>
                                                        <th style="width: 10%;">Placa</th>   
                                                        <th style="width: 15%;">Estatus</th>                                            
                                                        <th class="text-center" style="width: 5%;"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                            }
                        ?>
                    </div>
                </div>
            </div>

            <?php require_once("../html/footer.php"); ?>
        </div>
        <?php require_once("modaldetallesol.php"); ?>

    </div>
    <?php require_once("../html/js.php"); ?>
    <script type="text/javascript" src="consultarsolicitudes.js"></script>
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
