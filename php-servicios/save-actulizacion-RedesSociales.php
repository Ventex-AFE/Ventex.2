<?php
session_start();

// Variables de credenciales de acceso a la base de datos
$hostname = ''; // URL del servidor de la base de datos
$username = ''; // Nombre de usuario de la base de datos
$password = ''; // Contraseña del usuario de la base de datos
$database = ''; // Nombre de la base de datos

// Conexión a la base de datos
$Conexion = mysqli_connect($hostname, $username, $password, $database);

// Verificar la conexión
if (mysqli_connect_error()) {
    exit('Fallo en la conexión de MySQL: ' . mysqli_connect_error());
}

// Verificar que los campos del formulario no estén vacíos
if (empty($_POST['profileD']) || empty($_POST['WhatsAppup']) || empty($_POST['x']) || empty($_POST['Instagram']) || empty($_POST['Contactdescription']) || empty($_POST['facebook'])) {
    header('Location: registropaw.html');
    exit();
}

// Recoger los datos del formulario y evitar inyección SQL
$idup = mysqli_real_escape_string($Conexion, $_POST['ideup']);
$profileD = mysqli_real_escape_string($Conexion, $_POST['profileD']);
$WhatsAppup = mysqli_real_escape_string($Conexion, $_POST['WhatsAppup']);
$x = mysqli_real_escape_string($Conexion, $_POST['x']);
$Instagram = mysqli_real_escape_string($Conexion, $_POST['Instagram']);
$Contactdescription = mysqli_real_escape_string($Conexion, $_POST['Contactdescription']);
$facebook = mysqli_real_escape_string($Conexion, $_POST['facebook']);

// Consulta SQL para actualizar los datos
$sql = "UPDATE sellerprofile SET profileDescription = ?, Contactdescription = ?, instagram = ?, x = ?, whatsapp = ?, facebook = ? WHERE idddfi = ?";
$stmt = mysqli_prepare($Conexion, $sql);

// Verificar si la preparación de la consulta tuvo éxito
if (!$stmt) {
    exit('Error en la preparación de la consulta: ' . mysqli_error($Conexion));
}

// Asociar parámetros con la consulta preparada
mysqli_stmt_bind_param($stmt, "ssssssi", $profileD, $Contactdescription, $Instagram, $x, $WhatsAppup, $facebook, $idup);

// Ejecutar la consulta preparada
$envio = mysqli_stmt_execute($stmt);

// Cerrar la conexión a la base de datos
mysqli_close($Conexion);

// Verificar si la ejecución fue exitosa
if (!$envio) {
    echo 'Error de MySQL: ' . mysqli_error($Conexion);
} else {
    header('Location: Inicios.html');
}
?>
