nnh<?php
    require_once("../../config/conexion.php");
    
?>
<!doctype html>
<html lang="es" data-layout="horizontal" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
<head>
    <title>Home | IRCEP - Sistema de Gestión de Usuarios</title>
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
                                    <div class="row">

                                        <div class="col-lg-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h3>Personal</h3>
                                                </div>
                                                <div class="card-header">
                                                    <div class="row" id="filtros">
                                                        <div class="col-lg-2 mb-2">
                                                            <div class="form-group">
                                                                <label class="form-label" for="delegacion">Delegación</label>
                                                                <select class="form-control form-select" id="delegacion" name="delegacion" data-placeholder="Seleccionar">
                                                                    <option label="Seleccionar"></option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 mb-2">
                                                            <div class="form-group">
                                                                <label class="form-label" for="departamento">Departamento</label>
                                                                <select class="form-control form-select" id="departamento" name="departamento" data-placeholder="Seleccionar">
                                                                    <option label="Seleccionar"></option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 mb-2">
                                                            <div class="form-group">
                                                                <label class="form-label" for="cargo">Cargo</label>
                                                                <select class="form-control form-select" id="cargo" name="cargo" data-placeholder="Seleccionar">
                                                                    <option label="Seleccionar"></option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 mb-2">
                                                            <div class="form-group">
                                                                <label class="form-label" for="fech_crea_1">Fecha de Inicio (Alta)</label>
                                                                <input type="date" class="form-control" id="fech_crea_1" name="fech_crea_1">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 mb-2">
                                                            <div class="form-group">
                                                                <label class="form-label" for="fech_crea_2">Fecha de Fin (Alta)</label>
                                                                <input type="date" class="form-control" id="fech_crea_2" name="fech_crea_2" >
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-2 mb-2 mt-2 ">
                                                            <fieldset class="form-group"><br>
                                                                <button type="submit" class="btn btn-rounded btn-primary btn-block" id="btnfiltrar">Filtrar</button>
                                                                <button class="btn btn-rounded btn-primary btn-block" id="btntodo">Ver Todo</button>
                                                            </fieldset>
                                                        </div>
                                                    </div>
                                                    <div class="row " >
                                                        
                                                    </div>
                                                </div>
                                                
                                                <div class="card-header">
                                                    <button type="button" id="btnnuevo" class="btn btn-primary btn-label waves-effect waves-light rounded-pill"><i class="ri-user-smile-line label-icon align-middle rounded-pill fs-16 me-2"></i> Nuevo Registro</button>
                                                    <button type="button" id="btnbaja" class="btn btn-success btn-label waves-effect waves-light rounded-pill"><i class="ri-user-smile-line label-icon align-middle rounded-pill fs-16 me-2"></i> Registrar Baja</button>  
                                                                                                 
                                                </div>


                                                <div class="card-body">
                                                    <div class="form-check form-switch form-switch-lg mb-5" dir="ltr">
                                                        <input type="checkbox" class="form-check-input" id="inactivos" onclick="inactivosfuncion()">
                                                        <label class="form-check-label" for="inactivos">Mostrar Inactivos</label>
                                                    </div>     
                                                    <table id="table_data_personal" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th style="width: 5%;">ID</th>
                                                                <th style="width: 10%;">DELEGACION</th>
                                                                <th style="width: 10%;">DEPARTAMENTO</th>
                                                                <th style="width: 10%;">CARGO</th>
                                                                <th style="width: 20%;">NOMBRE</th>
                                                                <th style="width: 10%;">NUMERO DE<br>EXPEDIENTE</th>
                                                                <th style="width: 10%;">FECHA DE ALTA</th>
                                                                <th style="width: 10%;">ESTADO</th>
                                                                <th style="width: 5%;">DETALLE</th>
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
                    <?php require_once("../html/loader.php"); ?>
                </div>
            </div>
        </div>
        <?php require_once("detalle.php"); ?>
        <?php require_once("mantenimiento.php"); ?>
        <?php require_once("baja.php"); ?>

    </div>
    <?php require_once("../html/js.php"); ?>
    <script type="text/javascript" src="home.js"></script>

</body>

</html>
<?php

?>