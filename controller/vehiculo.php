<?php
    /* TODO: Llamando Clases */
    require_once("../config/conexion.php");
    require_once("../models/Vehiculo.php");
    /* TODO: Inicializando clase */
    $vehiculo = new Vehiculo();

    switch($_GET["op"]){
        /* TODO: Guardar y editar, guardar cuando el ID este vacio, y Actualizar cuando se envie el ID */
        case "guardaryeditar":
            if(empty($_POST["vehi_id_editar"])){
                $vehiculo->insert_vehiculo(
                    $_POST["vehi_marca"], 
                    $_POST["vehi_tipo"], 
                    $_POST["vehi_modelo"],
                    $_POST["vehi_placas"], 
                    $_POST["vehi_ns"],
                    $_POST["vehi_color"]
                );
            }else{
                $vehiculo->update_vehiculo(
                    $_POST["vehi_id_editar"],
                    $_POST["vehi_marca"], 
                    $_POST["vehi_tipo"], 
                    $_POST["vehi_modelo"],
                    $_POST["vehi_placas"], 
                    $_POST["vehi_ns"],
                    $_POST["vehi_color"]
                );
            }
            break;

            

        /* TODO: Listado de registros formato JSON para Datatable JS */
        case "listar":
            $datos=$vehiculo->get_vehiculo();
            $data=Array();
            foreach($datos as $row){
                $sub_array = array();
                if($row["DEL_ID"]==0){
                    $sub_array[]='<h4><a type="button" onClick="asignardel('.$row["VEHI_ID"].')" id="'.$row["VEHI_ID"].'" class="badge bg-warning"><span>SIN ASIGNAR</span></a></h4>';

                }else{
                    $sub_array[] = '<h4><a type="button" onClick="asignardel('.$row["VEHI_ID"].')" id="'.$row["VEHI_ID"].'" class="badge bg-success"><span>'.$row["DEL_NOM"].'</span></a></h4>';
                }
                $sub_array[] = $row["VEHI_MARCA"];
                $sub_array[] = $row["VEHI_TIPO"]." ".$row["VEHI_MODELO"];
                $sub_array[] = $row["VEHI_PLACAS"];
                if($row["TAR_ID"]==0){
                    $sub_array[]='<h4><span class="badge bg-warning">SIN ASIGNAR</span></h4>';

                }else{
                    $sub_array[] = '<h4><span class="badge bg-success">'.$row["TAR_NUM"].'</span></h4>';
                }
                if($row["USU_ID"]==0){
                    $sub_array[]='<h4><a type="button" onClick="asignarusu('.$row["VEHI_ID"].')" id="'.$row["VEHI_ID"].'" class="badge bg-warning"><span>SIN ASIGNAR</span></a></h4>';

                }else{
                    $sub_array[] = '<h4><a type="button" onClick="asignarusu('.$row["VEHI_ID"].')" id="'.$row["VEHI_ID"].'" class="badge bg-success"><span>'.$row["USU_NOM"]." ".$row["USU_APE"].'</span></a></h4>';
                }
                
                $sub_array[] = '<button type="button" onClick="editar('.$row["VEHI_ID"].')" id="'.$row["VEHI_ID"].'" class="btn btn-warning btn-icon waves-effect waves-light"><i class="ri-edit-2-line"></i></button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["VEHI_ID"].')" id="'.$row["VEHI_ID"].'" class="btn btn-danger btn-icon waves-effect waves-light"><i class="ri-delete-bin-5-line"></i></button>';
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
            break;

        /* TODO: Cambiar Estado a 0 del Registro */
        case "eliminar";
            $vehiculo->delete_vehiculo($_POST["VEHI_ID"]);
            break;

        case "asignacion_usuario":
            $vehiculo->asignacion_usuario(
                $_POST["usu_id_asig"],
                $_POST["vehi_id_usu"]
            );
            break;
        case "asignacion_delegacion":
            $vehiculo->asignacion_delegacion(
                $_POST["del_id_asig"],
                $_POST["vehi_id_del"]
            );
            break;

        case "asignacion_tarjeta":
            $vehiculo->asignacion_tarjeta(
                $_POST["tar_id_asig"],
                $_POST["vehi_id_tar"]
            );
            break;
        
        /* TODO:Mostrar informacion de registro segun su ID */
        case "mostrar":
            $datos=$vehiculo->get_vehiculo_x_vehi_id($_POST["VEHI_ID"]);
            if (is_array($datos)==true and count($datos)>0){
                foreach($datos as $row){
                    $output["VEHI_ID"] = $row["VEHI_ID"];
                    $output["VEHI_MARCA"] = $row["VEHI_MARCA"];
                    $output["VEHI_TIPO"] = $row["VEHI_TIPO"];
                    $output["VEHI_MODELO"] = $row["VEHI_MODELO"];
                    $output["VEHI_PLACAS"] = $row["VEHI_PLACAS"];
                    $output["VEHI_NS"] = $row["VEHI_NS"];
                    $output["VEHI_COLOR"] = $row["VEHI_COLOR"];
                }
                echo json_encode($output);
            }
            break;

        case "mostrar_placa":
            $datos=$vehiculo->get_placa_x_usu($_POST["USU_ID"]);
            if(is_array($datos)==true and count($datos)>0){
                $html="";
                $html.="<option value='0' selected>Seleccionar</option>";
                foreach($datos as $row){
                    $html.= "<option value='".$row["VEHI_ID"]."'>".$row["VEHI_PLACAS"]."</option>";
                }
                echo $html;
                
                
            }
            break;


    }

?>
