<?php
session_start();
require('../Conexion_db/conexion_usser_select.php');

$columas = ['ID_Producto', 'Id_usser_regristro', 'Nombre_Prod', 'Descripcion', 'Precio', 'Categoria', 'Subcategoria', 'Imagen'];
$table = "productos";
$idUser = $_SESSION['id'];
//$idUser = 5;
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

$consult = "SELECT " . implode(",", $columas) . " FROM $table WHERE Id_usser_regristro = $idUser $where";
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
        
        <button class="productContainer" type="submit">
            <div class="productPhoto">
                <img src="../Product-Images/<?php echo $row['Imagen']; ?>" class="productImage" />
            </div>
            <div class="productPrice">
                <p class="priceStyle">$<?php echo $row['Precio'] ?></p>
            </div>
            <div class="productName">
                <p class="nameStyle"><?php echo $row['Nombre_Prod']; ?> y mas madres solo pa calar aver que tal con mas</p>
            </div>
            <div class="pointsButton">
                <img src="../Icons/3pointsV.png" alt="" class="pointsIcon">
            </div>
            <div></div>
            <ul class="optionsPoints hidden">
            <li><div class="optionButton">
                    <form action="" method="post">
                    <input type="hidden" name="id_product" value="<?php $row['ID_Producto'];?>">
                    <button >Editar</button>
                </form>
                </div>
            </li>
                <li><div class="optionButton"><p>Eliminar</p></div></li>
            </ul>
        </button>
                                
        </section>

<?php
    }
} else {
   
    echo '<h1 id="Noresult">Sin resultados</h1>';

}
