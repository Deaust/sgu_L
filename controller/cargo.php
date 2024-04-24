<?php
    /* TODO: Llamando Clases */
    require_once("../config/conexion.php");
    require_once("../models/Cargo.php");
    /* TODO: Inicializando clase */
    $cargo = new Cargo();

   switch($_GET["op"]){

        case "listado";
        $datos=$cargo->get_cargos();
        if(is_array($datos)==true and count($datos)>0){
            $html="";
            $html.="<option value='' selected>Seleccionar</option>";
            foreach($datos as $row){
                $html.= "<option value='".$row["pnId"]."'>".$row["dsNombre"]."</option>";
            }
            echo $html;
            }
            break;
    }
?>