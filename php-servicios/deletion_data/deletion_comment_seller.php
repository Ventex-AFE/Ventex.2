<?php
    require_once('../Conexion_db/conexion_usser_delete.php');

    $eliminar=$_POST['id_comment_Seller'];
    $sql = "DELETE FROM comentarios_seller WHERE ID_Comentario_S = $eliminar";
    $delete = mysqli_query($Conexion_usser_delete, $sql);

    if ($delete) {
        header('Location: ../../Frames/Admin-Commen-seller.php');
        exit(); // Agregamos exit() para asegurarnos de que el script se detenga después de la redirección
    } else {
        echo 'Hubo un error al eliminar el registro.';
    }
?>