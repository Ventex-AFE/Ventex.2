<?php
    require_once('../Conexion_db/conexion_usser_delete.php');

    $eliminar=$_POST['id_comment_product'];
    $sql = "DELETE FROM comentarios_product WHERE ID_Cometario = $eliminar";
    $delete = mysqli_query($Conexion_usser_delete, $sql);

    if ($delete) {
        header('Location: ../../Frames/Admin-Commen-Prod.php');
        exit(); // Agregamos exit() para asegurarnos de que el script se detenga después de la redirección
    } else {
        echo 'Hubo un error al eliminar el registro.';
    }
?>