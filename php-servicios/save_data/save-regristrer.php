<?php
require_once('../Conexion_db/conexion_usser_changes.php');

// Datos del primer formulario
$Nom = mysqli_real_escape_string($Conexion_usser_changes, $_POST['nombre']);
$correo = mysqli_real_escape_string($Conexion_usser_changes, $_POST['correo']);
$telefono = mysqli_real_escape_string($Conexion_usser_changes, $_POST['telefono']);
$fecha = mysqli_real_escape_string($Conexion_usser_changes, $_POST['fecha_nac']);
$hash = password_hash(mysqli_real_escape_string($Conexion_usser_changes, $_POST['contrasena']), PASSWORD_DEFAULT, ['cost' => 15]);

// Verifica si el archivo es una imagen
if (isset($_FILES["userPhoto"])) {
    $archivo = basename($_FILES["userPhoto"]["name"]);
    $targetDirectory = "../../Imgens-Pefil/";  // Ajusta la ruta al directorio correcto
    $targetFile = $targetDirectory . $archivo;  // Ruta completa del archivo

    $esImagen = getimagesize($_FILES["userPhoto"]["tmp_name"]);
    if ($esImagen !== false) {
        // Mueve el archivo a la ubicación deseada
        if (move_uploaded_file($_FILES["userPhoto"]["tmp_name"], $targetFile)) {
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
if (!isset($_POST['nombre'], $_POST['correo'], $_POST['telefono'], $_POST['fecha_nac'], $_POST['contrasena'])) {
    header('Location: ../../Frames/pantalla-registro.php');
}
echo $telefono;
// Sentencia de envío del primer formulario
$sql = "INSERT INTO usuarioregistrado (Nombre_Us, Correo, Pass, Fecha_Nac, telefono, Imagen) 
VALUES ('$Nom', '$correo', '$hash', '$fecha', '$telefono', '$archivo')";
$envio = mysqli_query($Conexion_usser_changes, $sql);

// Verificar si se ejecutó correctamente la primera consulta
if (!$envio) {
    echo '<SCRIPT> alert("Tu registro no se pudo registrar")</SCRIPT>';
    echo 'Error de MySQL: ' . mysqli_error($Conexion_usser_changes);
    exit; // Terminar la ejecución después de mostrar el mensaje de error
} else {
    // Datos del segundo formulario
    $value1 = mysqli_real_escape_string($Conexion_usser_changes, $_POST['value1']);
    $value2 = mysqli_real_escape_string($Conexion_usser_changes, $_POST['value2']);
    $value3 = mysqli_real_escape_string($Conexion_usser_changes, $_POST['value3']);
    $value4 = mysqli_real_escape_string($Conexion_usser_changes, $_POST['value4']);
    $value5 = mysqli_real_escape_string($Conexion_usser_changes, $_POST['value5']);
    $value6 = mysqli_real_escape_string($Conexion_usser_changes, $_POST['value6']);

    // Sentencia de envío del segundo formulario
    $sql2 = "INSERT INTO seller_porfile (Name_Seller, profile_Description, Contact_description, instagram, x, whatsapp, facebook) 
    VALUES ('$Nom','$value1', '$value2', '$value3', '$value4', '$value5', '$value6')";
    $envio2 = mysqli_query($Conexion_usser_changes, $sql2);

    // Verificar si se ejecutó correctamente la segunda consulta
    if (!$envio2) {
        echo '<SCRIPT> alert("Tu registro no se pudo registrar")</SCRIPT>';
        echo 'Error de MySQL: ' . mysqli_error($Conexion_usser_changes);
        exit; // Terminar la ejecución después de mostrar el mensaje de error
    } else {
        // Iniciar sesión o realizar otras acciones después de un registro exitoso
        header('Location: ..\..\Frames\pantalla-Login.html');
        exit; // Terminar la ejecución después de redirigir al usuario
    }
}

// Cerrar la conexión de la base de datos
mysqli_close($Conexion_usser_changes);
?>