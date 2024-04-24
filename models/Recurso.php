<?php
    class Recurso extends Conectar{


        public function listar_recurso(){
            $conectar=parent::Conexion();
            $sql="SP_L_BIEN_01";
            $query=$conectar->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

    }
?>