<?php
    require_once('../Conexion_db/conexion_usser_delete.php');

    $eliminar=$_POST['id_report_seller'];
    $sql = "DELETE FROM reportes_seller WHERE ID_Reporte_S = $eliminar";
    $delete = mysqli_query($Conexion_usser_delete, $sql);

    if ($delete) {
        header('Location: ../../Frames/Admin-Report-Seller.php');
        exit(); // Agregamos exit() para asegurarnos de que el script se detenga después de la redirección
    } else {
        echo 'Hubo un error al eliminar el registro.';
    }
?>