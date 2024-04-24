<?php
    class Resguardo extends Conectar{

        public function insertar_sistema($procedimiento,$documento){
            $conectar= parent::conexion();
            $sql="SP_I_RESGUARDO_01 ?,?";
            $query=$conectar->prepare($sql);
            $query->bindValue(1, $procedimiento);
            $query->bindValue(2, $documento);
            $query->execute();
        }

    }
?>