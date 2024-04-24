<?php
    /* TODO: Llamando Clases */
    require_once("../config/conexion.php");
    require_once("../models/Departamento.php");
    /* TODO: Inicializando clase */
    $departamento = new Departamento();

   switch($_GET["op"]){

        case "listado";
        $datos=$departamento->get_departamento();
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