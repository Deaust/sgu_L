<?php
    class Departamento extends Conectar{

        /* TODO: Listar Registros */
        public function get_departamento(){
            $conectar=parent::Conexion();
            $sql="SP_L_DEPARTAMENTO_01";
            $query=$conectar->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        
    }
?>