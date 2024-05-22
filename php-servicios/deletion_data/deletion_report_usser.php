<?php
    require_once('../Conexion_db/conexion_usser_delete.php');

    $eliminar=$_POST['id_comment_usser'];
    $sql = "DELETE FROM reportes_usuario WHERE ID_Reporte = $eliminar";
    $delete = mysqli_query($Conexion_usser_delete, $sql);

    if ($delete) {
        header('Location: ../../Frames/Admin-Report-User.php');
        exit(); // Agregamos exit() para asegurarnos de que el script se detenga después de la redirección
    } else {
        echo 'Hubo un error al eliminar el registro.';
    }
?>