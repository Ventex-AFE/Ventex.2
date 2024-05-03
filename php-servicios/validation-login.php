<?php
// Inicia la sesión para poder usar variables de sesión
session_start();

// Requiere el archivo de conexión a la base de datos
require('../php-servicios/Conexion_db/conexion_usser_select.php');

// Verifica si están presentes los datos del formulario
if (!isset($_POST['correo'], $_POST['contra'])) {
    // Redirige a la página de inicio si falta algún dato
    header('Location: Incios.html');
    exit;
}

// Escapa los caracteres especiales en el correo y la contraseña para prevenir inyección SQL
$correo = mysqli_real_escape_string($Conexion_usser_select, $_POST['correo']);
$contra = mysqli_real_escape_string($Conexion_usser_select, $_POST['contra']);

// Prepara una consulta SQL para seleccionar el usuario con el correo proporcionado
if ($Result = $Conexion_usser_select->prepare('SELECT ID_Usuario, Nombre_Us, Correo, Pass, Fecha_Nac, Celular, Imagen FROM usuarioregistrado WHERE Correo = ?')) {
    $Result->bind_param('s', $correo); // Asocia el parámetro con el valor y ejecuta la consulta
    $Result->execute();
} else {
    die('Error en la preparación de la consulta'); // Termina el script si hay un error en la preparación de la consulta
}

// Almacena el resultado de la consulta
$Result->store_result();

// Verifica si se encontró algún usuario con el correo proporcionado
if ($Result->num_rows > 0) {
    // Obtiene los datos del usuario
    $Result->bind_result($id, $name, $email, $hash_password, $birthdate, $phone, $img);
    $Result->fetch();

    // Verifica si la contraseña proporcionada coincide con la contraseña almacenada en la base de datos
    if (password_verify($contra, $hash_password)) {
        // Regenera el ID de sesión para evitar ataques de fijación de sesiones
        session_regenerate_id();
        // Establece variables de sesión para indicar que el usuario está autenticado
        $_SESSION['loggedin'] = TRUE;
        $_SESSION['name'] = $name;
        $_SESSION['birthdate'] = $birthdate;
        $_SESSION['phone'] = $phone;
        $_SESSION['id'] = $id;
        $_SESSION['email'] = $email;
        $_SESSION['img'] = $img;
        // Redirige al perfil del usuario
        header('Location: perfil.php');
        exit;
    } else {
        // Redirige a la página de inicio con un mensaje de error si la contraseña es incorrecta
        header('Location: Incios.php?error=1');
        exit;
    }
} else {
    // Redirige a la página de inicio con un mensaje de error si no se encontró ningún usuario con el correo proporcionado
    header('Location: Incios.html?error=2');
    exit;
}

// Cierra el resultado y la conexión a la base de datos
$Result->close();
$Conexion_usser_select->close();
?>
