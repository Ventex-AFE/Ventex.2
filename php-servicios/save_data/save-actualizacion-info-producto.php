<?php
session_start();
//Rrquiero conecxion de mi carpeta de php service
require_once('../Conexion_db/conexion_usser_changes.php');

// Verificar que los campos del formulario no estén vacíos
if (empty($_POST['Nombre_Prod']) || empty($_POST['Precio']) || empty($_POST['categoria']) || empty($_POST['subcategoria']) || empty($_POST['Contactdescription']) || empty($_POST['facebook'])) {
    header('Location: ../../Frames/pantalla-perfil.php');
    exit();
}

//Extraigo los datos de le form con sus respectivos names 
$id_product_modificar = mysqli_real_escape_string($Conexion_usser_changes, $_POST['id_Product_update']); // id del prodcuto a modicar
// Datos que se quiern cambiar al producto {
$Nombre_produc= mysqli_real_escape_string($Conexion_usser_changes,$_POST['Nombre_Prod']);
$Descripcion_product = mysqli_real_escape_string($Conexion_usser_changes, $_POST['']);
$precio = mysqli_real_escape_string($Conexion_usser_changes, $_POST['Precio']);
$Categoria = mysqli_real_escape_string($Conexion_usser_changes, $_POST['categoria']);
$subcategoria = mysqli_real_escape_string($Conexion_usser_changes, $_POST['subcategoria']);
//} fin de los datos del form

// Consulta SQL para actualizar los datos
/*
Id_usser_regristro
Nombre_Prod
Descripcion
Precio
Categoria
Subcategoria
Imagen*/

$sql = "UPDATE productos SET Nombre_Prod = ?, Descripcion = ?, Precio = ?, Categoria = ?, Subcategoria = ? WHERE ID_Producto = ?";
$stmt = mysqli_prepare($Conexion_usser_changes, $sql);

// Verificar si la preparación de la consulta tuvo éxito
if (!$stmt) {
    exit('Error en la preparación de la consulta: ' . mysqli_error($Conexion_usser_changes));
}

// Asociar parámetros con la consulta preparada
mysqli_stmt_bind_param($stmt, "ssissi", $Nombre_produc, $Contactdescription, $Instagram, $x, $WhatsAppup, $facebook, $idup);

// Ejecutar la consulta preparada
$envio = mysqli_stmt_execute($stmt);

// Cerrar la conexión a la base de datos
mysqli_close($Conexion_usser_changes);

// Verificar si la ejecución fue exitosa
if (!$envio) {
    echo 'Error de MySQL: ' . mysqli_error($Conexion_usser_changes);
} else {
    header('Location: Inicios.html');
}


?>