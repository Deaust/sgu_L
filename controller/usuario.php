<?php
    /* TODO: Llamando Clases */
    require_once("../config/conexion.php");
    require_once("../models/Usuario.php");
    /* TODO: Inicializando clase */
    $usuario = new Usuario();

    switch($_GET["op"]){

        case "guardaryeditar":
            $usuario->insert_usuario(
                $_POST["delegacion_modal"],
                $_POST["departamento_modal"],
                $_POST["cargo_modal"],
                $_POST["nombre_modal"],
                $_POST["expediente_modal"],
                $_POST["usu_id"]
            );

            break;

        case "guardarsistema":
            $usuario->insert_sistema(
                $_POST["usu_id_personal"],
                $_POST["delegacion_sistema"],
                $_POST["nombre_sistema"],
                $_POST["pass_sistema"],
                $_POST["usu_id_in"]
            );
            break;
        case "listar":
            $datos=$usuario->get_usuario();
            $data=Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["ID"];
                $sub_array[] = $row["DELEGACION"];
                $sub_array[] = $row["DEPARTAMENTO"];
                $sub_array[] = $row["PUESTO"];
                $sub_array[] = $row["NOMBRE"];
                $sub_array[] = $row["EXPEDIENTE"];
                $sub_array[] = date("d/m/Y",strtotime($row["FECHA_INGRESO"]));
                $sub_array[] = $row["ESTADO"];
                
                $sub_array[] = '<button type="button" onClick="detalle('.$row["ID"].')" id="'.$row["ID"].'" class="btn btn-warning btn-icon waves-effect waves-light"><i class="ri-edit-2-line"></i></button>';
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
            break;

        case "listar_filtros":
            $datos=$usuario->get_usuario_filtros($_POST["departamento"],$_POST["delegacion"],$_POST["cargo"],$_POST["fech_crea_1"],$_POST["fech_crea_2"],$_POST["inactivos"]);
            $data=Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["ID"];
                $sub_array[] = $row["DELEGACION"];
                $sub_array[] = $row["DEPARTAMENTO"];
                $sub_array[] = $row["PUESTO"];
                $sub_array[] = $row["NOMBRE"];
                $sub_array[] = $row["EXPEDIENTE"];
                $sub_array[] = date("d/m/Y",strtotime($row["FECHA_INGRESO"]));
                if($row["ESTADO"]==0){
                    $sub_array[]='<h4><span class="badge bg-danger">INACTIVO</span></h4>';
                }else{
                    $sub_array[]='<h4><span class="badge bg-success">ACTIVO</span></h4>';
                }
                
                $sub_array[] = '<button type="button" onClick="detalle('.$row["ID"].')" id="'.$row["ID"].'" class="btn btn-warning btn-icon waves-effect waves-light"><i class="ri-edit-2-line"></i></button>';
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
            break;

        case "baja";
            $usuario->delete_usuario($_POST["usu_id"]);
            break;

        case "listar_usuario_detalle":
            $datos=$usuario->get_usuario_x_id($_POST["ID"]);
            $data=Array();
            foreach($datos as $row){
                $output["ID"] = $row["ID"];
                $output["DELEGACION"] = $row["DELEGACION"];
                $output["DEPARTAMENTO"] = $row["DEPARTAMENTO"];
                $output["PUESTO"] = $row["PUESTO"];
                $output["NOMBRE"] = $row["NOMBRE"];
                if($row["ESTADO"]==0){
                    $output["ESTADO"]='<h4><span class="badge bg-danger">INACTIVO</span></h4>';
                }else{
                    $output["ESTADO"]='<h4><span class="badge bg-success">ACTIVO</span></h4>';
                }
                $output["EXPEDIENTE"] = $row["EXPEDIENTE"];
                $output["ALTA"] = date("d/m/Y",strtotime($row["FECHA_INGRESO"]));
            }

            echo json_encode($output);
            break; 

        case "listar_sistemas":
            $datos=$usuario->get_sistemas_x_usuario($_POST["usuario"]);
            $data=Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["USUARIO"];
                $sub_array[] = $row["SISTEMA"];
                $sub_array[] = $row["PASS"];
                $sub_array[] = date("d/m/Y",strtotime($row["FECHA"]));
                $sub_array[] = '<button class="btn btn-primary" type="button" onClick="resguardosistema('.$row["ID"].','.$_POST["usuario"].')" data-bs-toggle="collapse" data-bs-target="#resguardo-'.$row["ID"].'" aria-expanded="false" aria-controls="documentos"><i class=" ri-file-list-line"></i></button>';
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
            break;

        case "listar_resguardos":
            $datos=$usuario->get_sistemas_x_usuario($_POST["ID"]);
            foreach($datos as $row){
                $datos2=$usuario->get_resguardo_x_sistema($row["ID"]);
                foreach($datos2 as $row2) {}          
                    if ( count($datos2)>0){
                        ?>
                        <div class="">
                            <div id="resguardo-<?php echo $row["ID"]; ?>" class="collapse" aria-labelledby="resguardo_acor-<?php echo $row["ID"]; ?>" data-bs-parent="#resguardobody">
                                <div class="accordion-body">
                                    <iframe src="<?php echo Conectar::ruta()?>public/document/resguardos/sistemas/resguardo-<?php echo $row["ID"]; ?>/<?php echo $row2["DOCUMENTO"]; ?>" style="width:100%; height:400px;" frameborder="0" ></iframe>                                   
                                </div>
                            </div>
                        </div>
                    <?php
                    }else{
                        ?>
                        <div class="">
                            <div id="resguardo-<?php echo $row["ID"]; ?>" class="collapse" aria-labelledby="resguardo_acor-<?php echo $row["ID"]; ?>" data-bs-parent="#resguardobody">
                                <div class="accordion-body">
                                    <form method="post" id="resguardo_sistema_form_<?php echo $row["ID"]; ?>">
                                        <h3>Cargar Resguardo</h3>
                                        <div class="row" id="filtros">
                                            <input type="hidden" name="id_sistema" id="id_sistema" value="<?php echo $row["ID"]; ?>"/>
                                            <div class="col-lg-6">
                                                <fieldset class="form-group">
                                                    <label class="form-label semibold" for="exampleInput">Resguardo</label>
                                                    <input type="file" name="fileElem" id="fileElem-<?php echo $row["ID"]; ?>" class="form-control" unique required>
                                                </fieldset>
                                            </div>
                                            <div class="col-lg-2 mb-2">
                                                <div class="form-group">
                                                    <button type="submit" name="action" value="add" class="btn btn-dark mt-4">Guardar</button>
                                                </div>
                                            </div>                                                  
                                        </div>
                                        
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                                 
            }
            break;



    }

?>
