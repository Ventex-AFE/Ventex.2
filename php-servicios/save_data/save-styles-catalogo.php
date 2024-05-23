<?php
session_start();
require_once('../Conexion_db/conexion_usser_changes.php');

// Obtener el ID del usuario de la sesión
$Id_usser_regristro = $_SESSION['id'];
$box_color = 'Campo vacio';
$header_color = mysqli_real_escape_string($Conexion_usser_changes, $_POST['headerColor']);
$Category_color = mysqli_real_escape_string($Conexion_usser_changes, $_POST['CategoryColor']);
$Produc_type = mysqli_real_escape_string($Conexion_usser_changes, $_POST['productBoxPreviewStyle']);
$Catalogo_style = mysqli_real_escape_string($Conexion_usser_changes, $_POST['catalogStyle']);

echo $Id_usser_regristro, $Catalogo_style, $Produc_type, $header_color, $Category_color, $box_color;

$sentence = "UPDATE catalogo_seller 
             SET stylePage = '$Catalogo_style',
                 Product_View_Style = '$Produc_type',
                 Header_Color = '$header_color',
                 Category_Color = '$Category_color',
                 Product_Box_Color = '$box_color'
             WHERE Id_vendedor = '$Id_usser_regristro'";

$guardar = mysqli_query($Conexion_usser_changes, $sentence);

if (!$guardar) {
    echo "Error al guardar los datos en la base de datos: " . mysqli_error($Conexion_usser_changes);
} else {
    header('Location: ../../Frames/pantalla-perfil.php');
}

mysqli_close($Conexion_usser_changes);
?>
