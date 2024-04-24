<?php
    class Delegacion extends Conectar{

        /* TODO: Registro de datos */
        public function insert_delegacion($del_nom,$dir_id){
            $conectar=parent::Conexion();
            $sql="call SP_I_DELEGACION_01 (?,?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$del_nom);
            $query->bindValue(2,$dir_id);
            $query->execute();
        }

        /* TODO:Actualizar Datos */
        public function update_delegacion($del_id,$del_nom,$dir_id){
            $conectar=parent::Conexion();
            $sql="call SP_U_DELEGACION_01 (?,?,?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$del_id);
            $query->bindValue(2,$del_nom);
            $query->bindValue(3,$dir_id);
            $query->execute();
        }

        /* TODO: Listar Registros */
        public function get_delegaciones(){
            $conectar=parent::Conexion();
            $sql="SP_L_DELEGACION_01";
            $query=$conectar->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        /* TODO: Listar Registro por ID en especifico */
        public function get_delegacion_det($del_id){
            $conectar=parent::Conexion();
            $sql="call SP_L_DELEGACION_02 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$del_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        /* TODO: Combo Direccion */
        public function get_delegacion_x_direccion($dir_id){
            $conectar=parent::Conexion();
            $sql="call SP_L_DELEGACION_03 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$dir_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        /* TODO: Eliminar o cambiar estado a eliminado */
        public function delete_delegacion($del_id){
            $conectar=parent::Conexion();
            $sql="call SP_D_DELEGACION_01 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$del_id);
            $query->execute();
        }

        

        
    }
?>