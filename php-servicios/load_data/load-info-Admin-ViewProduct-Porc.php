<?php
require('../Conexion_db/conexion_adm.php');

$columas = ['ID_Producto', 'Id_usser_regristro', 'Nombre_Prod', 'Descripcion', 'Precio','Categoria', 'Subcategoria','Imagen'];
$table = "productos";
$campo = isset($_POST['searP']) ? $Conexion_adm_root->real_escape_string($_POST['searP']) : null;
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
$Conexion_adm_root->set_charset("utf8");
header('Content-Type: text/html; charset=utf-8');
$result = $Conexion_adm_root->query($consult);

if ($result === false) {
    die("Error in query: " . $Conexion_adm_root->error);
}

$num_rows = $result->num_rows;

if ($num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['ID_Producto'] . '</td>';
        echo '<td>' . $row['Id_usser_regristro'] . '</td>';
        echo '<td>' . $row['Nombre_Prod'] . '</td>';
        echo '<td>' . $row['Descripcion'] . '</td>';
        echo '<td>' . $row['Precio'] . '</td>';
        echo '<td>' . $row['Categoria'] . '</td>';
        echo '<td>' . $row['Subcategoria'] . '</td>';
        echo '<td>' . $row['Imagen'] . '</td>';
        echo '</tr>';
    }
} else {
    echo '<tr>';
    echo '<td colspan="17">Sin resultados</td>';
    echo '</tr>';
}
