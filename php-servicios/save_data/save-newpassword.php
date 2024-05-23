<?php
session_start();
require_once('../Conexion_db/conexion_usser_changes.php');

$correo = mysqli_real_escape_string($Conexion_usser_changes, $_POST['email']);
$contrasena = mysqli_real_escape_string($Conexion_usser_changes, $_POST['password']);

// Obtener el ID del usuario usando el correo electrónico
if ($Result = $Conexion_usser_changes->prepare('SELECT ID_Usuario FROM usuarioregistrado WHERE Correo = ?')) {
    $Result->bind_param('s', $correo);
    $Result->execute();
    $Result->bind_result($id_usuario);
    $Result->fetch();
    $Result->close();

    if ($id_usuario) {
        // Cambiar la contraseña del usuario 
        $new_hash = password_hash($contrasena, PASSWORD_DEFAULT, ['cost' => 15]);

        // Actualizar la contraseña del usuario en la base de datos
        if ($Update = $Conexion_usser_changes->prepare('UPDATE usuarioregistrado SET Pass = ? WHERE ID_Usuario = ?')) {
            $Update->bind_param('si', $new_hash, $id_usuario);
            $Update->execute();
            $Update->close();

            // Redirigir al usuario a la página de éxito
            header('Location: ../../Frames/pantalla-Login.html');
            exit();
        } else {
            // Error al actualizar la contraseña
            echo 'Paaaarrr';
            //header('Location: ../../Frames/Pantalla-Forget-Password.php');
            exit();
        }
    } else {
        // Usuario no encontrado
        echo 'Paaaarrr';
        // header('Location: ../../Frames/Pantalla-Forget-Password.php');
        
        exit();
    }
} else {
    // Error al preparar la consulta para obtener el ID de usuario
    //header('Location: ../../Frames/Pantalla-Forget-Password.php');
    echo 'patooooo';
    exit();
}

$Conexion_usser_changes->close();
?>
