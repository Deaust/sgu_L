<?php
    require_once("../config/conexion.php");
    require_once("../models/Comprobacion.php"); 
    $comprobacion = new Comprobacion();
    require_once("../models/Documento.php");
    $documento = new Documento();
    require_once("../models/Email.php");
    $email = new Email();

    switch($_GET["op"]){

        case "insert":
            $datos=$comprobacion->insert_comprobacion($_POST["sol_idX"],$_POST["km_i"],$_POST["km_f"],$_POST["no_ticket"],$_POST["precio_gas"],$_POST["tipo_gas"],$_POST["litros_cargados"],$_POST["fech_carga"]);
            if (is_array($datos)==true and count($datos)>0){
                foreach ($datos as $row){
                    $output["COMP_ID"] = $row["COMP_ID"];
           


                    if($_FILES['tarjeta']){
                        $sub = "tarjeta/";
                        $ruta = "../public/document/comprobaciones/comprobacion-".$output["COMP_ID"]."/".$sub;
                        $files_arr = array();
                        
                        if (!file_exists($ruta)) {
                            mkdir($ruta, 0777, true);
                        }

                        $doc1 = $_FILES['tarjeta']['tmp_name'];
                        $destino1 = $ruta.$_FILES['tarjeta']['name'];

                        $documento->insert_documento_comp( $output["COMP_ID"],1,$_FILES['tarjeta']['name']);
                       

                        move_uploaded_file($doc1,$destino1);
                        
                        

                    }
                    if($_FILES['camioneta']){
                        $sub = "camioneta/";
                        $ruta = "../public/document/comprobaciones/comprobacion-".$output["COMP_ID"]."/".$sub;
                        $files_arr = array();
                        
                        if (!file_exists($ruta)) {
                            mkdir($ruta, 0777, true);
                        }
                        $doc2 = $_FILES['camioneta']['tmp_name'];
                        $destino2 = $ruta.$_FILES['camioneta']['name'];
    
                        $documento->insert_documento_comp( $output["COMP_ID"],2,$_FILES['camioneta']['name']);
                        

                        move_uploaded_file($doc2,$destino2);
                        
    
                    }
                    if($_FILES['bomba']){
                        $sub = "bomba/";
                        $ruta = "../public/document/comprobaciones/comprobacion-".$output["COMP_ID"]."/".$sub;
                        $files_arr = array();
                        
                        if (!file_exists($ruta)) {
                            mkdir($ruta, 0777, true);
                        }
                        
                        $doc3 = $_FILES['bomba']['tmp_name'];
                        $destino3 = $ruta.$_FILES['bomba']['name'];
    
                        $documento->insert_documento_comp( $output["COMP_ID"],3,$_FILES['bomba']['name']);
                        

                        move_uploaded_file($doc3,$destino3);
                        

                    }
                    if($_FILES['compra']){
                        $sub = "compra/";
                        $ruta = "../public/document/comprobaciones/comprobacion-".$output["COMP_ID"]."/".$sub;
                        $files_arr = array();
                        
                        if (!file_exists($ruta)) {
                            mkdir($ruta, 0777, true);
                        }
                        $doc4 = $_FILES['compra']['tmp_name'];
                        $destino4 = $ruta.$_FILES['compra']['name'];
    
                        $documento->insert_documento_comp( $output["COMP_ID"],4,$_FILES['compra']['name']);
                        

                        move_uploaded_file($doc4,$destino4);
                        

                    }
                    if($_FILES['odo_i']){
                        $sub = "odo_i/";
                        $ruta = "../public/document/comprobaciones/comprobacion-".$output["COMP_ID"]."/".$sub;
                        $files_arr = array();
                        
                        if (!file_exists($ruta)) {
                            mkdir($ruta, 0777, true);
                        }
                        $doc5 = $_FILES['odo_i']['tmp_name'];
                        $destino5 = $ruta.$_FILES['odo_i']['name'];

                        $documento->insert_documento_comp( $output["COMP_ID"],5,$_FILES['odo_i']['name']);
                       

                        move_uploaded_file($doc5,$destino5);
                        
    

                    }
                    if($_FILES['odo_f']){
                        $sub = "odo_f/";
                        $ruta = "../public/document/comprobaciones/comprobacion-".$output["COMP_ID"]."/".$sub;
                        $files_arr = array();
                        
                        if (!file_exists($ruta)) {
                            mkdir($ruta, 0777, true);
                        }
                        
                        $doc6 = $_FILES['odo_f']['tmp_name'];
                        $destino6 = $ruta.$_FILES['odo_f']['name'];

                        $documento->insert_documento_comp( $output["COMP_ID"],6,$_FILES['odo_f']['name']);


                        move_uploaded_file($doc6,$destino6);

    

                    }
                    if($_FILES['placa']){
                        $sub = "placa/";
                        $ruta = "../public/document/comprobaciones/comprobacion-".$output["COMP_ID"]."/".$sub;
                        $files_arr = array();
                        
                        if (!file_exists($ruta)) {
                            mkdir($ruta, 0777, true);
                        }
                        
                        $doc7 = $_FILES['placa']['tmp_name'];
                        $destino7 = $ruta.$_FILES['placa']['name'];

                        $documento->insert_documento_comp( $output["COMP_ID"],7,$_FILES['placa']['name']);


                        move_uploaded_file($doc7,$destino7);

                    }

                
                }
            }
            echo json_encode($datos);
            break;

        case "insert_s":
            $datos=$solicitud->insert_solicitud_s($_POST["usu_idx"],$_POST["vehi_id"],$_POST["sol_monto"]);
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
            $comprobacion->insert_autorizacion($_POST["COMP_ID"]);
            
            break;

        case "comprobacion_autorizada":
            $comprobacion->actualizar_autorizacion($_POST["SOL_ID"]);
            break;

        case "listar_1":
            $datos=$comprobacion->listar_comprobacion_1($_POST["USU_ID"]);
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["SOL_ID"];
                $sub_array[] = date("d/m/Y",strtotime($row["FECH_CREA"]));
                $sub_array[] = "$".$row["SOL_MONTO"];

                $sub_array[] = $row["PLACAS"];

                if( $row["COMPROBACION"]==0){
                    $sub_array[] = '<h4><span class="badge bg-warning">SIN COMPROBACION</span></h4>';
                }else if($row["AUTORIZACION"]==1){
                    $sub_array[] = '<h4><span class="badge bg-success">AUTORIZADA</span></h4>';
                }else if ($row["COMPROBACION"]==1 && $row["AUTORIZACION"]==0){
                    $sub_array[] = '<h4><span class="badge bg-warning">EN PROCESO DE AUTORIZACION</span></h4>';
                };

                if( $row["COMPROBACION"]==0){
                    $sub_array[] = '<button type="button" onClick="nueva('.$row["SOL_ID"].')" id="'.$row["SOL_ID"].'" class="btn btn-info btn-icon waves-effect waves-light"><i class="  ri-folder-shared-fill"></i></button>';
                }else if ($row["COMPROBACION"]==1){
                    $sub_array[] = '<button type="button" onClick="detalle('.$row["SOL_ID"].')" id="'.$row["SOL_ID"].'" class="btn btn-success btn-icon waves-effect waves-light"><i class="  ri-chat-4-line"></i></button>';
                };

                
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
            $datos=$comprobacion->listar_comprobacion_2($_POST["DEL_ID"]);
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["SOL_ID"];
                $sub_array[] = $row["USUARIO"];
                $sub_array[] = date("d/m/Y",strtotime($row["FECH_CREA"]));
                $sub_array[] = "$".$row["SOL_MONTO"];

                $sub_array[] = $row["PLACAS"];

                if( $row["COMPROBACION"]==0){
                    $sub_array[] = '<h4><span class="badge bg-warning">SIN COMPROBACION</span></h4>';
                }else if($row["AUTORIZACION"]==1){
                    $sub_array[] = '<h4><span class="badge bg-success">AUTORIZADA</span></h4>';
                }else if ($row["COMPROBACION"]==1 && $row["AUTORIZACION"]==0){
                    $sub_array[] = '<h4><span class="badge bg-warning">EN PROCESO DE AUTORIZACION</span></h4>';
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
            $datos=$comprobacion->listar_comprobacion_3($_POST["DIR_ID"]);
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["SOL_ID"];
                $sub_array[] = $row["DELEGACION"];
                $sub_array[] = $row["USUARIO"];
                $sub_array[] = date("d/m/Y",strtotime($row["FECH_CREA"]));
                $sub_array[] = "$".$row["SOL_MONTO"];

                $sub_array[] = $row["PLACAS"];

                if( $row["COMPROBACION"]==0){
                    $sub_array[] = '<h4><span class="badge bg-warning">SIN COMPROBACION</span></h4>';
                }else if($row["AUTORIZACION"]==1){
                    $sub_array[] = '<h4><span class="badge bg-success">AUTORIZADA</span></h4>';
                }else if ($row["COMPROBACION"]==1 && $row["AUTORIZACION"]==0){
                    $sub_array[] = '<h4><span class="badge bg-warning">EN PROCESO DE AUTORIZACION</span></h4>';
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
            $datos=$comprobacion->listar_comprobacion_4();
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

                if( $row["COMPROBACION"]==0){
                    $sub_array[] = '<h4><span class="badge bg-warning">SIN COMPROBACION</span></h4>';
                }else if($row["AUTORIZACION"]==1){
                    $sub_array[] = '<h4><span class="badge bg-success">AUTORIZADA</span></h4>';
                }else if ($row["COMPROBACION"]==1 && $row["AUTORIZACION"]==0){
                    $sub_array[] = '<h4><span class="badge bg-warning">EN PROCESO DE AUTORIZACION</span></h4>';
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

        
        
        case "listar_comp_det":
            $datos=$comprobacion->listar_comprobacion_detalle($_POST["SOL_ID"]);
            if (is_array($datos)==true and count($datos)>0){
                foreach($datos as $row){
                    if( $row["ESTADO"]==0){
                        $output["ESTADO"] = '<h4><span class="badge bg-warning">PENDIENTE</br>AUTORIZACION</span></h4>';
                    }else if ($row["ESTADO"]==1){
                        $output["ESTADO"] = '<h4><span class="badge bg-success">AUTORIZADA</span></h4>';
                    };
                    $output["ESTADO_ID"] = $row["ESTADO"];
                    $output["COMP_ID"] = $row["COMP_ID"];

                    $output["KM_I"] = $row["KM_I"];
                    $output["KM_F"] = $row["KM_F"];
                    $output["TICKET"] = $row["TICKET"];
                    $output["PRECIO"] = "$".$row["PRECIO"];
                    $output["TIPO"] = $row["TIPO"];
                    $output["LITROS"] = $row["LITROS"]." L";
                    $output["FECHA"] = $row["FECHA"];

                    $monto=$row["LITROS"]*$row["PRECIO"];
                    $output["MONTO"] = "$".$monto;
                    $output["MONTO_S"] = $monto;
                    
                }
                echo json_encode($output);
            }
            break;


        case "imagenes":
            $datos=$comprobacion->listar_solicitud_imagenes($_POST["SOL_ID"]);
            ?>
                <?php
                    foreach($datos as $row){
                        ?><!-- Collapse Example -->
                            <div class="hstack gap-2 flex-wrap mb-3">
                                <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#tarjeta" aria-expanded="false" aria-controls="imagenes">
                                    Tarjeta de Circulación
                                </button>
                                <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#camioneta" aria-expanded="false" aria-controls="imagenes">
                                    Camioneta
                                </button>
                                <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#placa" aria-expanded="false" aria-controls="imagenes">
                                    Placa
                                </button>
                                <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#bomba" aria-expanded="false" aria-controls="imagenes">
                                    Ticket Bomba
                                </button>
                                <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#compra" aria-expanded="false" aria-controls="imagenes">
                                    Ticket Terminal
                                </button>
                                <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#inicial" aria-expanded="false" aria-controls="imagenes">
                                    Odometro Inicial
                                </button>
                                <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#final" aria-expanded="false" aria-controls="imagenes">
                                    Odometro Final
                                </button>
                            </div>
                            
                            <div class="collapse" id="tarjeta" data-bs-parent="#imagenes">
                                <div class="card mb-0">
                                    <div class="card-body">
                                        <img src="../../public/document/comprobaciones/comprobacion-<?php echo $row["TARJETA"];?>" class="img-fluid" alt="TARJETA DE CIRCULACION">
                                    </div>
                                </div>
                            </div>
                            <div class="collapse" id="camioneta" data-bs-parent="#imagenes">
                                <div class="card mb-0">
                                    <div class="card-body">
                                        <img src="../../public/document/comprobaciones/comprobacion-<?php echo $row["CAMIONETA"];?>" class="img-fluid" alt="CAMIONETA">
                                    </div>
                                </div>
                            </div>
                            <div class="collapse" id="bomba" data-bs-parent="#imagenes">
                                <div class="card mb-0">
                                    <div class="card-body">
                                        <img src="../../public/document/comprobaciones/comprobacion-<?php echo $row["BOMBA"];?>" class="img-fluid" alt="BOMBA">
                                    </div>
                                </div>
                            </div>
                            <div class="collapse" id="placa" data-bs-parent="#imagenes">
                                <div class="card mb-0">
                                    <div class="card-body">
                                        <img src="../../public/document/comprobaciones/comprobacion-<?php echo $row["PLACA"];?>" class="img-fluid" alt="PLACA">
                                    </div>
                                </div>
                            </div>
                            <div class="collapse" id="inicial" data-bs-parent="#imagenes">
                                <div class="card mb-0">
                                    <div class="card-body">
                                        <img src="../../public/document/comprobaciones/comprobacion-<?php echo $row["INICIAL"];?>" class="img-fluid" alt="ODOMETRO INICIAL">
                                    </div>
                                </div>
                            </div>
                            <div class="collapse" id="final" data-bs-parent="#imagenes">
                                <div class="card mb-0">
                                    <div class="card-body">
                                        <img src="../../public/document/comprobaciones/comprobacion-<?php echo $row["FINAL"];?>" class="img-fluid" alt="ODOMETRO FINAL">
                                    </div>
                                </div>
                            </div>
                            <div class="collapse" id="compra" data-bs-parent="#imagenes">
                                <div class="card mb-0">
                                    <div class="card-body">
                                        <img src="../../public/document/comprobaciones/comprobacion-<?php echo $row["COMPRA"];?>" class="img-fluid" alt="COMPRA">
                                    </div>
                                </div>
                            </div>
                        <?php
                    }
                ?>
            <?php
            break;

        case "aut_comprobacion":
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
            $datos=$comprobacion->validacion_autorizaciones();
            foreach($datos as $row){
                if($row["AUTORIZACION"]===NULL){
                    $comprobacion->insert_autorizacion($row["COMP_ID"]);
                    $email->comprobacion_autorizada_mail($row["SOL_ID"]);
                    $comprobacion->actualizar_autorizacion($row["SOL_ID"]);
                }
                
            };
            break; 
        
        case "listardetalle":
            $datos=$comprobacion->listar_comentarios($_POST["COMP_ID"]);
            ?>
                <?php
                    foreach($datos as $row){
                        if ($row['USU_ID'] === $_SESSION['USU_ID']){
                        ?>
                        <li class="chat-list right">
                            <div class="conversation-list">
                                <div class="user-chat-content">
                                    <div class="ctext-wrap">
                                        <div class="ctext-wrap-content">
                                            <p class="mb-0 ctext-content"><?php echo $row["DESCRIPCION"];?></p>
                                            <?php
                                                if($row['DOCUMENTO']===NULL){

                                                }else{
                                                
                                                    ?>
                                                        <a href="../../public/document/comprobaciones/comentarios/comentario-<?php echo $row["COM_ID"]; ?>/<?php echo $row["DOCUMENTO"]; ?>" target="_blank" ><?php echo $row["DOCUMENTO"]; ?></a>
                                                        
                                                    <?php
                                                }
                                            ?>
                                        </div>
                                        
                                    </div>
                                    <div class="conversation-name"><small class="text-muted time"><?php echo date("d/m/Y,H:i:s", strtotime($row["FECHA"]));?></small> </div>
                                </div>
                            </div>
                        </li>
                        <!-- chat-list -->
                        <?php
                        }else  
                        {
                        ?>
                        <li class="chat-list left">
                            <div class="conversation-list">
                                <div class="chat-avatar">
                                    <img src="../../assets/images/logo-sm.png" alt="">
                                </div>
                                <div class="user-chat-content">
                                    <div class="ctext-wrap">
                                        <div class="ctext-wrap-content">
                                            <p class="mb-0 ctext-content"><?php echo $row["DESCRIPCION"];?></p>
                                            <?php
                                                    if($row['DOCUMENTO']===NULL){

                                                    }else{
                                                    
                                                        ?>
                                                            <a href="../../public/document/comprobaciones/comentarios/comentario-<?php echo $row["COM_ID"]; ?>/<?php echo $row["DOCUMENTO"]; ?>" target="_blank" ><?php echo $row["DOCUMENTO"]; ?></a>
                                                            
                                                        <?php
                                                    }
                                                ?>
                                        </div>
                                        
                                    </div>
                                    <div class="conversation-name"><small class="text-muted time"><?php echo date("d/m/Y,H:i:s", strtotime($row["FECHA"]));?></small> </div>
                                </div>
                            </div>
                        </li>
                            
                        <?php
                        }
                    }
                ?>
            <?php
            break;

        case "insertcomentario":
            $datos=$comprobacion->insert_comentario($_POST["COMP_ID"],$_POST["USU_ID"],$_POST["DESCRIPCION"]);
            if (is_array($datos)==true and count($datos)>0){
                foreach ($datos as $row){
                    /* TODO: Obtener tikd_id de $datos */
                    $output["COM_ID"] = $row["COM_ID"];
                    /* TODO: Consultamos si vienen archivos desde la vista */
                    if (empty($_FILES['files']['name'])){

                    }else{
                        /* TODO:Contar registros */
                        $countfiles = count($_FILES['files']['name']);
                        /* TODO:Ruta de los documentos */
                        $ruta = "../public/document/comprobaciones/comentarios/comentario-".$output["COM_ID"]."/";
                        /* TODO: Array de archivos */
                        $files_arr = array();
                        /* TODO: Consultar si la ruta existe en caso no exista la creamos */
                        if (!file_exists($ruta)) {
                            mkdir($ruta, 0777, true);
                        }
                        $comprobacion->insert_comentario_doc($_FILES['files']['name'][0],$row["COM_ID"]);
                        

                        /* TODO:recorrer todos los registros */
                        for ($index = 0; $index < $countfiles; $index++) {
                            $doc1 = $_FILES['files']['tmp_name'][$index];
                            $destino = $ruta.$_FILES['files']['name'][$index];

                            move_uploaded_file($doc1,$destino);
                        }
                    }
                }
            }
            echo json_encode($datos);
            break;
        }
?>