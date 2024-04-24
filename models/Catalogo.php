<?php
    class Catalogo extends Conectar{

        public function listar_general ($catalogo){
            $conectar=parent::Conexion();
                if ($catalogo === "Clasificacion"){
                    $sql="SP_L_CATALOGO_01";
                }else if ($catalogo === "Color"){
                    $sql="SP_L_CATALOGO_02";
                }else if ($catalogo === "Delegacion"){
                    $sql="SP_L_CATALOGO_03";
                }else if ($catalogo === "Departamento"){
                    $sql="SP_L_CATALOGO_04";
                }else if ($catalogo === "Direccion"){
                    $sql="SP_L_CATALOGO_05";
                }else if ($catalogo === "EdoFisico"){
                    $sql="SP_L_CATALOGO_06";
                }else if ($catalogo === "Estatus"){
                    $sql="SP_L_CATALOGO_07";
                }else if ($catalogo === "Marca"){
                    $sql="SP_L_CATALOGO_08";
                }else if ($catalogo === "Material"){
                    $sql="SP_L_CATALOGO_09";
                }else if ($catalogo === "Proveedor"){
                    $sql="SP_L_CATALOGO_10";
                }else if ($catalogo === "Puesto"){
                    $sql="SP_L_CATALOGO_11";
                }else if ($catalogo === "TipoBien"){
                    $sql="SP_L_CATALOGO_12";
                }else if ($catalogo === "TipoRecurso"){
                    $sql="SP_L_CATALOGO_13";
                }
            
            $query=$conectar->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>