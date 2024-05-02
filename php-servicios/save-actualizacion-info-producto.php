<?php
session_start();
// Credenciales de acceso a la base de datos
$hostname = ''; //Url de la direccion dela base de datos 
$username = ''; //Usuario que se uso para esta conexion y la verifcacion 
$password = ''; //Password del usuario 
$database = 'ventex'; //nombre de la db

$Conexion = mysqli_connect($hostname, $username, $password, $database);
if (mysqli_connect_error()) {
    exit('Fallo en la conexión de MySQL: ' . mysqli_connect_error());
}
$Nombre_produc= mysqli_real_escape_string($Conexion,$_POST['Nombre_Prod']);
$precio = $_POST['Precio'];
$Categoria = $_POST['categoria'];
$subcategoria = $_POST['subcategoria'];

?>