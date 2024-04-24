<?php
/* librerias necesarias para que el proyecto pueda enviar emails */
require('class.phpmailer.php');
include("class.smtp.php");

/* llamada de las clases necesarias que se usaran en el envio del mail */
require_once("../config/conexion.php");
require_once("../Models/Solicitud.php");
require_once("../Models/Comprobacion.php");

class Email extends PHPMailer{

    //variable que contiene el correo del destinatario
    //protected $gCorreo = 'pcv@mtd.lat';
    //protected $gContrasena = 'M4rkT3chD0408';
    //variable que contiene la contraseña del destinatario

    protected $gCorreo = 'mtd040822@hotmail.com';
    protected $gContrasena = 'M@rkT3chD.040822';
    //variable que contiene la contraseña del destinatario

    public function nueva_solicitud($sol_id){
        $solicitud = new Solicitud();
        $datos = $solicitud->listar_solicitud_correo($sol_id);
        foreach ($datos as $row){
            $ID= $row["SOL_ID"];
            $DELEGACION = $row["DELEGACION"];
            $USUARIO = $row["USUARIO"];
            $MONTO = "$".$row["SOL_MONTO"];
            $IMAGEN = $row["IMAGEN"];
            $PLACAS = $row["PLACAS"];

            $CORREO_DEL = $row["ENCARGADO_DEL"];
            $CORREO_AUT = "carlos.parada@ircep.gob.mx";
            $CORREO_DIR = $row["ENCARGADO_DIR"];
            $CORREO_USU = $row["USUARIO_MAIL"];
        }

        //IGual//
        $this->IsSMTP();
        //$this->Host = 'mail.privateemail.com';//Aqui el server
        $this->Host = 'smtp.office365.com';//Aqui el server
        $this->Port = 587;//Aqui el puerto
        $this->SMTPAuth = true;
        $this->Username = $this->gCorreo;
        $this->Password = $this->gContrasena;
        $this->From = $this->gCorreo;
        $this->FromName = "Nueva Solicitud de Combustible";
        $this->SMTPSecure = 'STARTTLS';
        $this->CharSet = 'UTF8';
        $this->addAddress($CORREO_DEL);
        $this->addAddress($CORREO_AUT);
        $this->addAddress($CORREO_DIR);
        $this->addAddress($CORREO_USU);
        $this->WordWrap = 50;
        $this->IsHTML(true);
        $this->Subject = "Nueva Solicitud de Combustible";   
        //Igual//
        $cuerpo = file_get_contents('../public/NuevaSolicitud.html'); /* Ruta del template en formato HTML */
        /* parametros del template a remplazar */
        $cuerpo = str_replace("xnrosolicitud", $ID, $cuerpo);
        $cuerpo = str_replace("lblNomUsu", $USUARIO, $cuerpo);
        $cuerpo = str_replace("lblPlaca", $PLACAS, $cuerpo);
        $cuerpo = str_replace("lblMonto", $MONTO, $cuerpo);
        $cuerpo = str_replace("lblImagen", $IMAGEN, $cuerpo);
        $cuerpo = str_replace("lblDelegacion", $DELEGACION, $cuerpo);
        

        $this->Body = $cuerpo;
        $this->AltBody = strip_tags("Nueva Solicitud de Combustible");
        return $this->Send();
    }

    public function solicitud_autorizada_mail($sol_id,$monto){
        $solicitud = new Solicitud();
        $datos = $solicitud->listar_solicitud_correo($sol_id);
        foreach ($datos as $row){

            $CORREO_DEL = $row["ENCARGADO_DEL"];
            $CORREO_AUT = "carlos.parada@ircep.gob.mx";
            $CORREO_DIR = $row["ENCARGADO_DIR"];
            $CORREO_USU = $row["USUARIO_MAIL"];
        }

        $datos2 = $solicitud->listar_placa_correo($sol_id);
        foreach ($datos2 as $row2){

            $PLACAS = $row2["PLACAS"];
            
        }
        

        //IGual//
        $this->IsSMTP();
        $this->Host = 'smtp.office365.com';//Aqui el server
        $this->Port = 587;//Aqui el puerto
        $this->SMTPAuth = true;
        $this->Username = $this->gCorreo;
        $this->Password = $this->gContrasena;
        $this->From = $this->gCorreo;
        $this->FromName = "Solicitud - ".$sol_id.",Autorizada por: $".$monto;
        $this->SMTPSecure = 'STARTTLS';
        $this->CharSet = 'UTF8';
        $this->addAddress($CORREO_DEL);
        $this->addAddress($CORREO_AUT);
        $this->addAddress($CORREO_DIR);
        $this->addAddress($CORREO_USU);
        $this->WordWrap = 50;
        $this->IsHTML(true);
        $this->Subject = "Solicitud - ".$sol_id.",Autorizada por: $".$monto.",correspondiente a las placas: ".$PLACAS;
        //Igual//
        $cuerpo = file_get_contents('../public/SolicitudAutorizada.html'); /* Ruta del template en formato HTML */
        /* parametros del template a remplazar */
        $cuerpo = str_replace("xnrosolicitud", $sol_id, $cuerpo);
        $cuerpo = str_replace("lblMonto", $monto, $cuerpo); 
        $cuerpo = str_replace("lblPlacas", $PLACAS, $cuerpo);        

        $this->Body = $cuerpo;
        $this->AltBody = strip_tags("Solicitud Autorizada");
        return $this->Send();
    }

