<?php
    class Solicitud extends Conectar{

        public function insert_solicitud($usu_id,$vehi_id,$sol_monto){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="call SP_I_SOLICITUD_01 (?,?,?)";
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
            $sql="call SP_L_AUTORIZACION_01 ()";
            $query=$conectar->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        public function insert_autorizacion($sol_id,$monto){
            $conectar= parent::conexion();
            $sql="call SP_I_AUTORIZACION_01 (?,?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1, $sol_id);
            $query->bindValue(2, $monto);

            $query->execute();$sql1="select last_insert_id() as 'AUT_ID';";
            $sql1=$conectar->prepare($sql1);
            $sql1->execute();
            return $resultado=$sql1->fetchAll(pdo::FETCH_ASSOC);
        }
        
        public function actualizar_autorizacion($sol_id){
            $conectar=parent::Conexion();
            $sql=" call SP_U_SOLICITUD_01 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$sol_id);
            $query->execute();
        }


        public function listar_solicitud_1($usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT 
                SOL_ID,
                FECH_CREA,
                SOL_MONTO,
                AUT_ID,
                (SELECT VEHI_PLACAS FROM TM_VEHICULO WHERE VEHI_ID=TM_SOLICITUD.VEHI_ID) AS PLACAS
                FROM 
                TM_SOLICITUD

                WHERE
                TM_SOLICITUD.USU_ID=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll(pdo::FETCH_ASSOC);
        }

        public function listar_solicitud_2($del_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT 
            TM_SOLICITUD.SOL_ID,
            TM_SOLICITUD.FECH_CREA,
            CONCAT(TM_USUARIO.USU_NOM,' ',TM_USUARIO.USU_APE)AS USUARIO,
            TM_SOLICITUD.SOL_MONTO,
            TM_SOLICITUD.AUT_ID,
            (SELECT VEHI_PLACAS FROM TM_VEHICULO WHERE VEHI_ID=TM_SOLICITUD.VEHI_ID) AS PLACAS
            FROM 
            TM_SOLICITUD
            INNER JOIN TM_USUARIO ON TM_SOLICITUD.USU_ID = TM_USUARIO.USU_ID
            INNER JOIN TM_DELEGACION ON TM_USUARIO.DEL_ID = TM_DELEGACION.DEL_ID
            WHERE
            TM_USUARIO.DEL_ID=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $del_id);
            $sql->execute();
            return $resultado=$sql->fetchAll(pdo::FETCH_ASSOC);
        }

        public function listar_solicitud_3($dir_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT 
            TM_SOLICITUD.SOL_ID,
            TM_SOLICITUD.FECH_CREA,
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
            TM_DELEGACION.DIR_ID=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $dir_id);
            $sql->execute();
            return $resultado=$sql->fetchAll(pdo::FETCH_ASSOC);
        }

        public function listar_solicitud_4(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT 
            TM_SOLICITUD.SOL_ID,
            TM_SOLICITUD.FECH_CREA,
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
            INNER JOIN TM_DIRECCION ON TM_DELEGACION.DIR_ID = TM_DIRECCION.DIR_ID";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll(pdo::FETCH_ASSOC);
        }

        public function listar_solicitud_detalle($sol_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT 
            TM_SOLICITUD.SOL_ID,
            TM_SOLICITUD.USU_ID,
            TM_SOLICITUD.AUT_ID,
            TM_SOLICITUD.FECH_CREA,
            TM_SOLICITUD.SOL_MONTO,
            TM_VEHICULO.TAR_ID,
            (SELECT MONTO FROM TM_AUTORIZACION WHERE TM_AUTORIZACION.PROCEDIMIENTO_ID=TM_SOLICITUD.SOL_ID AND AUT_TIPO=1) AS MONTO_AUTORIZADO,
            TM_DELEGACION.DEL_NOM AS DELEGACION,
            CONCAT(TM_USUARIO.USU_NOM,' ',TM_USUARIO.USU_APE)AS USUARIO,
            TD_DOCUMENTO.DOC_NOM AS IMAGEN,
            TM_VEHICULO.VEHI_PLACAS AS PLACAS,
            TM_VEHICULO.VEHI_TIPO AS MODELO,
            TM_VEHICULO.VEHI_MODELO AS AÑO,
            TM_VEHICULO.VEHI_MARCA AS MARCA,
            TM_VEHICULO.VEHI_COLOR AS COLOR,
            TM_VEHICULO.VEHI_NS AS NS,
            TM_TARJETA.TAR_NUMERO AS TARJETA,
            (SELECT IFNULL((SELECT SUM(MOV_MONTO) FROM TM_MOVIMIENTO WHERE MOV_TIPO=3 AND TAR_DEST=TM_VEHICULO.TAR_ID),0))-
            (SELECT IFNULL((SELECT SUM(MOV_MONTO) FROM TM_MOVIMIENTO WHERE MOV_TIPO=3 AND TAR_ID =TM_VEHICULO.TAR_ID),0))+
            (SELECT IFNULL((SELECT SUM(MOV_MONTO) FROM TM_MOVIMIENTO WHERE MOV_TIPO=1 AND TAR_ID=TM_VEHICULO.TAR_ID),0))-
            (SELECT IFNULL((SELECT SUM(MOV_MONTO) FROM TM_MOVIMIENTO WHERE MOV_TIPO=2 AND TAR_ID=TM_VEHICULO.TAR_ID),0))-
            (SELECT IFNULL((SELECT SUM(MOV_MONTO) FROM TM_MOVIMIENTO WHERE MOV_TIPO=4 AND TAR_ID=TM_VEHICULO.TAR_ID),0)) AS SALDO_TARJETA
            FROM
            TM_SOLICITUD
            INNER JOIN TM_USUARIO ON TM_SOLICITUD.USU_ID = TM_USUARIO.USU_ID
            INNER JOIN TM_DELEGACION ON TM_USUARIO.DEL_ID = TM_DELEGACION.DEL_ID
            INNER JOIN TM_VEHICULO ON TM_SOLICITUD.VEHI_ID = TM_VEHICULO.VEHI_ID
            INNER JOIN TM_TARJETA ON TM_VEHICULO.TAR_ID = TM_TARJETA.TAR_ID
            INNER JOIN TD_DOCUMENTO ON TM_SOLICITUD.SOL_ID = TD_DOCUMENTO.SOL_ID
            WHERE
            TM_SOLICITUD.SOL_ID=?";
            $query=$conectar->prepare($sql);
            $query->bindValue(1, $sol_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        public function listar_solicitud_correo($sol_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT 
            TM_SOLICITUD.SOL_ID,
            TM_SOLICITUD.USU_ID,
            TM_SOLICITUD.AUT_ID,
            TM_SOLICITUD.FECH_CREA,
            TM_SOLICITUD.SOL_MONTO,
            TM_VEHICULO.VEHI_PLACAS AS PLACAS,
            TM_DELEGACION.DEL_NOM AS DELEGACION,
            TM_DELEGACION.DEL_ENC AS ENCARGADO_DEL,
            TM_DIRECCION.DIR_ENC AS ENCARGADO_DIR,
            TM_USUARIO.USU_CORREO AS USUARIO_MAIL,
            CONCAT(TM_USUARIO.USU_NOM,' ',TM_USUARIO.USU_APE)AS USUARIO,
            TD_DOCUMENTO.DOC_NOM AS IMAGEN
            
            FROM
            TM_SOLICITUD
            INNER JOIN TM_USUARIO ON TM_SOLICITUD.USU_ID = TM_USUARIO.USU_ID
            INNER JOIN TM_DELEGACION ON TM_USUARIO.DEL_ID = TM_DELEGACION.DEL_ID
            INNER JOIN TM_DIRECCION ON TM_DELEGACION.DIR_ID = TM_DIRECCION.DIR_ID
            INNER JOIN TM_VEHICULO ON TM_SOLICITUD.VEHI_ID = TM_VEHICULO.VEHI_ID
            INNER JOIN TD_DOCUMENTO ON TM_SOLICITUD.SOL_ID = TD_DOCUMENTO.SOL_ID
            WHERE
            TM_SOLICITUD.SOL_ID=?";
            $query=$conectar->prepare($sql);
            $query->bindValue(1, $sol_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }         

        public function listar_solicitud_imagen($sol_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT 
            CONCAT(SOL_ID,'/',(SELECT DOC_NOM FROM TD_DOCUMENTO WHERE SOL_ID=TM_SOLICITUD.SOL_ID))AS IMAGEN

            FROM 
            TM_SOLICITUD
            
            WHERE
            TM_SOLICITUD.SOL_ID=?";
            $query=$conectar->prepare($sql);
            $query->bindValue(1, $sol_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        public function listar_autorizacion_correo($aut_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT
            PROCEDIMIENTO_ID AS SOL_ID,
            MONTO AS SOL_MONTO
            FROM
            TM_AUTORIZACION
            WHERE
            AUT_TIPO=1
            AND
            AUT_ID=?";
            $query=$conectar->prepare($sql);
            $query->bindValue(1, $aut_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        public function listar_placa_correo($sol_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT
            (SELECT VEHI_PLACAS FROM TM_VEHICULO WHERE VEHI_ID=TM_SOLICITUD.VEHI_ID) AS PLACAS
            FROM
            TM_SOLICITUD
            WHERE
            SOL_ID=?";
            $query=$conectar->prepare($sql);
            $query->bindValue(1, $sol_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }


    }
?>