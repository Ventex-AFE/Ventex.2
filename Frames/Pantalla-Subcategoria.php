<?php
require_once('../php-servicios/Conexion_db/conexion_usser_select.php');
$cats = mysqli_query($Conexion_usser_select, "SELECT DISTINCT Nombre_Cat FROM categoria;");

$mywher = isset($_GET['categoria']) ? $_GET['categoria'] : null /*'Ropa'*/;
$busc = null;

if ($mywher != null) {
    $busc = "SELECT * FROM productos WHERE Categoria = '$mywher'";
    $more = mysqli_query($Conexion_usser_select, "SELECT * FROM productos WHERE Categoria = '$mywher' ORDER BY RAND() LIMIT 5");
} else {
    $busc = "SELECT * FROM productos";
}
$subc = mysqli_query($Conexion_usser_select, "SELECT DISTINCT Nombre_Subcat,foto_subcategoria FROM subcategoria WHERE Categoria='$mywher';");
$ex = mysqli_query($Conexion_usser_select, $busc);

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Categoria</title>
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
                                <a href="Pantalla-Subcategoria.php?categoria=<?php echo $cat['Nombre_Cat']; ?>" name="" class="linkCategoriesOption">
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
        <section class="busqueda">
            <form class="busquedaForm" action="../Frames/Pantalla-Busqueda.php" method="post" onsubmit="return enviarFormulario()">
                <input type="search" placeholder="Buscar" name="busqueda" class="inputSearchHeader" require>
                <button class="searchButtonHeader">
                    <img src="../Icons/lupaB.png" alt="" class="imageSearchHeader">
                </button>
            </form>
        </section>
        <section class="imgProfile">
            <div></div>
        </section>
    </header>
    <main>
        <!--- SUBCATEGORIES --------------------------------------------------------------------------------------------------->

        <article class="subcategoriesSection">
            <h1 class="categoryName"><?php echo $mywher; ?></h1>
            <br>
            <?php while ($subcat = mysqli_fetch_array($subc)) { ?>
                <form action="Pantalla-subcategoria-sub.php" method="post" class="subcategoria-form">
                    <button class="subcategoryButton" type="submit">
                        <div class="subcategoryPhotoContainer">
                            <img src="../Product-Images/Imagenes-subcategorias/<?php echo $subcat['foto_subcategoria']; ?>" alt="Nones" class="subcategoryPhoto">
                        </div>
                        <div class="subcategoryNameContainer">
                            <input type="hidden" name="id" value="<?php echo $subcat['Nombre_Subcat']; ?>">
                            <p class="subcategoryName"><?php echo $subcat['Nombre_Subcat']; ?></p>
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
        <article class="recommendedPorductsSection">
            <div class="subcategoryTitleContainer">
                <h2 class="subcategoryTitle">Recomendados</h2>
            </div>
            <?php while ($producto_more = mysqli_fetch_array($more)) { ?>
                <form action="../Frames/pantalla-producto.php" method="post">
                    <input type="hidden" name="id_product" value="<?php echo $producto_more['ID_Producto']; ?>">
                    <button class="recommendedCategoryProductContainer">
                        <img src="../Product-Images/<?php echo $producto_more['Imagen']; ?>" alt="" class="recommendedProductImage">
                        <div class="recommendedProductTitleContainer">
                            <h1 class="recommendedProductTitle"><?php echo $producto_more['Nombre_Prod']; ?></h1>
                        </div>
                </form>
            <?php } ?>
        </article>
        <!--- ADVERTISING 2 ------------------------------------------------------------------------------------------------->
        <article class="advertisingLargeContainer">
            <div class="advertisingLargeBox">
                <img src="../Product-Images/textura-cocodrilo.avif" alt="" class="adverstisingImage">
                <h1 class="advertisingTitle">Ventex es para ti</h1>
            </div>
        </article>
        <!------------------------------------------------------------------------------------------------------------------->

        <?php
        $subc = mysqli_query($Conexion_usser_select, "SELECT DISTINCT Subcategoria FROM productos WHERE categoria='$mywher';");
        while ($subcat = mysqli_fetch_array($subc)) {
            $subcategoria = $subcat['Subcategoria'];
            $productos = mysqli_query($Conexion_usser_select, "SELECT * FROM productos WHERE Categoria='$mywher' AND Subcategoria='$subcategoria'");
        ?>
      <?php while ($subcat = mysqli_fetch_array($subc)) { ?>
    <article class="productsContainer">
        <section class="subcategoryCarrusel">
            <div class="subcategoryTitleContainer">
                <h2 class="subcategoryTitle"><?php echo $subcat['Subcategoria']; ?></h2>
            </div>
            <section class="containerCarrusel">
                <button class="carruselButton prev"><</button>
                <section class="carrusel">
                    <section class="productsCarrusel">
                        <?php
                        $productos = mysqli_query($Conexion_usser_select, "SELECT * FROM productos WHERE Categoria='$mywher' AND Subcategoria='{$subcat['Subcategoria']}'");
                        while ($producto = mysqli_fetch_array($productos)) { ?>
                            <form action="../Frames/pantalla-producto.php" method="post">
                                <input type="hidden" name="id_product" value="<?php echo $producto['ID_Producto']; ?>">
                                <button class="productContainer" type="submit">
                                    <div class="productPhoto">
                                        <img src="../Product-Images/<?php echo $producto['Imagen']; ?>" class="productImage" />
                                    </div>
                                    <div class="productPrice">
                                        <p class="priceStyle">$<?php echo $producto['Precio']; ?></p>
                                    </div>
                                    <div class="productName">
                                        <p class="nameStyle"><?php echo $producto['Nombre_Prod']; ?></p>
                                    </div>
                                </button>
                            </form>
                        <?php } ?>
                    </section>
                </section>
                <button class="carruselButton next">></button>
            </section>
        </section>
    </article>
<?php }} ?>

    </main>
    <footer></footer>
    <script src="../Scripts/Script-subcategoria.js"></script>
</body>

</html>