<?php
    require_once("../config/conexion.php");
    require_once("../models/Solicitud.php"); 
    $solicitud = new Solicitud();
    require_once("../models/Documento.php");
    $documento = new Documento();
    require_once("../models/Email.php");
    $email = new Email();

    switch($_GET["op"]){

        case "insert":
            $datos=$solicitud->insert_solicitud($_POST["usu_id"],$_POST["vehi_id"],$_POST["sol_monto"]);
            if (is_array($datos)==true and count($datos)>0){
                foreach ($datos as $row){
                    $output["SOL_ID"] = $row["SOL_ID"];

                    if (empty($_FILES['files']['name'])){

                    }else{
                        $countfiles = count($_FILES['files']['name']);
                        $ruta = "../public/document/solicitudes/solicitud-".$output["SOL_ID"]."/";
                        $files_arr = array();

                        if (!file_exists($ruta)) {
                            mkdir($ruta, 0777, true);
                        }

                        for ($index = 0; $index < $countfiles; $index++) {
                            $doc1 = $_FILES['files']['tmp_name'][$index];
                            $destino = $ruta.$_FILES['files']['name'][$index];

                            $documento->insert_documento( $output["SOL_ID"],$_FILES['files']['name'][$index]);
                            

                            move_uploaded_file($doc1,$destino);
                        }
                    } 
                }
            }
            echo json_encode($datos);
            break;

        case "insert_s":
            $datos=$solicitud->insert_solicitud_s($_POST["usu_id"],$_POST["vehi_id"],$_POST["sol_monto"]);
            if (is_array($datos)==true and count($datos)>0){
                foreach ($datos as $row){
                    $output["SOL_ID"] = $row["SOL_ID"];

                    if (empty($_FILES['files']['name'])){

                    }else{
                        $countfiles = count($_FILES['files']['name']);
                        $ruta = "../public/document/solicitudes/solicitud-".$output["SOL_ID"]."/";
                        $files_arr = array();

                        if (!file_exists($ruta)) {
                            mkdir($ruta, 0777, true);
                        }

                        for ($index = 0; $index < $countfiles; $index++) {
                            $doc1 = $_FILES['files']['tmp_name'][$index];
                            $destino = $ruta.$_FILES['files']['name'][$index];

                            $documento->insert_documento( $output["SOL_ID"],$_FILES['files']['name'][$index]);

                            move_uploaded_file($doc1,$destino);
                        }
                    }
                }
            }
            echo json_encode($datos);
            break;
        case "autorizacion":
            $datos=$solicitud->insert_autorizacion($_POST["sol_idX"],$_POST["monto_autorizado"]); 
            if (is_array($datos)==true and count($datos)>0){
                foreach ($datos as $row){
                    $output["AUT_ID"] = $row["AUT_ID"];
                }
            }
            echo json_encode($datos);        
            break;

        case "solicitud_autorizada":
            $solicitud->actualizar_autorizacion($_POST["SOL_ID"]);
            break;

        case "listar_1":
            $datos=$solicitud->listar_solicitud_1($_POST["USU_ID"]);
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["SOL_ID"];
                $sub_array[] = date("d/m/Y",strtotime($row["FECH_CREA"]));
                $sub_array[] = "$".$row["SOL_MONTO"];

                $sub_array[] = $row["PLACAS"];

                if( $row["AUT_ID"]==0){
                    $sub_array[] = '<h4><span class="badge bg-warning">PENDIENTE</span></h4>';
                }else if ($row["AUT_ID"]==1){
                    $sub_array[] = '<h4><span class="badge bg-success">AUTORIZADA</span></h4>';
                }else{
                    $sub_array[] = '<h4><span class="badge bg-danger">ERROR</span></h4>';
                };

                $sub_array[] = '<button type="button" onClick="detalle('.$row["SOL_ID"].')" id="'.$row["SOL_ID"].'" class="btn btn-success btn-icon waves-effect waves-light"><i class="  ri-chat-4-line"></i></button>';
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
            break;

        case "listar_2":
            $datos=$solicitud->listar_solicitud_2($_POST["DEL_ID"]);
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["SOL_ID"];
                $sub_array[] = $row["USUARIO"];
                $sub_array[] = date("d/m/Y",strtotime($row["FECH_CREA"]));
                $sub_array[] = "$".$row["SOL_MONTO"];

                $sub_array[] = $row["PLACAS"];

                if( $row["AUT_ID"]==0){
                    $sub_array[] = '<h4><span class="badge bg-warning">PENDIENTE</span></h4>';
                }else if ($row["AUT_ID"]==1){
                    $sub_array[] = '<h4><span class="badge bg-success">AUTORIZADA</span></h4>';
                }else{
                    $sub_array[] = '<h4><span class="badge bg-danger">ERROR</span></h4>';
                };

                $sub_array[] = '<button type="button" onClick="detalle('.$row["SOL_ID"].')" id="'.$row["SOL_ID"].'" class="btn btn-success btn-icon waves-effect waves-light"><i class="  ri-chat-4-line"></i></button>';
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
            break;

        case "listar_3":
            $datos=$solicitud->listar_solicitud_3($_POST["DIR_ID"]);
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["SOL_ID"];
                $sub_array[] = $row["DELEGACION"];
                $sub_array[] = $row["USUARIO"];
                $sub_array[] = date("d/m/Y",strtotime($row["FECH_CREA"]));
                $sub_array[] = "$".$row["SOL_MONTO"];

                $sub_array[] = $row["PLACAS"];

                if( $row["AUT_ID"]==0){
                    $sub_array[] = '<h4><span class="badge bg-warning">PENDIENTE</span></h4>';
                }else if ($row["AUT_ID"]==1){
                    $sub_array[] = '<h4><span class="badge bg-success">AUTORIZADA</span></h4>';
                }else{
                    $sub_array[] = '<h4><span class="badge bg-danger">ERROR</span></h4>';
                };

                $sub_array[] = '<button type="button" onClick="detalle('.$row["SOL_ID"].')" id="'.$row["SOL_ID"].'" class="btn btn-success btn-icon waves-effect waves-light"><i class="  ri-chat-4-line"></i></button>';
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
            break;

        case "listar_4":
            $datos=$solicitud->listar_solicitud_4();
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["SOL_ID"];
                $sub_array[] = $row["DIRECCION"];
                $sub_array[] = $row["DELEGACION"];
                $sub_array[] = $row["USUARIO"];
                $sub_array[] = date("d/m/Y",strtotime($row["FECH_CREA"]));
                $sub_array[] = "$".$row["SOL_MONTO"];

                $sub_array[] = $row["PLACAS"];

                if( $row["AUT_ID"]==0){
                    $sub_array[] = '<h4><span class="badge bg-warning">PENDIENTE</span></h4>';
                }else if ($row["AUT_ID"]==1){
                    $sub_array[] = '<h4><span class="badge bg-success">AUTORIZADA</span></h4>';
                }else{
                    $sub_array[] = '<h4><span class="badge bg-danger">ERROR</span></h4>';
                };

                $sub_array[] = '<button type="button" onClick="detalle('.$row["SOL_ID"].')" id="'.$row["SOL_ID"].'" class="btn btn-success btn-icon waves-effect waves-light"><i class="  ri-chat-4-line"></i></button>';
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
            break;

        
        
        case "listar_sol_det":
            $datos=$solicitud->listar_solicitud_detalle($_POST["SOL_ID"]);
            if (is_array($datos)==true and count($datos)>0){
                foreach($datos as $row){
                    $output["DELEGACION"] = $row["DELEGACION"];
                    $output["USUARIO"] = $row["USUARIO"];
                    $output["SOL_MONTO"] = "$".$row["SOL_MONTO"];
                    $output["TARJETA_ID"] = $row["TAR_ID"];
                    $output["TARJETA"] = $row["TARJETA"];
                    $output["PLACAS"] = $row["PLACAS"];
                    $output["SALDO_TARJETA"] = "$".$row["SALDO_TARJETA"];
                    $output["SOL_NO"] = $row["SOL_ID"];
                    $output["SOL_ID"] = $row["SOL_ID"];
                    $output["MARCA"] = $row["MARCA"];
                    $output["MODELO"] = $row["MODELO"];
                    $output["AÑO"] = $row["AÑO"];
                    $output["COLOR"] = $row["COLOR"];
                    $output["NS"] = $row["NS"];
                    if($row["MONTO_AUTORIZADO"]==0){
                        $output["MONTO_AUTORIZADO"]='<h4><span class="badge bg-warning">Pendiente</span></h4>';
                    }else{
                        $output["MONTO_AUTORIZADO"] = '<h4><span class="badge bg-success">$'.$row["MONTO_AUTORIZADO"].'</span></h4>';
                    };
                    
                }
                echo json_encode($output);
            }
            break;


        case "imagen":
            $datos=$solicitud->listar_solicitud_imagen($_POST["SOL_ID"]);
            ?>
                <?php
                    foreach($datos as $row){
                        ?>
                        <div class="accordion" id="mostrar-imagen">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="mostrar-imagen-a">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#colapsar-imagen" aria-expanded="true" aria-controls="colapsar-imagen">
                                        Imagen Georeferenciada
                                    </button>
                                </h2>
                                <div id="colapsar-imagen" class="accordion-collapse collapse " aria-labelledby="mostrar-imagen-a" data-bs-parent="#default-accordion-example">
                                    <div class="accordion-body">
                                        <img src="../../public/document/solicitudes/solicitud-<?php echo $row["IMAGEN"];?>" class="img-fluid" alt="Imagen Georeferenciada">

                                        <!-- <div class="row gallery-wrapper">
                                            <div class="element-item col-xxl-12 col-xl-12 col-sm-12 project designing development" data-category="designing development">
                                                <div class="gallery-box card">
                                                    <div class="gallery-container">
                                                        <a class="image-popup" href="../../public/document/solicitudes/solicitud-<?php echo $row["IMAGEN"];?>" title="">
                                                            <img class="gallery-img img-fluid mx-auto" src="../../public/document/solicitudes/solicitud-<?php echo $row["IMAGEN"];?>" alt="" />

                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Responsive Images -->

                        <?php
                    }
                ?>
            <?php
            break;

        case "auto_monto_mod":
            $datos=$solicitud->listar_solicitud_detalle($_POST["SOL_ID"]);
            ?>
                <?php
                    foreach($datos as $row){
                        if($row["AUT_ID"]==0){
                            ?>
                                 <div class="modal-body">
                                    <input type="hidden" id="sol_idX" name="sol_idX">

                                    <div class="col-lg-12">
                                        <label class="form-label" for="monto_autorizado">Monto</label>
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input type="number" class="form-control" id="monto_autorizado" name="monto_autorizado" aria-label="Monto solicitado">
                                            <span class="input-group-text">.00</span>
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer" >
                                    <button type="submit" name="action" value="add" id="#" class="btn btn-primary ">Autorizar</button>
                                </div>

                            <?php
                        }else if($row["AUT_ID"]==1){
                            ?>
                                 <div class="modal-body">
                                    <input type="hidden" id="sol_idX" name="sol_idX">

                                    <div class="col-lg-12">
                                        <label class="form-label" for="monto_autorizado">Monto Autorizado</label>
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input type="number" class="form-control" id="monto_autorizado" placeholder="<?php echo $row["MONTO_AUTORIZADO"];?>" name="monto_autorizado" aria-label="Monto solicitado" disabled>
                                            <span class="input-group-text">.00</span>
                                        </div>
                                    </div>

                                </div>
                            <?php
                        };
                    }
                ?>
            <?php
            break;

        case "monto_autorizado":
            $datos=$solicitud->listar_solicitud_detalle($_POST["SOL_ID"]);
            ?>
                <?php
                    foreach($datos as $row){
                        if($row["AUT_ID"]==1){
                            ?>
                                    <div class="modal-body">
                                    <input type="hidden" id="sol_idX" name="sol_idX">

                                    <div class="col-lg-12">
                                        <label class="form-label" for="monto_autorizado">Monto</label>
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input type="number" class="form-control" id="monto_autorizado" value="<?php echo ($row["MONTO_AUTORIZADO"]);  ?>" name="monto_autorizado" aria-label="Monto solicitado" disabled>
                                            <span class="input-group-text">.00</span>
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer" >
                                    <button type="submit" name="action" value="add" id="#" class="btn btn-primary ">Autorizar</button>
                                </div>

                            <?php
                        };
                    }
                ?>
            <?php
            break;

        case "validacion_autorizaciones":
            $datos=$solicitud->validacion_autorizaciones();
            foreach($datos as $row){
                $solicitud->insert_autorizacion($row["SOL_ID"],$row["SOL_MONTO"]);
                $email->solicitud_autorizada_mail($row["SOL_ID"],$row["SOL_MONTO"]);
                $solicitud->actualizar_autorizacion($row["SOL_ID"]);
            };
            break; 
        }
?>