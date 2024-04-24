<?php
    /* TODO: Llamando Clases */

use JetBrains\PhpStorm\ArrayShape;

    require_once("../config/conexion.php");
    require_once("../models/Grafico.php");
    /* TODO: Inicializando clase */
    $grafico = new Grafico();

    switch($_GET["op"]){
        /* TODO: Guardar y editar, guardar cuando el ID este vacio, y Actualizar cuando se envie el ID */
        case "gasto_x_usuario":
            $datos=$grafico->gasto_x_usuario($_POST["Mes"]+1);
            $data = array();
            foreach($datos as $row){
                $data[]=$row;
            }
            echo json_encode($data);
            break;
    }
?>