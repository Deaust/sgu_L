<?php
    /* llamada a las clases necesarias */
    require_once("../config/conexion.php");
    require_once("../models/Email.php");
    $email = new Email();
    require_once("../models/Solicitud.php"); 
    $solicitud = new Solicitud();
    require_once("../models/Comprobacion.php"); 
    $comprobacion = new Comprobacion();

    /* opciones del controlador */
    switch ($_GET["op"]) {
        /*  enviar ticket abierto con el ID */
        case "nueva_solicitud":
            $email->nueva_solicitud($_POST["SOL_ID"]);            
        break;

        case "autorizar_solicitud":
            $datos=$solicitud->listar_autorizacion_correo($_POST["AUT_ID"]);
            foreach($datos as $row){
                $email->solicitud_autorizada_mail($row["SOL_ID"],$row["SOL_MONTO"]);
            };
            echo json_encode ($datos);            
        break;

        case "nueva_comprobacion":
            $email->nueva_comprobacion($_POST["COMP_ID"]);            
        break;

        case "autorizar_comprobacion":
            $email->comprobacion_autorizada_mail($_POST["SOL_ID"]);            
        break;

        case "insert_comentario":
            $datos=$comprobacion->listar_comentario_correo($_POST["COM_ID"]);
            foreach($datos as $row){
                $email->nuevo_comentario_mail($row["DESCRIPCION"],$row["SOL_ID"]);
            };
            echo json_encode ($datos);            
        break;

    }
?>