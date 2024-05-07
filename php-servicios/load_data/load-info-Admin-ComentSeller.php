<?php
// Incluir el archivo de conexión a la base de datos
require('../Conexion_db/conexion_adm.php');

// Definir las columnas a las que se aplicará el filtrado
$columas = ['ID_Comentario_S','ID_Usuario',	'ID_Seller','Descripcion','Fecha','Hora'];//ejemplo : 'id', 'nombreprod', 'descrip', 'existnafterm', 'stock'
$table = "comentarios_seller"; // Nombre de la tabla en la base de datos

// Obtener el valor del campo de búsqueda desde un formulario POST
$campo = isset($_POST['searchP']) ? $Conexion_adm_root->real_escape_string($_POST['searchP']) : null;
$where = '';

// Construir la cláusula WHERE para el filtrado si se proporcionó un valor de búsqueda
if ($campo != null) {
    $where = "WHERE (";
    $cont = count($columas);

    // Construir la condición de búsqueda para cada columna
    for ($i = 0; $i < $cont; $i++) {
        $where .= $columas[$i] . " LIKE '%" . $campo . "%' OR ";
    }

    // Eliminar el último 'OR' innecesario y cerrar la condición
    $where = substr_replace($where, "", -3);
    $where .= ")";
}

// Construir la consulta SQL para obtener los datos
$consult = "SELECT " . implode(",", $columas) . " FROM $table $where";

// Establecer el conjunto de caracteres de la conexión a UTF-8
$Conexion_adm_root->set_charset("utf8");
header('Content-Type: text/html; charset=utf-8');

// Ejecutar la consulta SQL
$result = $Conexion_adm_root->query($consult);

// Verificar si ocurrió un error durante la ejecución de la consulta
if ($result === false) {
    // Mostrar un mensaje de error y la descripción del error
    die("Error in query: " . $Conexion_adm_root->error);
}

// Obtener el número de filas devueltas por la consulta
$num_rows = $result->num_rows;

// Verificar si se devolvieron resultados
if ($num_rows > 0) {
    // Iterar sobre cada fila (registro) devuelto por la consulta
    while ($row = $result->fetch_assoc()) {
        // Imprimir cada columna de la fila en una fila de una tabla HTML
        echo '<tr>';
        echo '<td>' . $row['ID_Comentario_S'] . '</td>';
        echo '<td>' . $row['ID_Usuario'] . '</td>';
        echo '<td>' . $row['ID_Seller'] . '</td>';
        echo '<td>' . $row['Descripcion'] . '</td>';
        echo '<td>' . $row['Fecha'] . '</td>';
        echo '<td>' . $row['Hora'] . '</td>';
        echo '</tr>';
    }
} else {
    // Si no se devolvieron filas, mostrar un mensaje de "Sin resultados"
    echo '<tr>';
    echo '<td colspan="7">Sin resultados</td>';
    echo '</tr>';
}
/*
Se define un array $columas que contiene los nombres de las columnas de la tabla a las que se aplicará el filtrado.
Se obtiene el valor de búsqueda ($campo) del formulario POST y se escapa para prevenir inyección SQL usando $Conexion->real_escape_string().
Se construye la cláusula WHERE en la variable $where para filtrar los registros basados en el valor de búsqueda proporcionado. Se utilizan las columnas definidas en $columas para crear una búsqueda con el operador LIKE.
Se construye la consulta SQL ($consult) concatenando las columnas seleccionadas y la cláusula WHERE si se proporcionó un valor de búsqueda.
Se establece el conjunto de caracteres de la conexión a UTF-8 para admitir caracteres especiales.
Se ejecuta la consulta SQL utilizando $Conexion->query() y se almacena el resultado en $result.
Se verifica si la consulta se ejecutó correctamente. Si hay un error, se muestra un mensaje de error con detalles.
Se obtiene el número de filas devueltas por la consulta usando $result->num_rows.
Si se devolvieron filas, se iteran a través de ellas utilizando un bucle while y se imprimen los valores de cada columna en filas de una tabla HTML.
Si no se devolvieron filas, se muestra un mensaje indicando "Sin resultados" en una fila de la tabla.
*/
