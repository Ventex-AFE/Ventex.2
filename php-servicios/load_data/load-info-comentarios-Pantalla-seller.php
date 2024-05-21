<?php
require('../Conexion_db/conexion_usser_select.php');

$columas = ['ID_Cometario','ID_Usuario','ID_Producto', 'Descripcion','fechar','Hora' ];
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
?>  

    <article class="viewRes">
        <div class="userReviewContainer">
            <div class="userReviewPhotoContainer">
                <img src="../Imgens-Pefil/melanie.jpeg" alt="" class="userReviewPhoto">
            </div>
            <p class="reviewUserName">Melanie Martinez</p>
        </div>
        <?php echo $row['Descripcion']; ?>
    </article>
<?php
    }
} else {?>
    <article class="viewRes">No hay comentarios</article>
    <?php
}
?>
