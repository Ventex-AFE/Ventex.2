<?php
require('../Conexion_db/conexion_usser_select.php');

$columas = ['ID_Usuario','ID_Seller', 'Descripcion', 'Fecha', 'Hora'];
$columas2 = ['Nombre_Prod', 'Categoría', 'Subcategoría',];
$table = "comentarios_seller";
$campo = isset($_POST['ID_Seller']) ? $Conexion_usser_select->real_escape_string($_POST['ID_Seller']) : null;
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

$consult = "SELECT " . implode(",", $columas) . " FROM $table WHERE ID_Seller=$campo";
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
              <article class="viewRes"><?php echo $row['Descripcion']; ?></article>
<?php
    }
} else {?>
    <article class="viewRes">No hay comentarios</article>
    <?php
}
?>
