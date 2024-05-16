<?php
session_start();
require_once('../Conexion_db/conexion_usser_changes.php');

// Obtener el ID del usuario de la sesión
$Id_usser_regristro = 5;
$Id_prod = mysqli_real_escape_string($Conexion_usser_changes, $_POST['id_prod']);
$fecha_Coment = mysqli_real_escape_string($Conexion_usser_changes, $_POST['fecha_Coment']);
$hora_comentario = mysqli_real_escape_string($Conexion_usser_changes, $_POST['hora_comentario']);
$descriptionp = mysqli_real_escape_string($Conexion_usser_changes, $_POST['descripcion']);

$sentence = "INSERT INTO comentarios_product (ID_Usuario,ID_Producto, Descripcion, fechar, Hora) 
            VALUES ('$Id_usser_regristro', '$Id_prod','$descriptionp', '$fecha_Coment', '$hora_comentario')";
$guardar = mysqli_query($Conexion_usser_changes, $sentence);

if (!$guardar) {
    echo "Error al guardar los datos en la base de datos: " . mysqli_error($Conexion_usser_changes);
} else {
    // Mostrar el formulario y enviarlo automáticamente
    echo '<form id="redirectForm" action="../../Frames/pantalla-producto.php" method="post">';
    echo '<input type="hidden" name="id_product" value="' . $Id_prod . '">';
    echo '</form>';
    echo '<script>document.getElementById("redirectForm").submit();</script>';
}

mysqli_close($Conexion_usser_changes);
?>
