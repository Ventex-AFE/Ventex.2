<?php
require('../Conexion_db/conexion_usser_select.php');

$columas = ['ID_pedido', 'Nombre_pedido', 'Id_usser_regristro', ' ID_producto', 'usuario_cliente	', 'fecha', 'hora', 'lugar', 'cantidad', 'precio', 'descripcion'];
$columas2 = ['Nombre_Prod', 'Categoría', 'Subcategoría',];
$table = "pedidos";
// $id_usser = $_SESSION['id'];
$id_usser = 1;
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
            <input type="hidden" name="precio" value="<?php echo floatval($row['precio']); ?>">
            <td class="check">
                <div class="pointsContiner">
                    <button class="checkButton"><img src="../Icons/3pointsV.png" alt="" class="pointsV"></button>
                    <ul class="pointsOptions hidden">
                        <li class="pointsOption"><button href="#" class="linkOptionPoints">
                                <p class="textLinkOptions">Editar</p>
                            </button></li>
                        <li class="pointsOption"><button href="#" class="linkOptionPoints">
                                <p class="textLinkOptions">Eliminar</p>
                            </button></li>
                    </ul>
                </div>
            </td>
            <td class="table-data"><?php echo $row['ID_pedido']; ?></td>
            <td class="table-data">
                <p class="table-text"><?php echo $row['Nombre_pedido']; ?></p>
            </td>
            <td class="table-data"><?php echo $row['ID_producto']; ?></td>
            <td class="table-data">
                <p class="table-text"><?php echo $row['usuario_cliente']; ?></p>
            </td>
            <td class="table-data"><?php echo $row['fecha']; ?></td>
            <td class="table-data"><?php echo $row['hora']; ?></td>
            <td class="table-data">
                <p class="table-text"><?php echo $row['lugar']; ?></p>
            </td>
            <td class="table-data"><?php echo $row['cantidad']; ?></td>
            <td class="table-data"><?php echo $row['precio']; ?></td>
            <td class="table-data">
                <p class="table-text"><?php echo $row['descripcion']; ?></p>
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
                <p class="table-text"></p>
            </td>
            <td class="table-data">Sin resultados</td>
            <td class="table-data"></td>
            <td class="table-data">
                <p class="table-text"></p>
            </td>
            <td class="table-data"></td>
            <td class="table-data"></td>
            <td class="table-data">
                <p class="table-text">></p>
            </td>
    <?php
    echo '</tr>';
}
?>