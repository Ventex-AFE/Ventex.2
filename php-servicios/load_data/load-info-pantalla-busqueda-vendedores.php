<?php
require('../Conexion_db/conexion_usser_select.php');


$columas = ['ID_Usuario', 'Nombre_Us', 'Imagen'];
$columas2 = ['ID_Usuario', 'Nombre_Us'];

$table = "usuarioregistrado";
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
?>
    <div class="UserstitleContainer">
        <h1 class="titUsers">Usuarios similares</h1>
    </div>
    <?php
    while ($row = $result->fetch_assoc()) {
    ?>
        <form action="../Frames/pantalla-perfil-vc.php" method="post">
            <input type="hidden" name="Id_seller" value="<?php echo $row['ID_Usuario']; ?>">
            <button type="submit" class="userBox">
                <div class="userPhotoSection">
                    <div class="userPhotoContainer"><img src="../Imgens-Pefil/<?php echo $row['Imagen']; ?>" alt="" style="max-width: 4.5vw;"></div>
                </div>
                <div class="userNameSection">
                    <h1 class="userName"><?php echo $row['Nombre_Us']; ?></h1>
                </div>
            </button>
        </form>

<?php
    }
} else {

    echo '<h2 >Sin resultados</h2>';
}
