<?php
    require_once ("../config/Config.php");
    class Conexion{
        public function conect(){
            $mysql = new mysqli(server, user, password, database);
            $mysql->set_charset(charset);
            if(mysqli_errno($mysql)){
                echo "Error ".mysqli_errno($mysql)." ,no conectado a la base de datos";
                exit();
            }
            else{
                //echo "Conectado correctamente";
            }
            return $mysql;
        }
    }
    //$prueba = new Conexion();
    //$prueba->conect();
?>
