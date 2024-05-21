
<?php
session_start();
require_once('../Conexion_db/conexion_usser_changes.php');

// Obtener el ID del usuario de la sesión
$Id_usser_regristro = $_SESSION['id'];
$Id_seller = mysqli_real_escape_string($Conexion_usser_changes, $_POST['id_seller']);
$fecha_Coment = mysqli_real_escape_string($Conexion_usser_changes, $_POST['fecha_Coment']);
$hora_comentario = mysqli_real_escape_string($Conexion_usser_changes, $_POST['hora_comentario']);
$descriptionp = mysqli_real_escape_string($Conexion_usser_changes, $_POST['descripcion']);

$sentence = "INSERT INTO comentarios_seller (ID_Usuario,ID_Seller, Descripcion, Fecha, Hora) 
            VALUES ('$Id_usser_regristro', '$Id_seller','$descriptionp', '$fecha_Coment', '$hora_comentario')";
$guardar = mysqli_query($Conexion_usser_changes, $sentence);

if (!$guardar) {
    echo "Error al guardar los datos en la base de datos: " . mysqli_error($Conexion_usser_changes);
} else {
    // Mostrar el formulario y enviarlo automáticamente
    echo '<form id="redirectForm" action="../../Frames/pantalla-perfil-vc.php" method="post">';
    echo '<input type="hidden" name="Id_seller" value="' . $Id_seller . '">';
    echo '</form>';
    echo '<script>document.getElementById("redirectForm").submit();</script>';
}

mysqli_close($Conexion_usser_changes);
?>
