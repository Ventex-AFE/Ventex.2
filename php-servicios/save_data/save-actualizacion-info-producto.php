<?php
session_start();
// Requiere conexión de la carpeta de servicios PHP
require_once('../Conexion_db/conexion_usser_changes.php');

// Verificar que los campos del formulario no estén vacíos
if (empty($_POST['Nombre_Prod']) || empty($_POST['Precio']) || empty($_POST['product_category']) || empty($_POST['product_subcategory']) || empty($_POST['Descripcion']) ) {
    header('Location: ../../Frames/pantalla-perfil.php');
    exit();
}

// Extraer los datos del formulario con sus respectivos names 
$id_product_modificar = $_POST['id_Product_update']; // id del producto a modificar
// Datos que se quieren cambiar al producto
$Nombre_produc = mysqli_real_escape_string($Conexion_usser_changes, $_POST['Nombre_Prod']);
$Descripcion_product = mysqli_real_escape_string($Conexion_usser_changes, $_POST['Descripcion']);
$precio = mysqli_real_escape_string($Conexion_usser_changes, $_POST['Precio']);
$Categoria = mysqli_real_escape_string($Conexion_usser_changes, $_POST['product_category']);
$subcategoria = mysqli_real_escape_string($Conexion_usser_changes, $_POST['product_subcategory']);

// Consulta SQL para actualizar los datos
$sql = "UPDATE productos SET Nombre_Prod = ?, Descripcion = ?, Precio = ?, Categoria = ?, Subcategoria = ? WHERE ID_Producto = ?";
$stmt = mysqli_prepare($Conexion_usser_changes, $sql);

// Verificar si la preparación de la consulta tuvo éxito
if (!$stmt) {
    exit('Error en la preparación de la consulta: ' . mysqli_error($Conexion_usser_changes));
}

// Asociar parámetros con la consulta preparada
mysqli_stmt_bind_param($stmt, "ssissi", $Nombre_produc, $Descripcion_product, $precio, $Categoria, $subcategoria, $id_product_modificar);
// Ejecutar la consulta preparada
$envio = mysqli_stmt_execute($stmt);

// Verificar si la ejecución fue exitosa
if (!$envio) {
    echo 'Error de MySQL: ' . mysqli_error($Conexion_usser_changes);
} else {

   header('Location: ../../Frames/pantalla-perfil.php');
   exit();
}

// Cerrar la conexión a la base de datos
mysqli_stmt_close($stmt);
mysqli_close($Conexion_usser_changes);
?>
