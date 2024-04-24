<?php
    class Direccion extends Conectar{

        /* TODO: Registro de datos */
        public function insert_direccion($dir_nom){
            $conectar=parent::Conexion();
            $sql="call SP_I_DIRECCION_01 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$dir_nom);
            $query->execute();
        }

        /* TODO:Actualizar Datos */
        public function update_direccion($dir_id,$dir_nom){
            $conectar=parent::Conexion();
            $sql="call SP_U_DIRECCION_01 (?,?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$dir_id);
            $query->bindValue(2,$dir_nom);
            $query->execute();
        }

        /* TODO: Listar Registros */
        public function get_direcciones(){
            $conectar=parent::Conexion();
            $sql="call SP_L_DIRECCION_01 ()";
            $query=$conectar->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        /* TODO: Listar Registro por ID en especifico */
        public function get_direccion_det($dir_id){
            $conectar=parent::Conexion();
            $sql="call SP_L_DIRECCION_02 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$dir_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        
        /* TODO: Eliminar o cambiar estado a eliminado */
        public function delete_direccion($dir_id){
            $conectar=parent::Conexion();
            $sql="call SP_D_DIRECCION_01 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$dir_id);
            $query->execute();
        }

        
    }
?>