    public function nueva_comprobacion($comp_id){
        $comprobacion = new Comprobacion();
        $datos = $comprobacion->listar_comprobacion_correo($comp_id);
        foreach ($datos as $row){

            $SOL_ID = $row["SOL_ID"];
            $COMP_ID = $row["COMP_ID"];
            $KM_I =$row["KM_I"];
            $KM_F =$row["KM_F"];
            $TICKET =$row["TICKET"];
            $PRECIO =$row["PRECIO"];
            $LITROS =$row["LITROS"];
            $TIPO =$row["TIPO"];
            $FECHA =$row["FECHA"];
            $TOTAL =ROUND(($PRECIO*$LITROS),2);  
        }

        $datos3 = $comprobacion->listar_solicitud_imagenes($SOL_ID);
        foreach ($datos3 as $row3){

           $IMG_TARJETA=$row3["TARJETA"];
           $IMG_CAMIONETA=$row3["CAMIONETA"];
           $IMG_BOMBA=$row3["BOMBA"];
           $IMG_COMPRA=$row3["COMPRA"];
           $IMG_INICIAL=$row3["INICIAL"];
           $IMG_FINAL=$row3["FINAL"];
           $IMG_PLACA=$row3["PLACA"];
        }

        $solicitud = new Solicitud();
        $datos2 = $solicitud->listar_solicitud_correo($comp_id);
        foreach ($datos2 as $row2){

            $CORREO_DEL = $row2["ENCARGADO_DEL"];
            $CORREO_AUT = "carlos.parada@ircep.gob.mx";
            $CORREO_DIR = $row2["ENCARGADO_DIR"];
            $CORREO_USU = $row2["USUARIO_MAIL"];
        } 

        //IGual//
            $this->IsSMTP();
            $this->Host = 'smtp.office365.com';//Aqui el server
            $this->Port = 587;//Aqui el puerto
            $this->SMTPAuth = true;
            $this->Username = $this->gCorreo;
            $this->Password = $this->gContrasena;
            $this->From = $this->gCorreo;
            $this->FromName = "Nueva Comprobación";
            $this->SMTPSecure = 'STARTTLS';
            $this->CharSet = 'UTF8';
            $this->addAddress($CORREO_DEL);
            $this->addAddress($CORREO_AUT);
            $this->addAddress($CORREO_DIR);
            $this->addAddress($CORREO_USU);
            $this->WordWrap = 50;
            $this->IsHTML(true);
            $this->Subject = "Nueva Comprobación";
        //Igual//
        $cuerpo = file_get_contents('../public/NuevaComprobacion.html'); /* Ruta del template en formato HTML */
        /* parametros del template a remplazar */
            $cuerpo = str_replace("xnrosolicitud", $SOL_ID, $cuerpo);
            $cuerpo = str_replace("xnrocomprobacion", $COMP_ID, $cuerpo);
            $cuerpo = str_replace("lblKmI", $KM_I, $cuerpo);  
            $cuerpo = str_replace("lblKmF", $KM_F, $cuerpo);  
            $cuerpo = str_replace("lblTicket", $TICKET, $cuerpo);  
            $cuerpo = str_replace("lblPrecio", $PRECIO, $cuerpo);  
            $cuerpo = str_replace("lblCargados", $LITROS, $cuerpo);  
            $cuerpo = str_replace("lblTotal", $TOTAL, $cuerpo);  
            $cuerpo = str_replace("lblTipo", $TIPO, $cuerpo);  
            $cuerpo = str_replace("lblFecha", $FECHA, $cuerpo);  
            $cuerpo = str_replace("lblImgTarjeta", $IMG_TARJETA, $cuerpo);  
            $cuerpo = str_replace("lblImgCamioneta", $IMG_CAMIONETA, $cuerpo);  
            $cuerpo = str_replace("lblImgBomba", $IMG_BOMBA, $cuerpo);  
            $cuerpo = str_replace("lblImgCompra", $IMG_COMPRA, $cuerpo);  
            $cuerpo = str_replace("lblImgOdoI", $IMG_INICIAL, $cuerpo);  
            $cuerpo = str_replace("lblImgOdoF", $IMG_FINAL, $cuerpo); 
            $cuerpo = str_replace("lblImgPlaca", $IMG_PLACA, $cuerpo);          
        //
        $this->Body = $cuerpo;
        $this->AltBody = strip_tags("Nueva Comprobación");
        return $this->Send();
    }

