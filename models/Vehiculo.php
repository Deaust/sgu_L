<?php
    class Vehiculo extends Conectar{


        /* TODO:Listar Vehiculos */
        public function get_vehiculo(){
            $conectar=parent::Conexion();
            $sql="call SP_L_VEHICULO_01 ()";
            $query=$conectar->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        /* TODO: Listar Registro por ID en especifico */
        public function get_vehiculo_x_usu_id($usu_id){
            $conectar=parent::Conexion();
            $sql="call SP_L_VEHICULO_02 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$usu_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        /* TODO: Registro de datos */
        public function insert_vehiculo($vehi_marca,$vehi_tipo,$vehi_modelo,$vehi_placas,$vehi_ns,$vehi_color){
            $conectar=parent::Conexion();
            $sql="call SP_I_VEHICULO_01 (?,?,?,?,?,?)";
            $query=$conectar->prepare($sql);            
            $query->bindValue(1,$vehi_marca);
            $query->bindValue(2,$vehi_tipo);
            $query->bindValue(3,$vehi_modelo);
            $query->bindValue(4,$vehi_placas);
            $query->bindValue(5,$vehi_ns);
            $query->bindValue(6,$vehi_color);
            $query->execute();
        }

        /* TODO:Actualizar Datos */
        public function update_vehiculo($vehi_id,$vehi_marca,$vehi_tipo,$vehi_modelo,$vehi_placas,$vehi_ns,$vehi_color){
            $conectar=parent::Conexion();
            $sql="call SP_U_VEHICULO_01 (?,?,?,?,?,?,?)";
            $query=$conectar->prepare($sql);            
            $query->bindValue(1,$vehi_id);
            $query->bindValue(2,$vehi_marca);
            $query->bindValue(3,$vehi_tipo);
            $query->bindValue(4,$vehi_modelo);
            $query->bindValue(5,$vehi_placas);
            $query->bindValue(6,$vehi_ns);
            $query->bindValue(7,$vehi_color);
            $query->execute();
        }

        /* TODO: Eliminar o cambiar estado a eliminado */
        public function delete_vehiculo($vehi_id){
            $conectar=parent::Conexion();
            $sql="call SP_D_VEHICULO_01 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$vehi_id);
            $query->execute();
        }

        /* TODO:Asignacion usuario */
        public function asignacion_usuario($usu_id_asig,$vehi_id){
            $conectar=parent::Conexion();
            $sql="call SP_U_VEHICULO_02 (?,?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$usu_id_asig);
            $query->bindValue(2,$vehi_id);
            $query->execute();
        }

        /* TODO:Asignacion delegacion */
        public function asignacion_delegacion($del_id,$vehi_id){
            $conectar=parent::Conexion();
            $sql="call SP_U_VEHICULO_03 (?,?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$del_id);
            $query->bindValue(2,$vehi_id);
            $query->execute();
        }

        /* TODO:Asignacion tarjeta */
        public function asignacion_tarjeta($tar_id,$vehi_id){
            $conectar=parent::Conexion();
            $sql="call SP_U_VEHICULO_04 (?,?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$tar_id);
            $query->bindValue(2,$vehi_id);
            $query->execute();
        }

        /* TODO: Listar Registro por ID en especifico */
        public function get_vehiculo_x_vehi_id($vehi_id){
            $conectar=parent::Conexion();
            $sql="call SP_L_VEHICULO_02 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$vehi_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        /* TODO: Listar Registro por ID en especifico */
        public function get_placa_x_usu($vehi_id){
            $conectar=parent::Conexion();
            $sql="call SP_L_VEHICULO_03 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$vehi_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

    }
?>