<?php
    /* TODO: Llamando Clases */
    require_once("../config/conexion.php");
    require_once("../models/Asignacion.php");
    /* TODO: Inicializando clase */
    $asignacion = new Asignacion();

    switch($_GET["op"]){

        case "asignacion_usuario":
            $asignacion->asignacion_usuario($_POST["usu_id_asig"],$_POST["vehi_id_usu"]);
            break;

        case "asignacion_delegacion":
            $asignacion->asignacion_delegacion($_POST["del_id_asig"],$_POST["vehi_id_del"]);
            break;

        case "asignacion_tarjeta":
            $asignacion->asignacion_tarjeta($_POST["tar_id_asig"],$_POST["vehi_id_tar"]);
            break;

        /* TODO: Listado de registros formato JSON para Datatable JS */
        case "listar_usu":
            $datos=$asignacion->get_asignacions_usu();
            $data=Array();
            foreach($datos as $row){
                $sub_array = array();
                if($row["VEHI_PLACA"]==NULL){
                    $sub_array[] = '<h4><span class="badge bg-danger">ERROR AL</br>ASIGNAR PLACA</span></h4>';
                }else{
                    $sub_array[] = $row["VEHI_PLACA"];
                }
                if($row["USU_NOM"]==NULL){
                    $sub_array[] = '<h4><span class="badge bg-danger">ERROR AL</br>ASIGNAR USUARIO</span></h4>';
                }else{
                    $sub_array[] = $row["USU_NOM"]." ".$row["USU_APE"];
                }

                $sub_array[] = $row["FECH_CREA"];
                $data[] = $sub_array;

            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
            break;

        case "listar_del":
            $datos=$asignacion->get_asignacions_del();
            $data=Array();
            foreach($datos as $row){
                $sub_array = array();
                if($row["VEHI_PLACA"]==NULL){
                    $sub_array[] = '<h4><span class="badge bg-danger">ERROR AL</br>ASIGNAR PLACA</span></h4>';
                }else{
                    $sub_array[] = $row["VEHI_PLACA"];
                }
                if($row["DEL_NOM"]==NULL){
                    $sub_array[] = '<h4><span class="badge bg-danger">ERROR AL</br>ASIGNAR DELEGACION</span></h4>';
                }else{
                    $sub_array[] = $row["DEL_NOM"];
                }

                $sub_array[] = $row["FECH_CREA"];
                $data[] = $sub_array;

            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
            break;

        case "listar_tar":
            $datos=$asignacion->get_asignacions_tar();
            $data=Array();
            foreach($datos as $row){
                $sub_array = array();
                if($row["VEHI_PLACA"]==NULL){
                    $sub_array[] = '<h4><span class="badge bg-danger">ERROR AL</br>ASIGNAR PLACA</span></h4>';
                }else{
                    $sub_array[] = $row["VEHI_PLACA"];
                }
                if($row["TAR_NOM"]==NULL){
                    $sub_array[] = '<h4><span class="badge bg-danger">ERROR AL</br>ASIGNAR TARJETA</span></h4>';
                }else{
                    $sub_array[] = $row["TAR_NOM"];
                }

                $sub_array[] = $row["FECH_CREA"];
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