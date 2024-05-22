<?php
// require_once('conexion.php');
// session_start();
// $id=$_POST['id'];
// $catP=$_POST['categ'];
// $more=mysqli_query($conexion, "SELECT * FROM products WHERE category = '$catP' ORDER BY RAND() LIMIT 3");
// $buscar=mysqli_query($conexion, "SELECT * FROM products WHERE id = '$id'");
// $prod=mysqli_fetch_array($buscar);
// $seller= $prod['seller'];
// echo $seller;
// $cont=mysqli_query($conexion, "SELECT * FROM sellerprofile WHERE nameSeller = '$seller'");
// $cats = mysqli_query($conexion, "SELECT DISTINCT category FROM products;");
// $contact=mysqli_fetch_array($cont);
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
    <title>Producto</title>
    <link rel="stylesheet" href="../Componentes/header.css">
    <link rel="stylesheet" href="../Styles/Styles-Show-products.css">
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
        <article id="container">
            <section id="container_left">
                <section id="container_pictures">
                    <div id="container_p">
                        <img src="imgs/<?php //echo $prod['productImage'] ?>" class="imagen">
                    </div>
                </section>
                <section id="more_products">
                    <br>
                    <h1 class="prec">Más Productos</h1><br>
                    <!-------------------------------------------------------------------------------------------------------->
                    <?php //while( $mostrar=mysqli_fetch_array($more)) { 
                    ?>

                    <form action="p_producto.php" method="post" id="form1">
                        <button class="m_product" onclick="enviarFormulario()">
                            <input type="hidden" name="id" value="<?php //echo $mostrar['id'];
                                                                    ?>">
                            <input type="hidden" name="categ" value="<?php //echo $mostrar['category'];
                                                                        ?>">
                            <section> <!--Esto contiene la informacion de un producto-->
                                <div class="mc_picture">
                                    <!--Imagen del Producto----><img src="imgs/<?php //echo $mostrar['productImage'] 
                                                                                ?>" class="m_imagen">
                                </div>
                                <div class="m_info">
                                    <div class="m_precio">
                                        <!--Precio del Producto---->
                                        <h1 class="precio">$<?php //echo $mostrar['price'] 
                                                            ?></h1>
                                    </div>
                                    <div class="m_nombre">
                                        <!--Nombre del Producto---->
                                        <p class="nombre"><?php //echo $mostrar['nameProduct'] 
                                                            ?></p>
                                    </div>
                                </div>
                            </section>

                            <script>
                                function enviarFormulario() {
                                    document.getElementById('form1').submit();
                                }
                            </script>
                        </button>
                    </form>

                    <?php //}
                    ?>
                    <!-------------------------------------------------------------------------------------------------------->

                </section>
            </section>
            <section id="container_info">
                <br><br><br>
                <p id="precio">$<?php //echo $prod['price']
                                ?></p><br>
                <h1 class="namP"><?php //echo $prod['nameProduct']
                                    ?></h1>
                <p id="verd">Top 5 en popularidad</p>
                <p class="desc"><b>Horario de Estancia: <br></b> 7:00am - 2:00pm</p>
                <p class="desc"><?php //echo $prod['descriptionP']
                                ?></p>
                <p id="mas">¿Quieres ver mas productos de este vendedor?</p><br><br>
                <form action="vc_perfil.php" method="post">
                    <form action="vc_perfil.php">
                        <input type="hidden" name="vendedor" value="<?php //echo $prod['seller'];
                                                                    ?>">
                        <input type="submit" id="bot" value="Ver perfil del vendedor">
                    </form>
            </section>

            <section id="contact_information">
                <br><br>
                <p class="namP">Información de contacto</p>
                <div class="container_links">
                    <a href="<?php //echo $contact['instagram']
                                ?>">
                        <div class="link"></div>
                    </a>
                </div>
                <p class="contact_description"><?php //echo $contact['Contactdescription']
                                                ?></p>
            </section>
        </article>
    </main>

</body>

</html>