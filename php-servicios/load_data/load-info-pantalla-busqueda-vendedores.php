<?php
require('../Conexion_db/conexion_usser_select.php'); // Incluye el archivo de conexión a la base de datos

// Define las columnas que se seleccionarán en la consulta SQL
$columas = ['ID_Usuario', 'Nombre_Us', 'Imagen'];
$table = "usuarioregistrado"; // Nombre de la tabla en la base de datos
$nombre_vendedor = isset($_POST['search-p']) ? $Conexion_usser_select->real_escape_string($_POST['search-p']) : null; // Captura el término de búsqueda y lo escapa para evitar inyecciones SQL
$where = ''; // Inicializa la cláusula WHERE

// Si se ha proporcionado un término de búsqueda, crea la cláusula WHERE para buscar por nombre de usuario
if ($nombre_vendedor != null) {
    $where = "WHERE Nombre_Us LIKE '%" . $nombre_vendedor . "%'";
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
        <!-- Formulario para enviar datos al perfil del vendedor -->
        <form action="../Frames/pantalla-perfil-vc.php" method="post">
            <input type="hidden" name="Id_seller" value="<?php echo $row['ID_Usuario']; ?>"> <!-- Campo oculto con el ID del vendedor -->
            <button type="submit" class="userBox">
                <div class="userPhotoSection">
                    <div class="userPhotoContainer"><img src="../Imgens-Pefil/<?php echo $row['Imagen']; ?>" alt="" class="userPhoto"></div> <!-- Imagen del vendedor -->
                </div>
                <div class="userNameSection">
                    <h1 class="userName"><?php echo $row['Nombre_Us']; ?></h1> <!-- Nombre del vendedor -->
                </div>
            </button>
        </form>
<?php
    }
} else {
    // Si no hay resultados, muestra un mensaje
    echo '<h2>Sin resultados</h2>';
}
?>
