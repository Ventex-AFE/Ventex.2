<?php
$us = 'Thomas Rogrigez';
require_once('../php-servicios/Conexion_db/conexion_usser_select.php');
$cats = mysqli_query($Conexion_usser_select, "SELECT DISTINCT Nombre_Cat FROM categoria;");

//$exU = mysqli_query($Conexion_usser_select, "SELECT * FROM seller_porfile WHERE Name_Seller = '$us'");

$mywher = isset($_GET['categoria']) ? $_GET['categoria'] : null;
$busc = null;

if ($mywher != null) {
    $busc = "SELECT * FROM productos WHERE Categoria = '$mywher'";
} else {
    $busc = "SELECT * FROM productos";
}
$subc = mysqli_query($Conexion_usser_select, "SELECT DISTINCT Subcategoria FROM productos WHERE categoria='$mywher';");
$ex = mysqli_query($Conexion_usser_select, $busc);

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Ventex</title>
    <link rel="stylesheet" href="../Componentes/header.css">
    <link rel="stylesheet" href="../Componentes/productBoxSmaller.css">
    <link rel="stylesheet" href="../Styles/Styles-Subcategoria.css">
</head>

<body>
<!--- HEADER ------------------------------------------------------------------------------------------------------->
    <header>
        <section>
            <p class="logo">Ventex</p>
        </section>
        <nav>
            <ul class="menu">
                <li><a href="" class="headerOption">Inicio</a></li>
                <li><a href="#" id="categorias" class="headerOption">Categorías</a>
                    <div class="invisible"></div>
                    <ul class="menuv">
                        <?php while ($cat = mysqli_fetch_array($cats)) { ?>
                            <li class="ca">
                                <a href="Pantalla-Subcategoria?categoria=<?php echo $cat['Nombre_Cat']; ?>" name="" class="linkCategoriesOption">
                                    <div class="categorieSection">
                                        <p class="categorieOption"><?php echo $cat['Nombre_Cat']; ?></p>
                                    </div>
                                    
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </li>
                <li><a href="" class="headerOption">Planes</a></li>
                <li><a href="" class="headerOption">Vender</a></li>
            </ul>
        </nav>
        <form class="busqueda" action="../Frames/Pantalla-Busqueda.php" method="post" onsubmit="return enviarFormulario()">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="search" placeholder="Buscar" name="busqueda">
        </form>
        <section class="imgProfile">
            <div></div>
        </section>
    </header>
    <main>
<!--- SUBCATEGORIES --------------------------------------------------------------------------------------------------->

        <article class="subcategoriesSection">
            <h1 class="categoryName">Automoviles y motocicletas</h1>
            <br>
            <?php while ($subcat = mysqli_fetch_array($subc)) { ?>
                <form action="Pantalla-subcategoria-sub.php" method="post" class="subcategoria-form">
                    <button class="subcategoryButton" type="submit">
                        <div class="subcategoryPhotoContainer">
                            <img src="../Imgens-Pefil/melanie.jpeg" alt="Nones" class="subcategoryPhoto">
                        </div>
                        <div class="subcategoryNameContainer">
                            <input type="hidden" name="id" value="<?php echo $subcat['Subcategoria']; ?>">
                            <p class="subcategoryName"><?php echo $subcat['Subcategoria']; ?></p>
                        </div>
                    </button>
                </form>
 
            <?php } ?>
        </article>
<!--- ADVERTISING --------------------------------------------------------------------------------------------------->
        <article class="advertisingContainer">
            <div class="advertisingBox">
                <img src="../Product-Images/lays.jpeg" alt="" class="adverstisingImage">
            </div>
            <div class="advertisingBox">
                <img src="../Product-Images/markverde.jpeg" alt="" class="adverstisingImage">
            </div>
        </article>
<!--- CONTENT ------------------------------------------------------------------------------------------------------->
        <article id="productsContainer">
        <section class="subcategoryTitleContainer">
            <h1 class="subcategoryTitle"><?php echo $mywher ?> Categoría</h1>
        </section>
            <section class="carrusel">
                <button class="carruselButton prev"><</button>
                <section class="productsCarrusel">
                    <!-------------------------------------------------------------------------------------------------------->
                    <?php while ($mostrar = mysqli_fetch_array($ex)) { ?>

                        <form action="../Frames/pantalla-producto.php" method="post">
                            <input type="hidden" name="id_product" value="<?php echo $mostrar['ID_Producto']; ?>">
                            <button class="productContainer" type="submit">
                                <div class="productPhoto">
                                    <img src="../Product-Images/<?php echo $mostrar['Imagen']; ?>" class="productImage" />
                                </div>
                                <div class="productPrice">
                                    <p class="priceStyle">$<?php echo $mostrar['Precio']; ?></p>
                                </div>
                                <div class="productName">
                                    <p class="nameStyle"><?php echo $mostrar['Nombre_Prod']; ?></p>
                                </div>
                            </button>
                        </form>

                    <?php } ?>
                    <!--------------------------------------------------------------------------------------------------------></section>
                <button class="carruselButton next">></button>
            </section>
        </article>
    </main>
    <footer></footer>
    <script src="../Scripts/Script-subcategoria.js"></script>
</body>

</html>