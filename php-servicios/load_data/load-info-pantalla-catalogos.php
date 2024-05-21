<?php
session_start();
require('../Conexion_db/conexion_usser_select.php');
$columas = ['ID_Producto', 'Id_usser_regristro', 'Nombre_Prod', 'Descripcion', 'Precio', 'Categoria', 'Subcategoria', 'Imagen'];
$columas2 = ['Nombre_Prod'];
$table = "productos";

$input = isset($_POST['id_usser']) ? $Conexion_usser_select->real_escape_string($_POST['id_usser']) : null;
$input2 = isset($_POST['categoria']) ? $Conexion_usser_select->real_escape_string($_POST['categoria']) : null;
$campo = isset($_POST['searchP']) ? $Conexion_usser_select->real_escape_string($_POST['searchP']) : null;
$where = '';

if ($input2) {
    // If category is selected
    $where = "AND Categoria = '$input2'";
}

if ($campo != null) {
    $where .= " AND (";
    $cont = count($columas2);

    for ($i = 0; $i < $cont; $i++) {
        $where .= $columas2[$i] . " LIKE '%" . $campo . "%' OR ";
    }

    $where = substr_replace($where, "", -3);
    $where .= ")";
}

$consult = $input2
    ? "SELECT " . implode(",", $columas) . " FROM $table WHERE Id_usser_regristro = $input $where"
    : "SELECT DISTINCT Categoria FROM $table WHERE Id_usser_regristro = $input";

$Conexion_usser_select->set_charset("utf8");
header('Content-Type: text/html; charset=utf-8');
$result = $Conexion_usser_select->query($consult);

if ($result === false) {
    die("Error in query: " . $Conexion_usser_select->error);
}

$num_rows = $result->num_rows;

if ($num_rows > 0) {
    if ($input2) {
        // Display products of the selected category
        while ($row = $result->fetch_assoc()) {
?>
            <article class="sectionProductsContainer" id="sectionProductsContainer">
                <div class="titleSectionC">
                    <h1 class="titleSection"><?php echo $row['Subcategoria']; ?></h1>
                </div>
                <div class="productsContainer">
                    <form action="../Frames/pantalla-producto.php" method="post">
                        <input type="hidden" name="id_product" value="<?php echo $row['ID_Producto']; ?>">
                        <button class="productBoxContainer">
                            <div class="photoContainer">
                                <img class="photo" src="../Product-Images/<?php echo $row['Imagen']; ?>" alt="<?php echo $row['Nombre_Prod']; ?>">
                            </div>
                            <div class="infoProductBox">
                                <h2 class="price">$<?php echo $row['Precio']; ?></h2>
                                <h1 class="descriptionProductBox"><?php echo $row['Nombre_Prod']; ?></h1>
                            </div>
                        </button>
                    </form>
                </div>
            </article>
            <?php
        }
    } else {
        // Display all categories and their products
        while ($row = $result->fetch_assoc()) {
            $categoria = $row['Categoria'];
            $productQuery = "SELECT " . implode(",", $columas) . " FROM $table WHERE Id_usser_regristro = $input AND Categoria = '$categoria' $where";
            $productResult = $Conexion_usser_select->query($productQuery);

            if ($productResult && $productResult->num_rows > 0) {
            ?>
                <article class="sectionProductsContainer" id="sectionProductsContainer">
                    <div class="titleSectionC">
                        <h1 class="titleSection"><?php echo $categoria; ?></h1>
                    </div>
                    <div class="productsContainer">
                        <?php
                        while ($productRow = $productResult->fetch_assoc()) {
                        ?> <form action="../Frames/pantalla-producto.php" method="post">
                                <input type="hidden" name="id_product" value="<?php echo $productRow['ID_Producto']; ?>">
                                <button class="productBoxContainer">
                                    <div class="photoContainer">
                                        <img class="photo" src="../Product-Images/<?php echo $productRow['Imagen']; ?>" alt="<?php echo $productRow['Nombre_Prod']; ?>">
                                    </div>
                                    <div class="infoProductBox">
                                        <h2 class="price">$<?php echo $productRow['Precio']; ?></h2>
                                        <h1 class="descriptionProductBox"><?php echo $productRow['Nombre_Prod']; ?></h1>
                                    </div>
                                </button>
                            <form action="></form>
                            <?php
                        }
                            ?>
                    </div>
                </article>
<?php
            }else{?>
                <article class="sectionProductsContainer" id="sectionProductsContainer">
                    <div class="titleSectionC">
                        <h1 class="titleSection"><?php echo $categoria; ?></h1>
                    </div>
                    <div class="productsContainer">
                    <h1 id="Noresult">Sin resultados</h1>
                    </div>
                </article>
                <?php }
        }
    }
} else {
    echo '<h1 id="Noresult">Sin resultados</h1>';
}
?>