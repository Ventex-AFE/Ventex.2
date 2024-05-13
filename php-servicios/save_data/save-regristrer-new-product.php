<?php
session_start();
require_once('../Conexion_db/conexion_usser_changes.php');

// 	Id_usser_regristro	Nombre_Prod	Descripción	Precio	Categoría	Subcategoría	Imagen	
//$Id_usser_regristro = $_SESSION['id'];
$Id_usser_regristro = 5;
$nameProduct = mysqli_real_escape_string($Conexion_usser_changes, $_POST['product_name']);
$price = mysqli_real_escape_string($Conexion_usser_changes, $_POST['product_price']);
$descriptionp = mysqli_real_escape_string($Conexion_usser_changes, $_POST['product_description']);
$categoria = mysqli_real_escape_string($Conexion_usser_changes, $_POST['product_category']);
$subCategoria = mysqli_real_escape_string($Conexion_usser_changes, $_POST['product_subcategory']);


if (isset($_FILES["product_image"])) {
    $archivo = basename($_FILES["product_image"]["name"]);
    $targetDirectory = "../../Product-Images/";  // Ruta relativa al directorio del script
    $targetFile = $targetDirectory . $archivo;

    $esImagen = getimagesize($_FILES["product_image"]["tmp_name"]);
    if ($esImagen !== false) {
        if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $targetFile)) {
            echo "El archivo $archivo ha sido subido correctamente.";
        } else {
            echo "Hubo un error al subir el archivo.";
        }
    } else {
        echo "El archivo no es una imagen válida.";
    }
} else {
    echo "No se ha seleccionado ningún archivo.";
}


$sentence = "INSERT INTO productos (Id_usser_regristro, Nombre_Prod, Descripcion, Precio, Categoria, Subcategoria, Imagen) 
            VALUES ('$Id_usser_regristro', '$nameProduct', '$descriptionp', '$price', '$categoria', '$subCategoria','$archivo')";
$guardar = mysqli_query($Conexion_usser_changes, $sentence);

if (!$guardar) {
    echo "Error al guardar los datos en la base de datos: " . mysqli_error($Conexion_usser_changes);
} else {
    $_SESSION['logged'] = true;
    header('Location: ../../Frames/pantalla-perfil.php');
}

mysqli_close($Conexion_usser_changes);
?>