    public function comprobacion_autorizada_mail($sol_id){
        $solicitud = new Solicitud();
        $datos = $solicitud->listar_solicitud_correo($sol_id);
        foreach ($datos as $row){

            $CORREO_DEL = $row["ENCARGADO_DEL"];
            $CORREO_AUT = "carlos.parada@ircep.gob.mx";
            $CORREO_DIR = $row["ENCARGADO_DIR"];
            $CORREO_USU = $row["USUARIO_MAIL"];
        }        

        //IGual//
        $this->IsSMTP();
        $this->Host = 'smtp.office365.com';//Aqui el server
        $this->Port = 587;//Aqui el puerto
        $this->SMTPAuth = true;
        $this->Username = $this->gCorreo;
        $this->Password = $this->gContrasena;
        $this->From = $this->gCorreo;
        $this->FromName = "Comprobacion Autorizada - ".$sol_id;
        $this->SMTPSecure = 'STARTTLS';
        $this->CharSet = 'UTF8';
        $this->addAddress($CORREO_DEL);
        $this->addAddress($CORREO_AUT);
        $this->addAddress($CORREO_DIR);
        $this->addAddress($CORREO_USU);
        $this->WordWrap = 50;
        $this->IsHTML(true);
        $this->Subject = "Comprobacion Autorizada - ".$sol_id;
        //Igual//
        $cuerpo = file_get_contents('../public/ComprobacionAutorizada.html'); /* Ruta del template en formato HTML */
        /* parametros del template a remplazar */
        $cuerpo = str_replace("xnroSolicitud", $sol_id, $cuerpo);    

        $this->Body = $cuerpo;
        $this->AltBody = strip_tags("Comprobacion Autorizada");
        return $this->Send();
    }

    public function nuevo_comentario_mail($descripcion,$sol_id){
        $solicitud = new Solicitud();
        $datos = $solicitud->listar_solicitud_correo($sol_id);
        foreach ($datos as $row){
            $CORREO_DEL = $row["ENCARGADO_DEL"];
            $CORREO_AUT = "carlos.parada@ircep.gob.mx";
            $CORREO_DIR = $row["ENCARGADO_DIR"];
            $CORREO_USU = $row["USUARIO_MAIL"];
        }

        //IGual//
        $this->IsSMTP();
        //$this->Host = 'mail.privateemail.com';//Aqui el server
        $this->Host = 'smtp.office365.com';//Aqui el server
        $this->Port = 587;//Aqui el puerto
        $this->SMTPAuth = true;
        $this->Username = $this->gCorreo;
        $this->Password = $this->gContrasena;
        $this->From = $this->gCorreo;
        $this->FromName = "Nuevo comentario en la solicitud: ".$sol_id;
        $this->SMTPSecure = 'STARTTLS';
        $this->CharSet = 'UTF8';
        $this->addAddress($CORREO_DEL);
        $this->addAddress($CORREO_AUT);
        $this->addAddress($CORREO_DIR);
        $this->addAddress($CORREO_USU);
        $this->WordWrap = 50;
        $this->IsHTML(true);
        $this->Subject = "Nuevo comentario en la solicitud: ".$sol_id;   
        //Igual//
        $cuerpo = file_get_contents('../public/Nuevocomentario.html'); /* Ruta del template en formato HTML */
        /* parametros del template a remplazar */
        $cuerpo = str_replace("xnrosolicitud", $sol_id, $cuerpo);
        $cuerpo = str_replace("lblDescripcion", $descripcion, $cuerpo);        

        $this->Body = $cuerpo;
        $this->AltBody = strip_tags("Nuevo comentario en la solicitud: ".$sol_id);
        return $this->Send();
    } 

}

?>