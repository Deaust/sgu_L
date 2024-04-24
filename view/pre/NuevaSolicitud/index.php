<?php
    require_once("../../config/conexion.php");
    require_once("../../models/Rol.php");
    $rol = new Rol();
    $datos = $rol->validar_acceso_1($_SESSION["USU_ID"]);
    if(isset($_SESSION["USU_ID"])){
        if(is_array($datos) and count($datos)>0){
?>
<!DOCTYPE html>
<html lang="es" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
<head>
    <title>Nueva Solicitud | IRCEP - Sistema de Gestión de Usuarios</title>
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
                            <h4 class="mb-sm-0">Nueva Solicitud</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Menu</a></li>
                                    <li class="breadcrumb-item active">Nueva Solicitud</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="box-typical box-typical-padding">
				<p>
					Desde esta ventana podra generar una nueva solicitud de combustible.
				</p>

                <div class="card">

                    
                    
                    <div class="card-header align-items-center d-flex">
                        <h5 class="m-t-lg with-border">Ingresar Información</h5>          
                    </div>

                    <div class="card-body">
                        <form class="row gy-4" method="post" id="solicitud_form">

                            <input type="hidden" id="usu_idX" name="usu_idX" value="<?php echo $_SESSION["USU_ID"] ?>">

                            <input type="hidden" id="usu_id" name="usu_id" >

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label" for="del_id">Delegación</label>
                                    <select class="form-control form-select" id="del_id" name="del_id" required disabled>

                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label" for="vehi_id">Placa</label>
                                    <select class="form-control form-select" id="vehi_id" name="vehi_id" data-placeholder="Seleccionar" required>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <label class="form-label" for="sol_monto">Monto Solicitado</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="text" class="form-control" id="sol_monto" name="sol_monto" aria-label="Monto solicitado" required>
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <fieldset class="form-group">
                                    <label class="form-label semibold" for="exampleInput">Fotografia georeferencia da de Odometro</label>
                                    <input type="file" name="fileElem" id="fileElem" class="form-control" unique>
                                </fieldset>
                            </div>

                            <div class="col-lg-12">
                                <button type="submit" name="action" value="add" class="btn btn-primary ">Guardar</button>
                            </div>
                        </form>
                    </div>

                </div>

			</div>

            </div>
        </div>

        <?php require_once("../html/footer.php"); ?>
    </div>

</div>

    <?php require_once("../html/js.php"); ?>

    <script type="text/javascript" src="nuevasolicitud.js"></script>

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
