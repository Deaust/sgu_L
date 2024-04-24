<?php
    /* TODO: Llamando Clases */
    require_once("../config/conexion.php");
    require_once("../models/Sistema.php");
    /* TODO: Inicializando clase */
    $sistema = new Sistema();

    switch($_GET["op"]){
        case "listado";
            $datos=$sistema->get_sistemas();
            if(is_array($datos)==true and count($datos)>0){
                $html="";
                $html.="<option value='' selected>Seleccionar</option>";
                foreach($datos as $row){
                    $html.= "<option value='".$row["ID"]."'>".$row["NOMBRE"]."</option>";
                }
                echo $html;
                }
            break;

        case "listar";
            $datos=$sistema->listar_sistemas();
            $data= Array();
                foreach($datos as $row){
                    $sub_array = array();
                    $sub_array[] = $row["ID"];
                    $sub_array[] = $row["NOMBRE"];
                    $sub_array[] = date("d/m/Y",strtotime($row["FECHA"]));
                    $sub_array[] = $row["USUARIO"];
                    $data[] = $sub_array;
                
                }
                $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
                echo json_encode($results);
            break;
        case "guardaryeditar":
            $sistema->insert_sistema(
                $_POST["nombre"],
                $_POST["usu_id"]
                
            );

            break;
    }

?>
