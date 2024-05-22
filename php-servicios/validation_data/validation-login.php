<?php
session_start();
require('../Conexion_db/conexion_usser_select.php');

function showAlertAndRedirect($message, $location) {
    echo '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    <body>
        <script type="text/javascript">
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "'.$message.'"
            }).then(function() {
                window.location.href = "'.$location.'";
            });
        </script>
    </body>
    </html>';
    exit;
}

// Verifica si están presentes los datos del formulario
if (!isset($_POST['correo'], $_POST['contrasena'])) {
    showAlertAndRedirect('Por favor, ingrese su correo y contraseña.', '../../Frames/pantalla-Login.html');
    exit;
}

$correo = mysqli_real_escape_string($Conexion_usser_select, $_POST['correo']);
$contra = mysqli_real_escape_string($Conexion_usser_select, $_POST['contrasena']);

if ($Result = $Conexion_usser_select->prepare('SELECT ID_Usuario, Nombre_Us, Correo, Pass, Fecha_Nac, telefono, Imagen, Type_usser FROM usuarioregistrado WHERE Correo = ?')) {
    $Result->bind_param('s', $correo);
    $Result->execute();
    $Result->store_result();

    if ($Result->num_rows > 0) {
        $Result->bind_result($id, $name, $email, $hash_password, $birthdate, $phone, $img, $type_usser);
        $Result->fetch();

        if (password_verify($contra, $hash_password)) {
            session_regenerate_id();
            $_SESSION['name'] = $name;
            $_SESSION['birthdate'] = $birthdate;
            $_SESSION['phone'] = $phone;
            $_SESSION['id'] = $id;
            $_SESSION['email'] = $email;
            $_SESSION['img'] = $img;
            $_SESSION['Type'] = $type_usser;

            if ($type_usser === 1) {
                $_SESSION['Admin'] = TRUE;
                header('Location: ../../Frames/Admin-Commen-Prod.php');
            } elseif ($type_usser === 2) {
                $_SESSION['Usser'] = TRUE;
                $_SESSION['VIP'] = FALSE;
                header('Location: ../../Frames/pantalla-perfil.php');
            } elseif ($type_usser === 3) {
                $_SESSION['Usser'] = TRUE;
                $_SESSION['VIP'] = TRUE;
                header('Location: ../../Frames/Pantalla-Perfil-Vip.php');
            }
            exit;
        } else {
            showAlertAndRedirect('Correo o Contraseña incorrecta.', '../../Frames/pantalla-Login.html');
            exit;
        }
    } else {
        showAlertAndRedirect('Usuario no encontrado.', '../../Frames/pantalla-Login.html');
        exit;
    }
} else {
    showAlertAndRedirect('Correo no encontrado.', '../../Frames/pantalla-Login.html');
    exit;
}

$Result->close();
$Conexion_usser_select->close();
