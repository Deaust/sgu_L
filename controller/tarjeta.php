<?php
    /* TODO: Llamando Clases */

use JetBrains\PhpStorm\ArrayShape;

    require_once("../config/conexion.php");
    require_once("../models/Tarjeta.php");
    /* TODO: Inicializando clase */
    $tarjeta = new Tarjeta();

    switch($_GET["op"]){
        /* TODO: Guardar y editar, guardar cuando el ID este vacio, y Actualizar cuando se envie el ID */
        case "guardaryeditar":
            $tarjeta->insert_tarjeta($_POST["tar_numero"]);
            break;

        /* TODO: Listado de registros formato JSON para Datatable JS */
        case "listar":
            $datos=$tarjeta->get_tarjetas();
            $data=Array();
            foreach($datos as $row){
                $sub_array = array();;
                $sub_array[] = $row["TAR_NUMERO"];
                $sub_array[] = "$ ".$row["TAR_SALDO"];
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["TAR_ID"].')" id="'.$row["TAR_ID"].'" class="btn btn-danger btn-icon waves-effect waves-light"><i class="ri-delete-bin-5-line"></i></button>';
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
            break;

        /* TODO: Listado de registros formato JSON para Datatable JS */
        case "listar_v":
            $datos=$tarjeta->get_tarjetas_v();
            $data=Array();
            foreach($datos as $row){
                $sub_array = array();
                if($row["TAR_PLACA"]==NULL){
                    $sub_array[] = '<h4><span class="badge bg-warning">SIN VEHICULO ASIGNADO</span></h4>';
                }else{
                    $sub_array[] = $row["TAR_PLACA"];
                }
                $sub_array[] = $row["TAR_NUMERO"];

                $saldo= ($row["SALDO_TARJETA"]);

                $sub_array[] = "$ ".$saldo;
                $sub_array[] = '<button type="button" onClick="historico('.$row["TARJETA"].')" id="'.$row["TARJETA"].'" class="btn btn-info btn-icon waves-effect waves-light"><i class="las la-chart-area"></i></button>';
                $sub_array[] = '<button type="button" onClick="recarga('.$row["TARJETA"].')" id="'.$row["TARJETA"].'" class="btn btn-dark btn-icon waves-effect waves-light"><i class=" ri-increase-decrease-line"></i></button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["TARJETA"].')" id="'.$row["TARJETA"].'" class="btn btn-danger btn-icon waves-effect waves-light"><i class="ri-delete-bin-5-line"></i></button>';
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
            break;

        /* TODO: Listado de registros formato JSON para Datatable JS */
        case "listar_mov":
            $datos=$tarjeta->get_movimientos($_POST["tar_id"]);
            $data=Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = "PCV-MOV-".$row["MOV_ID"];
                if ($row["MOV_TIPO"]==1){
                    $sub_array[] = '<h4><span class="badge bg-success">DEPOSITO</span></h4>';
                }else if ($row["MOV_TIPO"]==2){
                    $sub_array[] = '<h4><span class="badge bg-danger">COMPRA</span></h4>';
                }else if ($row["MOV_TIPO"]==4){
                    $sub_array[] = '<h4><span class="badge bg-warning">BARRIDO MENSUAL</span></h4>';
                }else {
                    $sub_array[] = '<h4><span class="badge bg-warning">NO IDENTIFICADO</span></h4>';
                }

                if ($row["MOV_TIPO"]==1){
                    $sub_array[] = '<h4><span class="badge bg-success">$'.$row["MOV_MONTO"].'</span></h4>';
                }else if ($row["MOV_TIPO"]==2){
                    $sub_array[] = '<h4><span class="badge bg-danger">-$'.$row["MOV_MONTO"].'</span></h4>';
                }else {
                    $sub_array[] = '<h4><span class="badge bg-warning">$'.$row["MOV_MONTO"].'</span></h4>';
                }
                $sub_array[] = date("d/m/Y H:i:s", strtotime($row["FECH_CREA"]));
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
            break;

        case "listar_tras":
            $datos=$tarjeta->get_traspasos($_POST["tar_id"]);
            $data=Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = "PCV-TRAS-".$row["MOV_ID"];
                if($row["TAR_ID"]==$_POST["tar_id"]){
                    $sub_array[] = '<h4><span class="badge bg-danger">ENVIO</span></h4>';
                }else if ($row["TAR_DEST"]==$_POST["tar_id"]){
                    $sub_array[] = '<h4><span class="badge bg-success">RECEPCION</span></h4>';
                }

                if($row["TAR_ID"]==$_POST["tar_id"]){
                    $sub_array[] = '<h4><span class="badge bg-danger">'.$row["DESTINO"].'</span></h4>';
                }else if ($row["TAR_DEST"]==$_POST["tar_id"]){
                    $sub_array[] = '<h4><span class="badge bg-success">'.$row["ORIGEN"].'</span></h4>';
                }

                if($row["TAR_ID"]==$_POST["tar_id"]){
                    $sub_array[] = '<h4><span class="badge bg-danger">-$'.$row["MOV_MONTO"].'</span></h4>';
                }else if ($row["TAR_DEST"]==$_POST["tar_id"]){
                    $sub_array[] = '<h4><span class="badge bg-success">$'.$row["MOV_MONTO"].'</span></h4>';
                }

                $sub_array[] = date("d/m/Y H:i:s", strtotime($row["FECH_CREA"]));
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
            $datos=$tarjeta->get_tarjeta_det($_POST["DEL_ID"]);
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
            $tarjeta->delete_tarjeta($_POST["tar_id"]);
            break;

        /* TODO: Combo con direccion */
        case "combo";
            $datos=$tarjeta->get_tarjeta_x_vehiculo($_POST["dir_id"]);
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
            $datos=$tarjeta->get_tarjetas();
            if(is_array($datos)==true and count($datos)>0){
                $html="";
                $html.="<option value='0' selected>Seleccionar</option>";
                foreach($datos as $row){
                    $html.= "<option value='".$row["TAR_ID"]."'>".$row["TAR_NUMERO"]."</option>";
                }
                echo $html;
                }
                break;

        case "recarga":
            $tarjeta->recarga(
                $_POST["tar_id_re"],
                $_POST["mov_monto_re"]
            );
            break;

        case "gasto":
            $tarjeta->gasto(
                $_POST["TARJETA"],
                $_POST["GASTO"],
                $_POST["SOL_ID"]
            );
            break;
            
        case "traspaso":
            $tarjeta->traspaso(
                $_POST["tar_ori"],
                $_POST["tar_dest"],
                $_POST["mov_monto_trans"]
            );
            break;

        case "barrido":
            $datos=$tarjeta->get_saldo_tarjetas();
            if (is_array($datos)==true and count($datos)>0){
                foreach($datos as $row){
                    $tarjeta->barrido($row["TAR_ID"],$row["SALDO_TARJETA"]);
                };
            }
            break;

        case "insert_barrido":
            $tarjeta->insert_barrido($_POST["Mes"],$_POST["Year"]);
            break;

        case "validacion_barrido":
            $datos=$tarjeta->validacion_barrido($_POST["Mes"],$_POST["Year"]);
            if (is_array($datos)==true and count($datos)>0){
                foreach($datos as $row){
                    $output["BARR_ID"] = $row["BARR_ID"];
                }echo json_encode($output);
                
            }else if(is_array($datos)==true and count($datos)<1) {
                $output["BARR_ID"] = 0; 
                echo json_encode($output);
            };
            break; 
            
        case "validacion_movimientos":
            $datos=$tarjeta->validacion_movimientos();
            foreach($datos as $row){
                if($row["MOV_ID"]===NULL){
                    $tarjeta->gasto(
                        $row["TARJETA"],$row["GASTO"],$row["SOL_ID"]
                    );
                }
            };
            break; 
            
        case "barras":
            $datos=$tarjeta->get_tarjetas_v();
            $data = array();
            foreach($datos as $row){
                $data[]=$row;
            }
            echo json_encode($data);
            break;
            
    }
?>