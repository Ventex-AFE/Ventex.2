<?php
session_start();

require_once('../Conexion_db/conexion_usser_changes.php');

// Verificar que los campos del formulario no estén vacíos
if (empty($_POST['profileD']) || empty($_POST['WhatsAppup']) || empty($_POST['x']) || empty($_POST['Instagram']) || empty($_POST['Contactdescription']) || empty($_POST['facebook'])) {
    header('Location: ../../Frames/Pantalla-Edit-RedesSocial.php');
    exit();
}

// Recoger los datos del formulario y evitar inyección SQL
$idup = mysqli_real_escape_string($Conexion_usser_changes, $_POST['id-usser-update']);
$profileD = mysqli_real_escape_string($Conexion_usser_changes, $_POST['description']);
$WhatsAppup = mysqli_real_escape_string($Conexion_usser_changes, $_POST['whatsapp']);
$x = mysqli_real_escape_string($Conexion_usser_changes, $_POST['x']);
$Instagram = mysqli_real_escape_string($Conexion_usser_changes, $_POST['facebook']);
$Contactdescription = mysqli_real_escape_string($Conexion_usser_changes, $_POST['instagram']);
$facebook = mysqli_real_escape_string($Conexion_usser_changes, $_POST['Información de contacto']);

// Consulta SQL para actualizar los datos
$sql = "UPDATE sellerprofile SET profileDescription = ?, Contactdescription = ?, instagram = ?, x = ?, whatsapp = ?, facebook = ? WHERE idddfi = ?";
$stmt = mysqli_prepare($Conexion_usser_changes, $sql);

// Verificar si la preparación de la consulta tuvo éxito
if (!$stmt) {
    exit('Error en la preparación de la consulta: ' . mysqli_error($Conexion_usser_changes));
}

// Asociar parámetros con la consulta preparada
mysqli_stmt_bind_param($stmt, "ssssssi", $profileD, $Contactdescription, $Instagram, $x, $WhatsAppup, $facebook, $idup);

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
