<?php
    class Cargo extends Conectar{

        /* TODO: Listar Registros */
        public function get_cargos(){
            $conectar=parent::Conexion();
            $sql="SP_L_CARGO_01";
            $query=$conectar->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        
    }
?>