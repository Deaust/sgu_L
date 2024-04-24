<?php

    require_once("../config/conexion.php");
    require_once("../models/Resguardo.php");

    $resguardo = new Resguardo();

    switch($_GET["op"]){

        case "insertar_sistema":
            $resguardo->insertar_sistema($_POST["id_sistema"],$_FILES['files']['name'][0]);

            $countfiles = count($_FILES['files']['name']);
            $ruta = "../public/document/resguardos/sistemas/resguardo-".$_POST["id_sistema"]."/";
            $files_arr = array();

            if (!file_exists($ruta)) {
                mkdir($ruta, 0777, true);
            }

            for ($index = 0; $index < $countfiles; $index++) {
                $doc1 = $_FILES['files']['tmp_name'][$index];
                $destino = $ruta.$_FILES['files']['name'][$index];                           

                move_uploaded_file($doc1,$destino);
            }
            
            break;  

        case "resguardo_x_sistema":
            
            break;
    }
?>