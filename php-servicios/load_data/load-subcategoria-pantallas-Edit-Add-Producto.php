<?php
// Incluir el archivo de conexión
require_once('../Conexion_db/conexion_usser_select.php');

// Obtener la categoría seleccionada desde la solicitud AJAX

$categoria = $_POST['product_category'];
// echo $categoria;
//categoria= 'Hogar y jardin';
// Consulta SQL para obtener las subcategorías de la categoría seleccionada
$sql = "SELECT Nombre_Subcat FROM subcategoria WHERE Categoria = ?";
$stmt = mysqli_prepare($Conexion_usser_select, $sql);

// Verificar si la preparación de la consulta tuvo éxito
if (!$stmt) {
    exit('Error en la preparación de la consulta: ' . mysqli_error($Conexion_usser_select));
}

// Vincular parámetro(s) a la consulta preparada
mysqli_stmt_bind_param($stmt, "s", $categoria);

// Ejecutar la consulta preparada
mysqli_stmt_execute($stmt);

// Vincular resultado de la consulta
mysqli_stmt_bind_result($stmt, $subcategoria);

// Array para almacenar las subcategorías
$subcategorias = array();

// Obtener los resultados y almacenarlos en el array
while (mysqli_stmt_fetch($stmt)) {
    $subcategorias[] = $subcategoria;
}

// Cerrar la consulta preparada
mysqli_stmt_close($stmt);

// Devolver las subcategorías en formato JSON
echo json_encode($subcategorias);
?>
