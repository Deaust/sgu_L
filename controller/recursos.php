<?php
    /* TODO: Llamando Clases */
    require_once("../config/conexion.php");
    require_once("../models/Recurso.php");
    /* TODO: Inicializando clase */
    $recurso = new Recurso();

    switch($_GET["op"]){

        case "listar";
            $datos=$recurso->listar_recurso();
            $data= Array();
                foreach($datos as $row){
                    $sub_array = array();
                    $sub_array[] = $row["ID"];
                    $sub_array[] = $row["MARCA"];
                    $sub_array[] = $row["COLOR"];
                    $sub_array[] = $row["MATERIAL"];
                    $sub_array[] = $row["PROVEEDOR"];
                    $sub_array[] = $row["TIPOBIEN"];
                    $sub_array[] = $row["EDOFISICO"];
                    $sub_array[] = $row["ESTATUS"];
                    $sub_array[] = $row["SERIE"];                    
                    $sub_array[] = $row["MODELO"];
                    $sub_array[] = $row["DESCRIPCION"];
                    $sub_array[] = $row["NOTALON"];
                    $sub_array[] = $row["NOCHEQUE"];
                    $sub_array[] = date("d/m/Y",strtotime($row["FECHA"]));
                    $data[] = $sub_array;
                
                }
                $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
                echo json_encode($results);
            break;

    }

?>
