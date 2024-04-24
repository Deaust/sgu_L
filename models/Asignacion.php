<?php
    class Asignacion extends Conectar{

        /* Asignacion Usuario */
        public function asignacion_usuario($usu_id,$vehi_id){
            $conectar=parent::Conexion();
            $sql="call SP_I_ASIGNACION_01 (?,?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$usu_id);
            $query->bindValue(2,$vehi_id);
            $query->execute();
        }

        /* Asignacion Delegacion */
        public function asignacion_delegacion($del_id,$vehi_id){
            $conectar=parent::Conexion();
            $sql="call SP_I_ASIGNACION_02 (?,?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$del_id);
            $query->bindValue(2,$vehi_id);
            $query->execute();
        }

        /* Asignacion Tarjeta */
        public function asignacion_tarjeta($tar_id,$vehi_id){
            $conectar=parent::Conexion();
            $sql="call SP_I_ASIGNACION_03 (?,?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$tar_id);
            $query->bindValue(2,$vehi_id);
            $query->execute();
        }

        /* TODO:Actualizar Datos */
        public function update_tarjeta($del_id,$del_nom,$dir_id){
            $conectar=parent::Conexion();
            $sql="call SP_U_DELEGACION_01 (?,?,?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$del_id);
            $query->bindValue(2,$del_nom);
            $query->bindValue(3,$dir_id);
            $query->execute();
        }

        /* TODO: Listar Registros */
        public function get_asignacions_usu(){
            $conectar=parent::Conexion();
            $sql="call SP_L_ASIGNACION_01 ()";
            $query=$conectar->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        

        /* TODO: Listar Registros */
        public function get_asignacions_del(){
            $conectar=parent::Conexion();
            $sql="call SP_L_ASIGNACION_02 ()";
            $query=$conectar->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

         /* TODO: Listar Registros */
         public function get_asignacions_tar(){
            $conectar=parent::Conexion();
            $sql="call SP_L_ASIGNACION_03 ()";
            $query=$conectar->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        
        
    }
?>