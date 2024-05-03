<?php
require('../php-servicios/Conexion_db/conexion_usser_select.php');

$columas = ['ID_Producto', 'Nombre_Prod', 'Descripción', 'Precio', 'Categoría', 'Subcategoría', 'Imagen'];
$table = "productos";
$campo = isset($_POST['searP']) ? $Conexion_usser_select->real_escape_string($_POST['searP']) : null;
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

$consult = "SELECT " . implode(",", $columas) . " FROM $table $where";
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
        <section class="card">
                        <div class="image"><span class="text"><?php echo $row['Imagen']; ?></span></div>
                          <span class="title"><?php echo $row['Nombre_Prod']; ?></span>
                          <span class="price">$<?php echo $row['Precio'] ?></span>
        </section>
<?php
    }
} else {
    echo '<tr>';
    echo '<td colspan="17">Sin resultados</td>';
    echo '</tr>';
}
