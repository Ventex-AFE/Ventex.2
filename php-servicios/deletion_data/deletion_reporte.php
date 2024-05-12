<?php
    require_once('../Conexion_db/conexion_usser_delete.php');

    //$eliminar=$_POST['eliminar'];
    $eliminar = 6; // Suponiendo que este es un valor válido para eliminar un registro de la base de datos
    $sql = "DELETE FROM regristroventa WHERE ID_Venta = $eliminar";
    $delete = mysqli_query($Conexion_usser_delete, $sql);

    if ($delete) {
        header('Location: ../../Frames/Pantalla-Reportes_Ventas.php');
        exit(); // Agregamos exit() para asegurarnos de que el script se detenga después de la redirección
    } else {
        echo 'Hubo un error al eliminar el registro.';
    }
?>