<?php
require('../Conexion_db/conexion_usser_select.php');

$columas = ['ID_Producto', 'Id_usser_regristro', 'Nombre_Prod', 'Descripcion', 'Precio', 'Categoria', 'Subcategoria', 'Imagen'];
$table = "productos";
$campo = isset($_POST['searP']) ? $Conexion_usser_select->real_escape_string($_POST['searP']) : null;
$where = '';

$consult = "SELECT * FROM productos ORDER BY RAND() LIMIT 5";
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
        <form action="../Frames/pantalla-producto.php" method="post">
            <input type="hidden" name="id_product" value="<?php echo $row['ID_Producto']; ?>"> <!-- Campo oculto con el ID del producto -->
            <button class="productContainer" type="submit">
                <div class="productPhoto">
                    <img src="../Product-Images/<?php echo $row['Imagen']; ?>" class="productImage" /> <!-- Imagen del producto -->
                </div>
                <div class="productPrice">
                    <p class="priceStyle">$<?php echo $row['Precio']; ?></p> <!-- Precio del producto -->
                </div>
                <div class="productName">
                    <p class="nameStyle"><?php echo $row['Nombre_Prod']; ?></p> <!-- Nombre del producto -->
                </div>
            </button>
        </form>
<?php
    }
} else {
    echo '<tr>';
    echo '<td colspan="17">Sin resultados</td>';
    echo '</tr>';
}
