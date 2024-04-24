<?php
    class Rol extends Conectar{
        /* TODO: Listar Registros */
        public function get_rol_x_suc_id(){
            $conectar=parent::Conexion();
            $sql="call SP_L_ROL_01";
            $query=$conectar->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        /* TODO: Listar Registro por ID en especifico */
        public function get_rol_x_rol_id($rol_id){
            $conectar=parent::Conexion();
            $sql="call SP_L_ROL_02 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$rol_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        /* TODO: Eliminar o cambiar estado a eliminado */
        public function delete_rol($rol_id){
            $conectar=parent::Conexion();
            $sql="call SP_D_ROL_01 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$rol_id);
            $query->execute();
        }

        /* TODO: Registro de datos */
        public function insert_rol($rol_nom){
            $conectar=parent::Conexion();
            $sql="call SP_I_ROL_01 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$rol_nom);
            $query->execute();
        }

        /* TODO:Actualizar Datos */
        public function update_rol($rol_id,$rol_nom){
            $conectar=parent::Conexion();
            $sql="call SP_U_ROL_01 (?,?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$rol_id);
            $query->bindValue(2,$rol_nom);
            $query->execute();
        }

        public function validar_acceso_1($usu_id){
            $conectar=parent::Conexion();
            $sql="call SP_L_ROL_01 (?)";
            $stmt=$conectar->prepare($sql);
            $stmt->bindValue(1,$usu_id);
            $stmt->execute();
            return $resultado=$stmt->fetchAll();
        }

        public function validar_acceso_2($usu_id){
            $conectar=parent::Conexion();
            $sql="call SP_L_ROL_02 (?)";
            $stmt=$conectar->prepare($sql);
            $stmt->bindValue(1,$usu_id);
            $stmt->execute();
            return $resultado=$stmt->fetchAll();
        }

        public function validar_acceso_3($usu_id){
            $conectar=parent::Conexion();
            $sql="call SP_L_ROL_03 (?)";
            $stmt=$conectar->prepare($sql);
            $stmt->bindValue(1,$usu_id);
            $stmt->execute();
            return $resultado=$stmt->fetchAll();
        }

        public function validar_acceso_4($usu_id){
            $conectar=parent::Conexion();
            $sql="call SP_L_ROL_04 (?)";
            $stmt=$conectar->prepare($sql);
            $stmt->bindValue(1,$usu_id);
            $stmt->execute();
            return $resultado=$stmt->fetchAll();
        }
    }
?>