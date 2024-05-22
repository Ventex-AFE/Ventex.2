<?php
    require_once('../Conexion_db/conexion_usser_delete.php');

    $eliminar=$_POST['id_product'];
    $sql = "DELETE FROM productos WHERE ID_Producto = $eliminar";
    $delete = mysqli_query($Conexion_usser_delete, $sql);

    if ($delete) {
        header('Location: ../../Frames/Admin-ViewProduct-Porc.php');
        exit(); // Agregamos exit() para asegurarnos de que el script se detenga después de la redirección
    } else {
        echo 'Hubo un error al eliminar el registro.';
    }
?>