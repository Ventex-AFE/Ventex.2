<?php
require('../Conexion_db/conexion_usser_select.php');

$columas = ['ID_Usuario', 'ID_Seller', 'Descripcion', 'Fecha', 'Hora'];
$table = "comentarios_seller";
$campo = isset($_POST['id_seller']) ? $Conexion_usser_select->real_escape_string($_POST['id_seller']) : null;

if ($campo != null) {
    $consult = "SELECT " . implode(",", $columas) . " FROM $table WHERE ID_Seller = ?";
    
    if ($stmt = $Conexion_usser_select->prepare($consult)) {
        $stmt->bind_param("i", $campo);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $num_rows = $result->num_rows;
        
        if ($num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<article class="viewRes">' . htmlspecialchars($row['Descripcion'], ENT_QUOTES, 'UTF-8') . '</article>';
            }
        } else {
            echo '<article class="viewRes">No hay comentarios</article>';
        }
        
        $stmt->close();
    } else {
        die("Error in prepare: " . $Conexion_usser_select->error);
    }
} else {
    echo '<article class="viewRes">No se proporcionó ningún ID de vendedor</article>';
}

$Conexion_usser_select->set_charset("utf8");
header('Content-Type: text/html; charset=utf-8');
?>
