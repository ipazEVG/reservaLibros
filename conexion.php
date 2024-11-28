<?php
$conexion = new mysqli('localhost', 'root', '', 'proyectoreserva');

$error = $conexion -> connect_error;  //Devuelve una cadena que va a describir el error de conexión.
$errno = $conexion -> connect_errno;  //Devuelve el numero del error de conexión.

//Verificar si hay un error de conexión
if ($errno){
 echo "Error al conectar con la base de datos: (" .$errno. ") " .$error;
    exit;
}else{
   echo "Conexión exitosa a la base de datos."; 
}

?> 
