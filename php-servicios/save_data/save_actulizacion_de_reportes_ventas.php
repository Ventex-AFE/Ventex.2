<?php
session_start();

require_once('../Conexion_db/conexion_usser_changes.php');

// Verificar que los campos del formulario no estén vacíos
if (empty($_POST['Nombre_Cliente']) || empty($_POST['Fecha']) || empty($_POST['Hora']) 
    || empty($_POST['Total'])) {
    header('Location: ../../Frames/Pantalla-Edit-Reporte-venta.php');
    exit();
}

// Recoger los datos del formulario y evitar inyección SQL
$idup = $_POST['id_Reporte_update'];
$Nombre_cliente = mysqli_real_escape_string($Conexion_usser_changes, $_POST['Nombre_Cliente']);
$Descripcion = mysqli_real_escape_string($Conexion_usser_changes, $_POST['Descripcion']);
$Fecha = mysqli_real_escape_string($Conexion_usser_changes, $_POST['Fecha']);
$Hora = mysqli_real_escape_string($Conexion_usser_changes, $_POST['Hora']);
$Total = mysqli_real_escape_string($Conexion_usser_changes, $_POST['Total']);


// Obtener el nombre del vendedor de la sesión

// Consulta SQL para actualizar los datos
$sql = "UPDATE regristroventa SET   Usuario_Venta= ?, Descripcio=?, fecha=?, hora=?, total=? WHERE ID_Venta = ?";
$stmt = mysqli_prepare($Conexion_usser_changes, $sql);

// Verificar si la preparación de la consulta tuvo éxito
if (!$stmt) {
    exit('Error en la preparación de la consulta: ' . mysqli_error($Conexion_usser_changes));
}
echo $Nombre_cliente,$Descripcion, $Fecha, $Hora, $Total, $idup;
// Asociar parámetros con la consulta preparada
mysqli_stmt_bind_param($stmt, "ssssii", $Nombre_cliente,$Descripcion, $Fecha, $Hora, $Total, $idup);

// Ejecutar la consulta preparada
$envio = mysqli_stmt_execute($stmt);

// Verificar si la ejecución fue exitosa
if (!$envio) {
    echo 'Error de MySQL: ' . mysqli_error($Conexion_usser_changes);
} else {
    // Redireccionar a la página de inicio de sesión si la actualización fue exitosa
    header('Location: ../../Frames/pantalla-reportes_ventas.php');
    exit();
}

// Cerrar la conexión a la base de datos
mysqli_close($Conexion_usser_changes);
?>
