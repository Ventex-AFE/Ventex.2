
<?php
    require_once('../Conexion_db/conexion_usser_delete.php');

    $eliminar=$_POST['ID_Reporte_P'];
    $sql = "DELETE FROM reportes_producto WHERE ID_Reporte_P = $eliminar";
    $delete = mysqli_query($Conexion_usser_delete, $sql);

    if ($delete) {
        header('Location: ../../Frames/Admin-Report-Product.php');
        exit(); // Agregamos exit() para asegurarnos de que el script se detenga después de la redirección
    } else {
        echo 'Hubo un error al eliminar el registro.';
    }
?>