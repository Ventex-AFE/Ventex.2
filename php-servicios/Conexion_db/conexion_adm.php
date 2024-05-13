<?php
// Credenciales de acceso a la base de datos
$hostname = '127.0.0.1'; //Url de la direccion dela base de datos 
$username = 'root'; //Usuario que se uso para esta conexion y la verifcacion 
$password = ''; //Password del usuario 
$database = 'ventexafe'; //nombre de la db

// Conexión a la base de datos
$Conexion_adm_root = mysqli_connect($hostname, $username, $password, $database);

// Verificar la conexión
if (mysqli_connect_error()) {
    exit('Fallo en la conexión de MySQL: ' . mysqli_connect_error());
}else{
    //echo'Conexion is look well :D 1';
}
?>