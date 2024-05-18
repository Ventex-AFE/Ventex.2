<?php
require('../Conexion_db/conexion_usser_select.php'); // Incluye el archivo de conexión a la base de datos

// Define las columnas que se seleccionarán en la consulta SQL
$columas = ['ID_Producto', 'Nombre_Prod', 'Descripcion', 'Precio', 'Categoria', 'Subcategoria', 'Imagen'];
$table = "productos"; // Nombre de la tabla en la base de datos
$campo = isset($_POST['search-p']) ? $Conexion_usser_select->real_escape_string($_POST['search-p']) : null; // Captura el término de búsqueda y lo escapa para evitar inyecciones SQL
$where = ''; // Inicializa la cláusula WHERE

// Si se ha proporcionado un término de búsqueda, crea la cláusula WHERE para buscar por nombre de producto
if ($campo != null) {
  $where = "WHERE Nombre_Prod LIKE '%" . $campo . "%'";
}

// Construye la consulta SQL con las columnas seleccionadas y la cláusula WHERE si existe
$consult = "SELECT " . implode(",", $columas) . " FROM $table $where";
$Conexion_usser_select->set_charset("utf8"); // Establece el juego de caracteres a UTF-8
header('Content-Type: text/html; charset=utf-8'); // Establece el encabezado de contenido a UTF-8 para evitar problemas de codificación
$result = $Conexion_usser_select->query($consult); // Ejecuta la consulta SQL

// Verifica si la consulta ha fallado
if ($result === false) {
  die("Error in query: " . $Conexion_usser_select->error); // Muestra el error de la consulta y detiene la ejecución del script
}

$num_rows = $result->num_rows; // Obtiene el número de filas devueltas por la consulta

// Si hay resultados, los muestra
if ($num_rows > 0) {
  while ($row = $result->fetch_assoc()) { // Itera sobre cada fila del resultado
?>
    <!-- Formulario para enviar datos al perfil del producto -->
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
  // Si no hay resultados, muestra un mensaje
  echo '<tr>';
  echo '<td colspan="17">Sin resultados</td>';
  echo '</tr>';
}
?>
