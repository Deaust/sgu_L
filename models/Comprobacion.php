<?php
    class Comprobacion extends Conectar{

        public function insert_comprobacion($sol_id,$comp_km_i,$comp_km_f,$comp_ticket,$comp_precio,$comp_cargados,$comp_gasolina,$comp_fech){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="call SP_I_COMPROBACION_01 (?,?,?,?,?,?,?,?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1, $sol_id);
            $query->bindValue(2, $comp_km_i);
            $query->bindValue(3, $comp_km_f);
            $query->bindValue(4, $comp_ticket);
            $query->bindValue(5, $comp_precio);
            $query->bindValue(6, $comp_cargados);
            $query->bindValue(7, $comp_gasolina);
            $query->bindValue(8, $comp_fech);
            $query->execute();

            $sql1="select last_insert_id() as 'COMP_ID';";
            $sql1=$conectar->prepare($sql1);
            $sql1->execute();
            return $resultado=$sql1->fetchAll(pdo::FETCH_ASSOC);
        }

        public function insert_solicitud_s($usu_id,$vehi_id,$sol_monto){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="call SP_I_SOLICITUD_02 (?,?,?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1, $usu_id);
            $query->bindValue(2, $vehi_id);
            $query->bindValue(3, $sol_monto);
            $query->execute();

            $sql1="select last_insert_id() as 'SOL_ID';";
            $sql1=$conectar->prepare($sql1);
            $sql1->execute();
            return $resultado=$sql1->fetchAll(pdo::FETCH_ASSOC);
        }


        public function validacion_autorizaciones(){
            $conectar=parent::Conexion();
            $sql="SELECT
            TM_COMPROBACION.COMP_ID,
            TM_COMPROBACION.SOL_ID,
            (SELECT AUT_ID FROM TM_AUTORIZACION WHERE PROCEDIMIENTO_ID=TM_COMPROBACION.COMP_ID AND AUT_TIPO=2) AS AUTORIZACION,
            TM_USUARIO.ROL_ID
            FROM
            TM_COMPROBACION
            
            INNER JOIN TM_SOLICITUD ON TM_COMPROBACION.SOL_ID = TM_SOLICITUD.SOL_ID 
            INNER JOIN TM_USUARIO ON TM_SOLICITUD.USU_ID =TM_USUARIO.USU_ID
            
            WHERE
            
            ROL_ID=6";
            $query=$conectar->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        public function insert_autorizacion($sol_id){
            $conectar= parent::conexion();
            $sql="call SP_I_AUTORIZACION_02 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1, $sol_id);
            $query->execute();
        }
        
        public function actualizar_autorizacion($sol_id){
            $conectar=parent::Conexion();
            $sql=" call SP_U_SOLICITUD_02 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$sol_id);
            $query->execute();
        }

        public function listar_comprobacion_1($usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT 
                SOL_ID,
                FECH_CREA,
                SOL_MONTO,
                (SELECT COUNT(*) FROM TM_COMPROBACION WHERE SOL_ID=TM_SOLICITUD.SOL_ID)AS COMPROBACION,
                (SELECT COMP_ID FROM TM_COMPROBACION WHERE SOL_ID=TM_SOLICITUD.SOL_ID)AS COMP_ASIG,
                (SELECT count(*) FROM TM_AUTORIZACION WHERE PROCEDIMIENTO_ID=COMP_ASIG AND AUT_TIPO=2)AS AUTORIZACION,
                AUT_ID,
                COMP_ID,
                (SELECT VEHI_PLACAS FROM TM_VEHICULO WHERE VEHI_ID=TM_SOLICITUD.VEHI_ID) AS PLACAS
                FROM 
                TM_SOLICITUD

                WHERE
                TM_SOLICITUD.USU_ID=?
                AND AUT_ID=1";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll(pdo::FETCH_ASSOC);
        }

        public function listar_comprobacion_2($del_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT 
            TM_SOLICITUD.SOL_ID,
            TM_SOLICITUD.FECH_CREA,
            (SELECT COUNT(*) FROM TM_COMPROBACION WHERE SOL_ID=TM_SOLICITUD.SOL_ID)AS COMPROBACION,
            (SELECT COMP_ID FROM TM_COMPROBACION WHERE SOL_ID=TM_SOLICITUD.SOL_ID)AS COMP_ASIG,
                (SELECT count(*) FROM TM_AUTORIZACION WHERE PROCEDIMIENTO_ID=COMP_ASIG AND AUT_TIPO=2)AS AUTORIZACION,
            TM_SOLICITUD.COMP_ID,
            CONCAT(TM_USUARIO.USU_NOM,' ',TM_USUARIO.USU_APE)AS USUARIO,
            TM_SOLICITUD.SOL_MONTO,
            TM_SOLICITUD.AUT_ID,
            (SELECT VEHI_PLACAS FROM TM_VEHICULO WHERE VEHI_ID=TM_SOLICITUD.VEHI_ID) AS PLACAS
            FROM 
            TM_SOLICITUD
            INNER JOIN TM_USUARIO ON TM_SOLICITUD.USU_ID = TM_USUARIO.USU_ID
            INNER JOIN TM_DELEGACION ON TM_USUARIO.DEL_ID = TM_DELEGACION.DEL_ID
            WHERE
            TM_USUARIO.DEL_ID=?
            AND AUT_ID=1";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $del_id);
            $sql->execute();
            return $resultado=$sql->fetchAll(pdo::FETCH_ASSOC);
        }

        public function listar_comprobacion_3($dir_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT 
            TM_SOLICITUD.SOL_ID,
            TM_SOLICITUD.FECH_CREA,
            TM_SOLICITUD.COMP_ID,
            (SELECT COUNT(*) FROM TM_COMPROBACION WHERE SOL_ID=TM_SOLICITUD.SOL_ID)AS COMPROBACION,
            (SELECT COMP_ID FROM TM_COMPROBACION WHERE SOL_ID=TM_SOLICITUD.SOL_ID)AS COMP_ASIG,
                (SELECT count(*) FROM TM_AUTORIZACION WHERE PROCEDIMIENTO_ID=COMP_ASIG AND AUT_TIPO=2)AS AUTORIZACION,
            CONCAT(TM_USUARIO.USU_NOM,' ',TM_USUARIO.USU_APE)AS USUARIO,
            TM_DELEGACION.DEL_NOM AS DELEGACION,
            TM_SOLICITUD.SOL_MONTO,
            TM_SOLICITUD.AUT_ID,
            (SELECT VEHI_PLACAS FROM TM_VEHICULO WHERE VEHI_ID=TM_SOLICITUD.VEHI_ID) AS PLACAS
            FROM 
            TM_SOLICITUD
            INNER JOIN TM_USUARIO ON TM_SOLICITUD.USU_ID = TM_USUARIO.USU_ID
            INNER JOIN TM_DELEGACION ON TM_USUARIO.DEL_ID = TM_DELEGACION.DEL_ID
            INNER JOIN TM_DIRECCION ON TM_DELEGACION.DIR_ID = TM_DIRECCION.DIR_ID
            WHERE
            TM_DELEGACION.DIR_ID=?
            AND AUT_ID=1";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $dir_id);
            $sql->execute();
            return $resultado=$sql->fetchAll(pdo::FETCH_ASSOC);
        }

        public function listar_comprobacion_4(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT 
            TM_SOLICITUD.SOL_ID,
            TM_SOLICITUD.FECH_CREA,
            (SELECT COUNT(*) FROM TM_COMPROBACION WHERE SOL_ID=TM_SOLICITUD.SOL_ID)AS COMPROBACION,
            (SELECT COMP_ID FROM TM_COMPROBACION WHERE SOL_ID=TM_SOLICITUD.SOL_ID)AS COMP_ASIG,
                (SELECT count(*) FROM TM_AUTORIZACION WHERE PROCEDIMIENTO_ID=COMP_ASIG AND AUT_TIPO=2)AS AUTORIZACION,
            TM_SOLICITUD.COMP_ID,
            CONCAT(TM_USUARIO.USU_NOM,' ',TM_USUARIO.USU_APE)AS USUARIO,
            TM_DELEGACION.DEL_NOM AS DELEGACION,
            TM_DIRECCION.DIR_NOM AS DIRECCION,
            TM_SOLICITUD.SOL_MONTO,
            TM_SOLICITUD.AUT_ID,
            (SELECT VEHI_PLACAS FROM TM_VEHICULO WHERE VEHI_ID=TM_SOLICITUD.VEHI_ID) AS PLACAS
            FROM 
            TM_SOLICITUD
            INNER JOIN TM_USUARIO ON TM_SOLICITUD.USU_ID = TM_USUARIO.USU_ID
            INNER JOIN TM_DELEGACION ON TM_USUARIO.DEL_ID = TM_DELEGACION.DEL_ID
            INNER JOIN TM_DIRECCION ON TM_DELEGACION.DIR_ID = TM_DIRECCION.DIR_ID
            WHERE AUT_ID=1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll(pdo::FETCH_ASSOC);
        }

        public function listar_comprobacion_detalle($sol_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT
            (SELECT count(*) FROM TM_AUTORIZACION WHERE PROCEDIMIENTO_ID=TM_COMPROBACION.COMP_ID AND AUT_TIPO=2)AS ESTADO,
            TM_COMPROBACION.COMP_ID,
            TM_COMPROBACION.COMP_KM_I AS KM_I,
            TM_COMPROBACION.COMP_KM_F AS KM_F,
            TM_COMPROBACION.COMP_TICKET AS TICKET,
            TM_COMPROBACION.COMP_PRECIO AS PRECIO,
            TM_COMPROBACION.COMP_CARGADOS AS LITROS,
            TM_COMPROBACION.COMP_GASOLINA AS TIPO,
            TM_COMPROBACION.COMP_FECH AS FECHA,
            TM_COMPROBACION.FECH_CREA 
            
            FROM
            TM_SOLICITUD
            INNER JOIN TM_COMPROBACION ON TM_SOLICITUD.SOL_ID = TM_COMPROBACION.SOL_ID
            
            WHERE
            TM_SOLICITUD.SOL_ID=?";
            $query=$conectar->prepare($sql);
            $query->bindValue(1, $sol_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        public function listar_comprobacion_correo($sol_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT
            TM_COMPROBACION.COMP_ID,
            TM_COMPROBACION.SOL_ID,
            TM_COMPROBACION.COMP_KM_I AS KM_I,
            TM_COMPROBACION.COMP_KM_F AS KM_F,
            TM_COMPROBACION.COMP_TICKET AS TICKET,
            TM_COMPROBACION.COMP_PRECIO AS PRECIO,
            TM_COMPROBACION.COMP_CARGADOS AS LITROS,
            TM_COMPROBACION.COMP_GASOLINA AS TIPO,
            TM_COMPROBACION.COMP_FECH AS FECHA
            FROM
            TM_COMPROBACION
            WHERE
            TM_COMPROBACION.COMP_ID=?";
            $query=$conectar->prepare($sql);
            $query->bindValue(1, $sol_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        public function listar_solicitud_imagenes($sol_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT
            CONCAT(COMP_ID,'/tarjeta/',(SELECT DOC_NOM FROM TD_DOCUMENTO WHERE COMP_ID=TM_COMPROBACION.COMP_ID AND COMP_TIPO=1))AS TARJETA,
            CONCAT(COMP_ID,'/camioneta/',(SELECT DOC_NOM FROM TD_DOCUMENTO WHERE COMP_ID=TM_COMPROBACION.COMP_ID AND COMP_TIPO=2))AS CAMIONETA,
            CONCAT(COMP_ID,'/bomba/',(SELECT DOC_NOM FROM TD_DOCUMENTO WHERE COMP_ID=TM_COMPROBACION.COMP_ID AND COMP_TIPO=3))AS BOMBA,
            CONCAT(COMP_ID,'/compra/',(SELECT DOC_NOM FROM TD_DOCUMENTO WHERE COMP_ID=TM_COMPROBACION.COMP_ID AND COMP_TIPO=4))AS COMPRA,
            CONCAT(COMP_ID,'/odo_i/',(SELECT DOC_NOM FROM TD_DOCUMENTO WHERE COMP_ID=TM_COMPROBACION.COMP_ID AND COMP_TIPO=5))AS INICIAL,
            CONCAT(COMP_ID,'/odo_f/',(SELECT DOC_NOM FROM TD_DOCUMENTO WHERE COMP_ID=TM_COMPROBACION.COMP_ID AND COMP_TIPO=6))AS FINAL,
            CONCAT(COMP_ID,'/placa/',(SELECT DOC_NOM FROM TD_DOCUMENTO WHERE COMP_ID=TM_COMPROBACION.COMP_ID AND COMP_TIPO=7))AS PLACA
            FROM
            TM_COMPROBACION
            WHERE
            TM_COMPROBACION.SOL_ID = ?";
            $query=$conectar->prepare($sql);
            $query->bindValue(1, $sol_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }


        public function listar_comentarios($sol_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT 
            COM_ID,
            COM_DES,
            TM_COMENTARIO.USU_ID,
            TM_COMENTARIO.FECH_CREA AS FECHA,
            TM_COMENTARIO.PRO_ID AS PROCEDIMIENTO,
            TM_COMENTARIO.COM_DES AS DESCRIPCION,
            TM_COMENTARIO.COM_DOC AS DOCUMENTO,
            CONCAT(USU_NOM,' ',USU_APE) AS USUARIO
            FROM
            TM_COMENTARIO
            INNER JOIN TM_USUARIO ON TM_COMENTARIO.USU_ID= TM_USUARIO.USU_ID
            
            WHERE
            PRO_ID=?";
            $query=$conectar->prepare($sql);
            $query->bindValue(1, $sol_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        public function insert_comentario($comp_id,$usu_id,$descripcion){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO
            TM_COMENTARIO
            (COM_TIPO,PRO_ID,USU_ID,COM_DES,FECH_CREA,EST)
            VALUES
            (1,?,?,?,NOW(),1)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1, $comp_id);
            $query->bindValue(2, $usu_id);
            $query->bindValue(3, $descripcion);
            $query->execute();

            $sql1="select last_insert_id() as 'COM_ID';";
            $sql1=$conectar->prepare($sql1);
            $sql1->execute();
            return $resultado=$sql1->fetchAll(pdo::FETCH_ASSOC);
        }
        public function insert_comentario_doc($doc,$com_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE
            TM_COMENTARIO
            SET
            COM_DOC=?
            WHERE
            COM_ID=?";
            $query=$conectar->prepare($sql);
            $query->bindValue(1, $doc);
            $query->bindValue(2, $com_id);
            $query->execute();

            $sql1="select last_insert_id() as 'COM_ID';";
            $sql1=$conectar->prepare($sql1);
            $sql1->execute();
            return $resultado=$sql1->fetchAll(pdo::FETCH_ASSOC);
        }

        public function listar_comentario_correo($com_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT 
            TM_COMPROBACION.SOL_ID,
            COM_DES AS DESCRIPCION
            FROM TM_COMENTARIO 
            INNER JOIN TM_COMPROBACION ON TM_COMENTARIO.PRO_ID = TM_COMPROBACION.COMP_ID
            WHERE
            COM_ID=?";
            $query=$conectar->prepare($sql);
            $query->bindValue(1, $com_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }


    }
?>