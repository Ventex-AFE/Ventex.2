<?php
session_start();
require_once('../Conexion_db/conexion_usser_changes.php');

if (empty($_POST['nombre_product']) || empty($_POST['Id_producto']) || empty($_POST['Nombre_Cliente']) || empty($_POST['time']) || empty($_POST['fechaEntrega']) || empty($_POST['descripcion_report'])) {
    echo "Todos los campos son obligatorios. Por favor, complete el formulario.";
    header('Location: ../../Frames/Pantalla-Reportes_Ventas.php');
    exit; // Detener la ejecución del script si hay campos vacíos
}
// 	Id_usser_regristro	Nombre_Prod	Descripción	Precio	Categoría	Subcategoría	Imagen	
$Id_usser_regristro = $_SESSION['id'];
//$Id_usser_regristro = 5;
$nameProduct = mysqli_real_escape_string($Conexion_usser_changes, $_POST['nombre_product']);
$id_product = mysqli_real_escape_string($Conexion_usser_changes, $_POST['Id_producto']);
$Nombre_cliente = mysqli_real_escape_string($Conexion_usser_changes, $_POST['Nombre_Cliente']);
$hora = mysqli_real_escape_string($Conexion_usser_changes, $_POST['time']);
$fecha_Entrega = mysqli_real_escape_string($Conexion_usser_changes, $_POST['fechaEntrega']);
$Total = mysqli_real_escape_string($Conexion_usser_changes, $_POST['Total']);
$descripcion_report = mysqli_real_escape_string($Conexion_usser_changes, $_POST['descripcion_report']);


$sentence = "INSERT INTO regristroventa (Id_usser_regristro, Usuario_Venta, ID_Producto, Nombre_reporte_venta, Descripcio, fecha, hora, total) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

// Preparar la sentencia
$stmt = mysqli_prepare($Conexion_usser_changes, $sentence);

// Vincular parámetros
mysqli_stmt_bind_param($stmt, "isissssi", 
$Id_usser_regristro, $Nombre_cliente, $id_product, $nameProduct, $descripcion_report, $fecha_Entrega, $hora, $Total);

// Ejecutar la sentencia
$guardar = mysqli_stmt_execute($stmt);

if (!$guardar) {
    echo "Error al guardar los datos en la base de datos: " . mysqli_error($Conexion_usser_changes);
} else {
    $_SESSION['logged'] = true;
    header('Location: ../../Frames/Pantalla-Reportes_Ventas.php');
}

// Cerrar la sentencia
mysqli_stmt_close($stmt);
mysqli_close($Conexion_usser_changes);
?>