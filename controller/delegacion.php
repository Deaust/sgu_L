<?php
    /* TODO: Llamando Clases */
    require_once("../config/conexion.php");
    require_once("../models/Delegacion.php");
    /* TODO: Inicializando clase */
    $delegacion = new Delegacion();

    switch($_GET["op"]){
        /* TODO: Guardar y editar, guardar cuando el ID este vacio, y Actualizar cuando se envie el ID */
        case "guardaryeditar":
            if(empty($_POST["del_id"])){
            $delegacion->insert_delegacion($_POST["dir_id"],$_POST["del_nom"]);
            }else{
                $delegacion->update_delegacion($_POST["dir_id"],$_POST["del_id"],$_POST["del_nom"]);
            }
            break;

        /* TODO: Listado de registros formato JSON para Datatable JS */
        case "listar":
            $datos=$delegacion->get_delegaciones();
            $data=Array();
            foreach($datos as $row){
                $sub_array = array();;
                $sub_array[] = $row["DIR_NOM"];
                $sub_array[] = $row["DEL_NOM"];
                $sub_array[] = '<button type="button" onClick="editar('.$row["DEL_ID"].')" id="'.$row["DEL_ID"].'" class="btn btn-warning btn-icon waves-effect waves-light"><i class="ri-edit-2-line"></i></button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["DEL_ID"].')" id="'.$row["DEL_ID"].'" class="btn btn-danger btn-icon waves-effect waves-light"><i class="ri-delete-bin-5-line"></i></button>';
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
            $datos=$delegacion->get_delegacion_det($_POST["DEL_ID"]);
            if (is_array($datos)==true and count($datos)>0){
                foreach($datos as $row){
                    $output["DIR_ID"] = $row["DIR_ID"];
                    $output["DEL_ID"] = $row["DEL_ID"];
                    $output["DEL_NOM"] = $row["DEL_NOM"];
                }
                echo json_encode($output);
            }
            break;

        /* TODO: Cambiar Estado a 0 del Registro */
        case "eliminar";
            $delegacion->delete_delegacion($_POST["del_id"]);
            break;

        /* TODO: Combo con direccion */
        case "combo";
        $datos=$delegacion->get_delegacion_x_direccion($_POST["dir_id"]);
        if(is_array($datos)==true and count($datos)>0){
            $html="";
            $html.="<option value='0' selected>Seleccionar</option>";
            foreach($datos as $row){
                $html.= "<option value='".$row["DEL_ID"]."'>".$row["DEL_NOM"]."</option>";
            }
            echo $html;
            }
            break;

        case "listado";
        $datos=$delegacion->get_delegaciones();
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