<?php
require('../Conexion_db/conexion_usser_select.php');

$columas = ['ID_Producto', 'Nombre_Prod', 'Descripcion', 'Precio', 'Categoria', 'Subcategoria', 'Imagen'];
$columas2 = ['Nombre_Prod', 'Categoría', 'Subcategoría',];
$table = "productos";
$campo = isset($_POST['search-p']) ? $Conexion_usser_select->real_escape_string($_POST['search-p']) : null;
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
          <button class="productContainer">
            <div class="productPhoto">
              <img
                src="../Product-Images/<?php echo $row['Imagen']; ?>"
                class="productImage"
              />
            </div>
            <div class="productPrice">
              <p class="priceStyle">$<?php echo $row['Precio']; ?></p>
            </div>
            <div class="productName">
              <p class="nameStyle"><?php echo $row['Nombre_Prod']; ?></p>
            </div>
          </button>
<?php
    }
} else {
    echo '<tr>';
    echo '<td colspan="17">Sin resultados</td>';
    echo '</tr>';
}
?>