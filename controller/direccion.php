<?php
    /* TODO: Llamando Clases */
    require_once("../config/conexion.php");
    require_once("../models/Direccion.php");
    /* TODO: Inicializando clase */
    $direccion = new Direccion();

    switch($_GET["op"]){
        /* TODO: Guardar y editar, guardar cuando el ID este vacio, y Actualizar cuando se envie el ID */
        case "guardaryeditar":
            if(empty($_POST["dir_id"])){
                $direccion->insert_direccion($_POST["dir_nom"]);
            }else{
                $direccion->update_direccion($_POST["dir_id"],$_POST["dir_nom"]);
            }
            break;

        /* TODO: Listado de registros formato JSON para Datatable JS */
        case "listar":
            $datos=$direccion->get_direcciones();
            $data=Array();
            foreach($datos as $row){
                $sub_array = array();;
                $sub_array[] = $row["DIR_NOM"];
                $sub_array[] = '<button type="button" onClick="editar('.$row["DIR_ID"].')" id="'.$row["DIR_ID"].'" class="btn btn-warning btn-icon waves-effect waves-light"><i class="ri-edit-2-line"></i></button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["DIR_ID"].')" id="'.$row["DIR_ID"].'" class="btn btn-danger btn-icon waves-effect waves-light"><i class="ri-delete-bin-5-line"></i></button>';
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
            break;

        /* TODO:Mostrar informacion de registro segun su ID */
        case "mostrar":
            $datos=$direccion->get_direccion_det($_POST["DIR_ID"]);
            if (is_array($datos)==true and count($datos)>0){
                foreach($datos as $row){
                    $output["DIR_ID"] = $row["DIR_ID"];
                    $output["DIR_NOM"] = $row["DIR_NOM"];
                }
                echo json_encode($output);
            }
            break;

        /* TODO: Cambiar Estado a 0 del Registro */
        case "eliminar";
            $direccion->delete_direccion($_POST["dir_id"]);
            break;

            
        /* TODO: Listar las Direcciones */
        case "listado";
        $datos=$direccion->get_direcciones();
        if(is_array($datos)==true and count($datos)>0){
            $html="";
            $html.="<option value='0' selected>Seleccionar</option>";
            foreach($datos as $row){
                $html.= "<option value='".$row["DIR_ID"]."'>".$row["DIR_NOM"]."</option>";
            }
            echo $html;
            }
            break;
    }
?>