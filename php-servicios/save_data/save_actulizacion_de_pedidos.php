<?php
session_start();

require_once('../Conexion_db/conexion_usser_changes.php');

// Verificar que los campos del formulario no estén vacíos
if (empty($_POST['Nombre_Cliente']) || empty($_POST['Fecha']) || empty($_POST['Hora']) 
    || empty($_POST['Lugar']) || empty($_POST['Cantidad']) || empty($_POST['Precio']) || empty($_POST['Descripcion'])) {
   // header('Location: ../../Frames/Pantalla-Edit-Pedido.php');
    exit();
}

// Recoger los datos del formulario y evitar inyección SQL
$idup = $_POST['id_Pedidos_update'];
$Nombre_cliente = mysqli_real_escape_string($Conexion_usser_changes, $_POST['Nombre_Cliente']);
$Fecha = mysqli_real_escape_string($Conexion_usser_changes, $_POST['Fecha']);
$Hora = mysqli_real_escape_string($Conexion_usser_changes, $_POST['Hora']);
$Lugar = mysqli_real_escape_string($Conexion_usser_changes, $_POST['Lugar']);
$Cantidad = mysqli_real_escape_string($Conexion_usser_changes, $_POST['Cantidad']);
$Precio = mysqli_real_escape_string($Conexion_usser_changes, $_POST['Precio']);
$Descripcion = mysqli_real_escape_string($Conexion_usser_changes, $_POST['Descripcion']);

// Obtener el nombre del vendedor de la sesión

// Consulta SQL para actualizar los datos
$sql = "UPDATE pedidos SET  usuario_cliente = ?, fecha = ?, hora = ?,  lugar=?, cantidad=?,	precio=?, descripcion=? WHERE ID_pedido = ?";
$stmt = mysqli_prepare($Conexion_usser_changes, $sql);

// Verificar si la preparación de la consulta tuvo éxito
if (!$stmt) {
    exit('Error en la preparación de la consulta: ' . mysqli_error($Conexion_usser_changes));
}
echo $Nombre_cliente, $Fecha, $Hora, $Lugar, $Cantidad, $Precio, $Descripcion, $idup;
// Asociar parámetros con la consulta preparada
mysqli_stmt_bind_param($stmt, "ssssiisi", $Nombre_cliente, $Fecha, $Hora, $Lugar, $Cantidad, $Precio, $Descripcion, $idup);

// Ejecutar la consulta preparada
$envio = mysqli_stmt_execute($stmt);

// Verificar si la ejecución fue exitosa
if (!$envio) {
    echo 'Error de MySQL: ' . mysqli_error($Conexion_usser_changes);
} else {
    // Redireccionar a la página de inicio de sesión si la actualización fue exitosa
    //header('Location: ../../Frames/pantalla-pedidos.php');
    exit();
}

// Cerrar la conexión a la base de datos
mysqli_close($Conexion_usser_changes);
?>
