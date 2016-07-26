<?php
    function conectar()
        { //verificacion del acceso al servidor
           $conexion=mysqli_connect("localhost","root","","todo");
           mysqli_set_charset($conexion, "utf8");
           
           return $conexion;
        }
    
    $conectar = conectar(); //llamar a la funcion de conectarse
?>