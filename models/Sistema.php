<?php
    class Sistema extends Conectar{

        public function get_sistemas(){
            $conectar=parent::Conexion();
            $sql="SP_L_SISTEMA_01";
            $query=$conectar->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        public function listar_sistemas(){
            $conectar=parent::Conexion();
            $sql="SP_L_SISTEMA_01";
            $query=$conectar->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        public function insert_sistema($personal,$sistema){
            $conectar=parent::Conexion();
            $sql="SP_I_SISTEMA_02 ?,?";
            $query=$conectar->prepare($sql);            
            $query->bindValue(1,$personal);
            $query->bindValue(2,$sistema);
            $query->execute();
        }

    }
?>