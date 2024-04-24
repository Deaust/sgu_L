<?php
     session_start();

    class Conectar{
            protected $dbh;

            protected function Conexion(){
                try{
                    /* TODO: Cadena de Conexion */
                    $conectar = $this->dbh=new PDO("sqlsrv:Server=.\SQLEXPRESS;Database=SGU","sa","a1a2a3*");
                    return $conectar;
                }catch (Exception $e){
                    /* TODO: En caso de error mostrar mensaje */
                    print "Error Conexion BD: ". $e->getMessage() ."<br/>";
                    die();
                }
            }

            public function set_names(){
                return $this->dbh->query("SET NAMES 'utf8'");
            }

            /* produccion */
            public static function ruta(){
                return "http://localhost/php/sgu/";
            }
    }

?>

