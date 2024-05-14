<?php
require('../Conexion_db/conexion_usser_select.php');

$columas = ['ID_Venta',	'Usuario_Venta', 'ID_Producto',	'Nombre_reporte_venta',	'Descripcio', 'fecha', 'hora','total'];
$columas2 = ['Nombre_Prod', 'Categoría', 'Subcategoría'];
$table = "regristroventa";
// $id_usser = $_SESSION['id'];
$id_usser = 5;
$campo = isset($_POST['searchP']) ? $Conexion_usser_select->real_escape_string($_POST['searchP']) : null;
$where = '';

if ($campo != null) {
    $where = "AND (";
    $cont = count($columas);

    for ($i = 0; $i < $cont; $i++) {
        $where .= $columas[$i] . " LIKE '%" . $campo . "%' OR ";
    }

    $where = substr_replace($where, "", -3);
    $where .= ")";
}

$consult = "SELECT " . implode(",", $columas) . " FROM $table WHERE Id_usser_regristro = $id_usser $where";
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
        <tr class="row-column-order">
            <input type="hidden" name="precio" value="<?php echo floatval($row['total']); ?>">
            <td class="check">
                <div class="pointsContiner">
                    <button class="checkButton"><img src="../Icons/3pointsV.png" alt="" class="pointsV"></button>
                    <ul class="pointsOptions hidden">
                        <li class="pointsOption">
                            <form action="../Frames/Pantalla-Edit-Reporte-venta.php" method="post" id="form_editar_pedido">
                                <input type="hidden" name="Id_Reporte_Venta" value="<?php echo intval($row['ID_Venta']); ?>">
                                <button class="linkOptionPoints editButton" id="editButton">
                                    <p class="textLinkOptions">Editar</p>
                                </button> <!-- Agrega un valor al input oculto con el ID del pedido -->
                            </form>
                        </li>
                        <li class="pointsOption">
                            <form action="../php-servicios/deletion_data/deletion_reporte-venta.php" method="post" id="form_eliminar_pedido">
                                <input type="hidden" name="Id_Reporte_Venta" value="<?php echo intval($row['ID_Venta']); ?>">
                                <button class="linkOptionPoints deleteButton">
                                    <p class="textLinkOptions">Eliminar</p>
                                </button><!-- Agrega un valor al input oculto con el ID del pedido -->
                            </form>
                        </li>
                    </ul>
                </div>
            </td>
            <td class="table-data"><?php echo $row['ID_Venta']; ?></td>
            <td class="table-data">
                <p class="table-text"><?php echo $row['Nombre_reporte_venta']; ?></p>
            </td>
            <td class="table-data"><?php echo $row['ID_Producto']; ?></td>
            <td class="table-data">
                <p class="table-text"><?php echo $row['Usuario_Venta']; ?></p>
            </td>
            <td class="table-data"><?php echo $row['fecha']; ?></td>
            <td class="table-data"><?php echo $row['hora']; ?></td>
            <td class="table-data"><?php echo $row['total']; ?></td>
            <td class="table-data">
                <p class="table-text"><?php echo $row['Descripcio']; ?></p>
            </td>
        </tr>
    <?php
    }
} else {
    echo '<tr>';
    ?>
    <td class="check">

    </td>
    <td class="table-data"></td>
    <td class="table-data">
        <p class="table-text"></p>
    </td>
    <td class="table-data"></td>
    <td class="table-data">
        <p class="table-text">Sin resultados</p>
    </td>
    <td class="table-data"></td>
    <td class="table-data"></td>
    <td class="table-data">
        <p class="table-text"></p>
    </td>
    <td class="table-data"></td>

<?php
    echo '</tr>';
}
?>