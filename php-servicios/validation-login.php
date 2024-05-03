<?php
session_start();

require('../php-servicios/Conexion_db/conexion_usser_select.php');

if (!isset($_POST['correo'], $_POST['contra'])) {
    header('Location: Incios.html');
    exit;
}

// Escapar caracteres especiales en correo y contraseña
$correo = mysqli_real_escape_string($Conexion_usser_select, $_POST['correo']);
$contra = mysqli_real_escape_string($Conexion_usser_select, $_POST['contra']);

if ($Result = $Conexion_usser_select->prepare('SELECT ID_Usuario, Nombre_Us, Correo, Pass, Fecha_Nac, Celular, Imagen FROM usuarioregistrado WHERE Correo = ?')) {
    $Result->bind_param('s', $correo);
    $Result->execute();
} else {
    die('Error en la preparación de la consulta');
}

$Result->store_result();

if ($Result->num_rows > 0) {
    $Result->bind_result($id, $name, $email, $hash_password, $birthdate, $phone, $img);
    $Result->fetch();

    if (password_verify($contra, $hash_password)) {
        session_regenerate_id();
        $_SESSION['loggedin'] = TRUE;
        $_SESSION['name'] = $name;
        $_SESSION['birthdate'] = $birthdate;
        $_SESSION['phone'] = $phone;
        $_SESSION['id'] = $id;
        $_SESSION['email'] = $email;
        $_SESSION['img'] = $img;
        header('Location: perfil.php');
        exit;
    } else {
        // Mensaje de error genérico
        header('Location: Incios.php?error=1');
        exit;
    }
} else {
    // Mensaje de error genérico
    header('Location: Incios.html?error=2');
    exit;
}

$Result->close();
$Conexion_usser_select->close();
?>
