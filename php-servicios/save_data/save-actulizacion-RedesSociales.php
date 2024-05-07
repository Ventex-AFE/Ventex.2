<?php
session_start();

require_once('../Conexion_db/conexion_usser_changes.php');

// Verificar que los campos del formulario no estén vacíos
if (empty($_POST['description']) || empty($_POST['whatsapp']) || empty($_POST['x']) || empty($_POST['facebook']) || empty($_POST['instagram']) || empty($_POST['contact_info'])) {
    header('Location: ../../Frames/Pantalla-Edit-RedesSocial.php');
    exit();
}

// Recoger los datos del formulario y evitar inyección SQL
$idup = $_SESSION['id'];
$profileD = mysqli_real_escape_string($Conexion_usser_changes, $_POST['description']);
$WhatsAppup = mysqli_real_escape_string($Conexion_usser_changes, $_POST['whatsapp']);
$x = mysqli_real_escape_string($Conexion_usser_changes, $_POST['x']);
$Instagram = mysqli_real_escape_string($Conexion_usser_changes, $_POST['instagram']);
$Contactdescription = mysqli_real_escape_string($Conexion_usser_changes, $_POST['contact_info']);
$facebook = mysqli_real_escape_string($Conexion_usser_changes, $_POST['facebook']);

// Obtener el nombre del vendedor de la sesión
$nombre_seller = $_SESSION['name'];

// Consulta SQL para actualizar los datos
$sql = "UPDATE seller_porfile SET Name_Seller = ?, profile_Description = ?, Contact_description = ?, instagram = ?, x = ?, whatsapp = ?, facebook = ? WHERE Id_sellerP = ?";
$stmt = mysqli_prepare($Conexion_usser_changes, $sql);

// Verificar si la preparación de la consulta tuvo éxito
if (!$stmt) {
    exit('Error en la preparación de la consulta: ' . mysqli_error($Conexion_usser_changes));
}

// Asociar parámetros con la consulta preparada
mysqli_stmt_bind_param($stmt, "sssssssi", $nombre_seller, $profileD, $Contactdescription, $Instagram, $x, $WhatsAppup, $facebook, $idup);

// Ejecutar la consulta preparada
$envio = mysqli_stmt_execute($stmt);

// Verificar si la ejecución fue exitosa
if (!$envio) {
    echo 'Error de MySQL: ' . mysqli_error($Conexion_usser_changes);
} else {
    // Redireccionar a la página de inicio de sesión si la actualización fue exitosa
    header('Location: ../../Frames/pantalla-Login.html');
    exit();
}

// Cerrar la conexión a la base de datos
mysqli_close($Conexion_usser_changes);
?>
