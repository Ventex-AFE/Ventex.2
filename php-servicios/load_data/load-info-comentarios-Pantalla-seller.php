<?php
require('../Conexion_db/conexion_usser_select.php');

$columas = ['ID_Cometario', 'ID_Usuario', 'ID_Producto', 'Descripcion', 'fechar', 'Hora'];
$columas2 = ['Nombre_Prod', 'Categoría', 'Subcategoría',];
$table = "comentarios_product";
$campo = isset($_POST['id_product']) ? $Conexion_usser_select->real_escape_string($_POST['id_product']) : null;
$where = '';

if ($campo != null) {
    $where = "WHERE (";
    $cont = count($columas);

    for ($i = 0; $i < $cont; $i++) {
        $where .= $columas[$i] . " LIKE '%" . $campo . "%' OR ";
    }

    $where = substr_replace($where, "", -3);
    $where .= ")";
}

$consult = "SELECT " . implode(",", $columas) . " FROM $table WHERE ID_Producto=$campo";
$Conexion_usser_select->set_charset("utf8");
header('Content-Type: text/html; charset=utf-8');
$result = $Conexion_usser_select->query($consult);

if ($result === false) {
    die("Error in query: " . $Conexion_usser_select->error);
}

$num_rows = $result->num_rows;

if ($num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $usuario = $row['ID_Usuario'];
        $sql2 = "SELECT Imagen, Nombre_Us FROM usuarioregistrado WHERE ID_Usuario = ?";
        $stmt = mysqli_prepare($Conexion_usser_select, $sql2);

        mysqli_stmt_bind_param($stmt, "i", $usuario);

        // Ejecutar la consulta preparada
        mysqli_stmt_execute($stmt);

        // Vincular variables a los resultados de la consulta
        mysqli_stmt_bind_result($stmt, $Imagen, $Nombre);

        // Obtener los resultados
        mysqli_stmt_fetch($stmt);

        // Cerrar la consulta preparada
        mysqli_stmt_close($stmt);
?>

        <article class="viewRes">
            <div class="userReviewContainer">
                <div class="userReviewPhotoContainer">
                    <img src="../Imgens-Pefil/<?php echo $Imagen ?>" alt="" class="userReviewPhoto">
                </div>
                <p class="reviewUserName"><?php echo $Nombre ?></p>
            </div>
            <?php echo $row['Descripcion']; ?>
        </article>
    <?php
    }
} else { ?>
    <article class="viewRes">No hay comentarios</article>
<?php
}
?>