<?php
    class Grafico extends Conectar{

        /* TODO: Listar Registros */
        public function gasto_x_usuario($mes){
            $conectar=parent::Conexion();
            $sql="call SP_L_GRAFICO_01 (?)";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$mes);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

                
    }
?>