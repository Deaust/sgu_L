<?php
    class Usuario extends Conectar{

        /* TODO:Acceso al Sistema */
        public function login(){
            $conectar=parent::Conexion();
            if (isset($_POST["enviar"])){
                $correo = $_POST["usu_correo"];
                $pass =  $_POST["usu_pass"];
                if (empty($sucursal) and empty($correo) and empty($pass)){
                }else{
                    $sql="SP_L_USUARIO_01 ?,?";
                    $query=$conectar->prepare($sql);
                    $query->bindValue(1,$correo);
                    $query->bindValue(2,$pass);
                    $query->execute();
                    $resultado = $query->fetch();
                    if (is_array($resultado) and count($resultado)>0){
                        /* TODO:Generar variables de Session del Usuario */
                        $_SESSION["USU_ID"]=$resultado["USU_ID"];
                        $_SESSION["USU_NOM"]=$resultado["USU_NOM"];
                        $_SESSION["USU_APE"]=$resultado["USU_APE"];
                        $_SESSION["USU_CORREO"]=$resultado["USU_CORREO"];
                        $_SESSION["ROL_ID"]=$resultado["ROL_ID"];

                        header("Location:".Conectar::ruta()."view/Home/");
                        
                    }else{
                        header("Location:".Conectar::ruta());
                        exit();
                    }
                }
            }else{
                exit();
            }
        }

        /* TODO:Listar Usuarios */
        public function get_usuario(){
            $conectar=parent::Conexion();
            $sql="SP_L_USUARIO_02";
            $query=$conectar->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        public function get_usuario_x_id($id){
            $conectar=parent::Conexion();
            $sql="SP_L_USUARIO_04 ?";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        public function get_usuario_filtros($delegacion,$departamento,$cargo,$fecha_inicio,$fecha_fin,$inactivos){
            $conectar=parent::Conexion();
            $sql="SP_L_USUARIO_03 ?,?,?,?,?,?";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$delegacion);
            $query->bindValue(2,$departamento);
            $query->bindValue(3,$cargo);
            $query->bindValue(4,$fecha_inicio);
            $query->bindValue(5,$fecha_fin);
            $query->bindValue(6,$inactivos);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        public function get_sistemas_x_usuario($usuario){
            $conectar=parent::Conexion();
            $sql="SP_L_USUARIO_05 ?";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$usuario);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        public function get_resguardo_x_sistema($sistema){
            $conectar=parent::Conexion();
            $sql="SP_L_RESGUARDO_01 ?";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$sistema);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        /* TODO: Registro de datos */
        public function insert_sistema($personal,$sistema,$usuario,$pass,$usuario_in){
            $conectar=parent::Conexion();
            $sql="SP_I_USUARIO_02 ?,?,?,?,?";
            $query=$conectar->prepare($sql);            
            $query->bindValue(1,$personal);
            $query->bindValue(2,$sistema);
            $query->bindValue(3,$usuario);
            $query->bindValue(4,$pass);
            $query->bindValue(5,$usuario_in);
            $query->execute();
        }

        public function get_sistemas(){
            $conectar=parent::Conexion();
            $sql="SP_L_SISTEMA_01";
            $query=$conectar->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        public function insert_usuario($delegacion,$departamento,$cargo,$nombre,$expediente,$usuario){
            $conectar=parent::Conexion();
            $sql="SP_I_USUARIO_01 ?,?,?,?,?,?";
            $query=$conectar->prepare($sql);            
            $query->bindValue(1,$delegacion);
            $query->bindValue(2,$departamento);
            $query->bindValue(3,$cargo);
            $query->bindValue(4,$nombre);
            $query->bindValue(5,$expediente);
            $query->bindValue(6,$usuario);
            $query->execute();
        }

        /* TODO: Eliminar o cambiar estado a eliminado */
        public function delete_usuario($usu_id){
            $conectar=parent::Conexion();
            $sql="SP_D_USUARIO_01 ?";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$usu_id);
            $query->execute();
        }

    }
?>