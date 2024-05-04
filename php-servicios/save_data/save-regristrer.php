<?php
require_once('../Conexion_db/conexion_usser_changes.php');

// Datos del primer formulario
$Nom = mysqli_real_escape_string($Conexion, $_POST['nombre']);
$correo = mysqli_real_escape_string($Conexion, $_POST['correo']);
$fecha = mysqli_real_escape_string($Conexion, $_POST['fecha']);
$telefono = mysqli_real_escape_string($Conexion, $_POST['telefono']);
$hash = password_hash(mysqli_real_escape_string($Conexion, $_POST['pass']), PASSWORD_DEFAULT, ['cost' => 15]);

// Verifica si el archivo es una imagen
if (isset($_FILES["archivo"])) {
    $archivo = basename($_FILES["archivo"]["name"]);
    $targetDirectory = "C:/wamp64/www/Ventex/imgs/";  // Ajusta la ruta al directorio correcto
    $targetFile = $targetDirectory . $archivo;  // Ruta completa del archivo

    $esImagen = getimagesize($_FILES["archivo"]["tmp_name"]);
    if ($esImagen !== false) {
        // Mueve el archivo a la ubicación deseada
        if (move_uploaded_file($_FILES["archivo"]["tmp_name"], $targetFile)) {
            echo "El archivo $archivo ha sido subido correctamente.";
        } else {
            echo "Hubo un error al subir el archivo.";
        }
    } else {
        echo "El archivo no es una imagen válida.";
    }
} else {
    echo "No se ha seleccionado ningún archivo.";
}

// Verificar si todos los datos están presentes
if (!isset($_POST['nombre'], $_POST['correo'], $_POST['fecha'], $_POST['telefono'], $_POST['pass'])) {
    header('Location: registropaw.html');
}

// Sentencia de envío del primer formulario
$sql = "INSERT INTO users (nameUser, email, birthdate, phone, pass, img) VALUES ('$Nom', '$correo', '$fecha', '$telefono', '$hash', '$archivo')";
$envio = mysqli_query($Conexion, $sql);

// Verificar si se ejecutó correctamente la primera consulta
if (!$envio) {
    echo '<SCRIPT> alert("Tu registro no se pudo registrar")</SCRIPT>';
    echo 'Error de MySQL: ' . mysqli_error($Conexion);
    exit; // Terminar la ejecución después de mostrar el mensaje de error
} else {
    // Datos del segundo formulario
    $value1 = mysqli_real_escape_string($Conexion, $_POST['value1']);
    $value2 = mysqli_real_escape_string($Conexion, $_POST['value2']);
    $value3 = mysqli_real_escape_string($Conexion, $_POST['value3']);
    $value4 = mysqli_real_escape_string($Conexion, $_POST['value4']);
    $value5 = mysqli_real_escape_string($Conexion, $_POST['value5']);
    $value6 = mysqli_real_escape_string($Conexion, $_POST['value6']);
    $value7 = mysqli_real_escape_string($Conexion, $_POST['value7']);
    $value8 = mysqli_real_escape_string($Conexion, $_POST['value8']);
    $value9 = mysqli_real_escape_string($Conexion, $_POST['value9']);

    // Sentencia de envío del segundo formulario
    $sql2 = "INSERT INTO sellerprofile (idvendeor, nameSeller, profileDescription, Contactdescription, instagram, x, whatsapp, facebook, phoneNumber) 
                                        VALUES ('$value1', '$value2', '$value3', '$value4', '$value5', '$value6', '$value7', '$value8', '$value9')";
    $envio2 = mysqli_query($Conexion, $sql2);

    // Verificar si se ejecutó correctamente la segunda consulta
    if (!$envio2) {
        echo '<SCRIPT> alert("Tu registro no se pudo registrar")</SCRIPT>';
        echo 'Error de MySQL: ' . mysqli_error($Conexion);
        exit; // Terminar la ejecución después de mostrar el mensaje de error
    } else {
        // Iniciar sesión o realizar otras acciones después de un registro exitoso
        header('Location: Incios.html');
        exit; // Terminar la ejecución después de redirigir al usuario
    }
}

// Cerrar la conexión de la base de datos
mysqli_close($Conexion);
?>