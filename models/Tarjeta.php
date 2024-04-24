<?php
    class Tarjeta extends Conectar{

        /* TODO: Registro de datos */
        public function insert_tarjeta($tar_numero){
            $conectar=parent::Conexion();
            $sql="call SP_I_TARJETA_01 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$tar_numero);
            $query->execute();
        }

        /* TODO: Registro de recarga */
        public function recarga($id_tar,$mov_monto){
            $conectar=parent::Conexion();
            $sql="call SP_I_TARJETA_02 (?,?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$id_tar);
            $query->bindValue(2,$mov_monto);
            $query->execute();
        }

        /* TODO: Registro de recarga */
        public function gasto($id_tar,$mov_monto,$comp_id){
            $conectar=parent::Conexion();
            $sql="call SP_I_TARJETA_04 (?,?,?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$id_tar);
            $query->bindValue(2,$mov_monto);
            $query->bindValue(3,$comp_id);
            $query->execute();
        }

        public function validacion_movimientos(){
            $conectar=parent::Conexion();
            $sql="SELECT 
            TM_COMPROBACION.COMP_ID,
            TM_COMPROBACION.SOL_ID,
            TM_USUARIO.USU_NOM,
            (TM_COMPROBACION.COMP_PRECIO*TM_COMPROBACION.COMP_CARGADOS)AS GASTO,
            (SELECT MOV_ID FROM TM_MOVIMIENTO WHERE PROCEDIMIENTO_ID=TM_COMPROBACION.SOL_ID )AS MOV_ID,
            (SELECT TAR_ID FROM TM_VEHICULO WHERE VEHI_ID=TM_SOLICITUD.VEHI_ID) AS TARJETA
            FROM
            TM_COMPROBACION
            INNER JOIN TM_SOLICITUD ON TM_COMPROBACION.SOL_ID = TM_SOLICITUD.SOL_ID
            INNER JOIN TM_USUARIO ON TM_SOLICITUD.USU_ID = TM_USUARIO.USU_ID
            
            WHERE ROL_ID = 6";
            $query=$conectar->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        /* TODO: Registro de traspaso */
        public function traspaso($tar_ori,$tar_dest,$mov_monto){
            $conectar=parent::Conexion();
            $sql="call SP_I_TARJETA_03 (?,?,?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$tar_ori);
            $query->bindValue(2,$tar_dest);
            $query->bindValue(3,$mov_monto);
            $query->execute();
        }

        public function insert_barrido($mes,$year){
            $conectar=parent::Conexion();
            $sql="call SP_I_BARRIDO (?,?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$mes);
            $query->bindValue(2,$year);
            $query->execute();
        }

        public function validacion_barrido($mes,$year){
            $conectar=parent::Conexion();
            $sql="call SP_L_BARRIDO (?,?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$mes);
            $query->bindValue(2,$year);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        /* TODO: Listar Registros */
        public function get_tarjetas(){
            $conectar=parent::Conexion();
            $sql="call SP_L_TARJETA_01 ()";
            $query=$conectar->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        public function get_tarjetas_v(){
            $conectar=parent::Conexion();
            $sql="call SP_L_TARJETA_02 ()";
            $query=$conectar->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        public function get_movimientos($tar_id){
            $conectar=parent::Conexion();
            $sql="call SP_L_TARJETA_03 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$tar_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        public function get_traspasos_d($tar_id){
            $conectar=parent::Conexion();
            $sql="call SP_L_TARJETA_04 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$tar_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        public function get_traspasos_r($tar_id){
            $conectar=parent::Conexion();
            $sql="call SP_L_TARJETA_05 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$tar_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        public function get_traspasos($tar_id){
            $conectar=parent::Conexion();
            $sql="call SP_L_TARJETA_06 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$tar_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        public function get_saldo_tarjetas(){
            $conectar=parent::Conexion();
            $sql="call SP_L_TARJETA_07 ()";
            $query=$conectar->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        public function barrido($tar_id,$saldo_tarjeta){
            $conectar=parent::Conexion();
            $sql="call SP_BARRIDO (?,?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$tar_id);
            $query->bindValue(2,$saldo_tarjeta);
            $query->execute();
        }

        /* TODO: Listar Registro por ID en especifico */
        public function get_tarjeta_det($del_id){
            $conectar=parent::Conexion();
            $sql="call SP_L_DELEGACION_02 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$del_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        /* TODO: Combo Direccion */
        public function get_tarjeta_x_vehiculo($dir_id){
            $conectar=parent::Conexion();
            $sql="call SP_L_DELEGACION_03 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$dir_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        /* TODO: Eliminar o cambiar estado a eliminado */
        public function delete_tarjeta($tar_id){
            $conectar=parent::Conexion();
            $sql="call SP_D_TARJETA_01 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$tar_id);
            $query->execute();
        }

        

        
    }
?>