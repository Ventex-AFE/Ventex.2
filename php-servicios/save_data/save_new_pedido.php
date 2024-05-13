<?php
session_start();
require_once('../Conexion_db/conexion_usser_changes.php');

if (empty($_POST['nombre_producto']) || empty($_POST['id_producto']) || empty($_POST['nombre_cliente']) || empty($_POST['hora_entrega']) || empty($_POST['fecha_entrega']) || empty($_POST['direccion_entrega'])  || empty($_POST['descripcion_pedido']) || empty($_POST['cantidad_producto']) || empty($_POST['precio_producto'])) {
    echo "Todos los campos son obligatorios. Por favor, complete el formulario.";
    header('Location: ../../Frames/pantalla-pedidos.php');
    exit; // Detener la ejecución del script si hay campos vacíos
}

$Id_usser_regristro = 1;
$nameProduct = mysqli_real_escape_string($Conexion_usser_changes, $_POST['nombre_producto']);
$id_product = mysqli_real_escape_string($Conexion_usser_changes, $_POST['id_producto']);
$Nombre_cliente = mysqli_real_escape_string($Conexion_usser_changes, $_POST['nombre_cliente']);
$hora = mysqli_real_escape_string($Conexion_usser_changes, $_POST['hora_entrega']);
$fecha_Entrega = mysqli_real_escape_string($Conexion_usser_changes, $_POST['fecha_entrega']);
$direccion_entrega = mysqli_real_escape_string($Conexion_usser_changes, $_POST['direccion_entrega']);
$descripcion_report = mysqli_real_escape_string($Conexion_usser_changes, $_POST['descripcion_pedido']);
$cantidad_producto = mysqli_real_escape_string($Conexion_usser_changes, $_POST['cantidad_producto']);
$precio_producto = mysqli_real_escape_string($Conexion_usser_changes, $_POST['precio_producto']);

// Preparar la sentencia
$sentence = "INSERT INTO pedidos (Nombre_pedido, Id_usser_regristro, ID_producto, usuario_cliente, fecha, hora, lugar, cantidad, precio, descripcion) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($Conexion_usser_changes, $sentence);

// Vincular parámetros
mysqli_stmt_bind_param($stmt, "siissssiis", 
    $nameProduct, 
    $Id_usser_regristro, 
    $id_product, 
    $Nombre_cliente, 
    $fecha_Entrega, 
    $hora, 
    $direccion_entrega, 
    $cantidad_producto, 
    $precio_producto,
    $descripcion_report
);

// Ejecutar la sentencia
$guardar = mysqli_stmt_execute($stmt);

if (!$guardar) {
    echo "Error al guardar los datos en la base de datos: " . mysqli_error($Conexion_usser_changes);
} else {
    $_SESSION['logged'] = true;
    header('Location: ../../Frames/pantalla-pedidos.php');
}

// Cerrar la sentencia
mysqli_stmt_close($stmt);
mysqli_close($Conexion_usser_changes);
?>
