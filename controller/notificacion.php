<?php
    /*TODO: llamada a las clases necesarias */
    require_once("../config/conexion.php");
    require_once("../models/Notificacion.php");
    require_once("../models/Ticket.php"); 
    $notificacion = new Notificacion();

    /*TODO: opciones del controlador */
    switch($_GET["op"]){

        /* TODO: Mostrar en formato JSON segun usu_id */
        case "listarnotificaciones";
            $datos=$notificacion->get_notificacion_x_usu($_POST["usu_id"]);  
            ?>
                <div class="tab-pane fade show active py-2 ps-2"  role="tabpanel">
                    <div data-simplebar style="max-height: 300px;" class="pe-2"  id="">
                    
                        <?php
                            foreach($datos as $row){
                                ?>
                                    <input type="hidden" name="NOT_IDx" id="NOT_IDx" value="<?php echo ($row["not_id"])?>"/>
                                    <input type="hidden" name="TICK_IDx" id="TICK_IDx" value="<?php echo ($row["tick_id"])?>"/>
                                    <?php  

                                        date_default_timezone_set('America/Monterrey');
                                        
                                        $horaInicio = new DateTime($row["fech_crea"]);
                                        $horaTermino = new DateTime(date("Y-m-d H:i:s"));
                                        $interval = $horaInicio->diff($horaTermino);                        
                                    
                                    ?>
                                    <div class="text-reset notification-item d-block dropdown-item position-relative">
                                        <div class="d-flex">
                                            <div class="avatar-xs me-3">
                                                <span
                                                    class="avatar-title bg-soft-danger text-danger rounded-circle fs-16">
                                                    <i class='bx bx-message-square-dots'></i>
                                                </span>
                                            </div>
                                            <div class="flex-1">
                                                <div >
                                                    <h6 class="mt-0 mb-2 fs-13 lh-base"><?php echo ($row["not_mensaje"]);?> , Ticket: 
                                                        <b class="text-success"><?php echo ($row["tick_id"]);?>
                                                        </b>
                                                    </h6>
                                                </div>
                                                <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                    <span><i class="mdi mdi-clock-outline"></i> <?php echo $interval->format('%H horas %i minutos %s seconds');?></span>
                                                </p>
                                            </div>
                                            <div class="flex-2">
                                                <button type="button" id="btnnotificacion" class="btn btn-rounded btn-inline btn-primary">Ver</button>
                                            </div>
                                        </div>
                                    </div>
                                <?php 
                            }
                            ?>
                            
                    </div>
                </div>
            <?php
            break;

        case "vista":
            $notificacion->update_notificacion_estado($_POST["not_id"]);

            break;

        case "ticket_abierto":
            $notificacion->notificacion_ticket_abierto_soporte($_POST["tick_id"]);
            $notificacion->notificacion_ticket_abierto_generador($_POST["tick_id"]);
            break;

        case "ticket_cerrado":
            $notificacion->notificacion_ticket_cerrado_soporte($_POST["tick_id"]);
            $notificacion->notificacion_ticket_cerrado_generador($_POST["tick_id"]);
            
            break;

        case "ticket_comentario":
            
            $notificacion->notificacion_ticket_comentario_generador($_POST["tick_id"]);

            $notificacion->notificacion_ticket_comentario_soporte($_POST["tick_id"]);
            
            break;

    }
?>