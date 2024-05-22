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
// Incluir el archivo de conexión
require_once('../php-servicios/Conexion_db/conexion_usser_select.php');

// Comprobar si la sesión está iniciada
session_start();
if (!isset($_SESSION['id'])) {
//     // Si no hay sesión iniciada, redireccionar o manejar el caso según tus necesidades
//     // Por ejemplo, redireccionar a una página de inicio de sesión
    header('Location:..\Frames\pantalla-Login.html');
    exit(); // Asegúrate de detener el script después de la redirección
}



// Obtener el ID de usuario de la sesión
if (!isset($_POST['id_product'])) {
    $id_product = 5;
} else {
    $id_product = $_POST['id_product'];
}
// Código para almacenar productos visitados en cookies
if (isset($_POST['id_product'])) {
    $id_producto = $_POST['id_product'];
    // Obtener productos visitados almacenados en la cookie, si los hay
    $productos_visitados = isset($_COOKIE['productos_visitados']) ? json_decode($_COOKIE['productos_visitados'], true) : [];
    // Agregar el nuevo producto visitado a la lista
    $productos_visitados[] = $id_producto;
    // Convertir la lista de productos visitados a formato JSON y guardarla en la cookie
    setcookie('productos_visitados', json_encode($productos_visitados), time() + (86400 * 30), "/"); // 86400 = 1 día
}


//extraido desde el perfil con el boton del editar producto

// Preparar la consulta para obtener los datos del usuario
$sql = "SELECT Nombre_Prod, Descripcion, Precio, Categoria, Subcategoria, Id_usser_regristro,Imagen FROM productos WHERE ID_Producto = ?";
// Verificar si la preparación de la consulta tuvo éxito

$stmt = mysqli_prepare($Conexion_usser_select, $sql);
if (!$stmt) {
    exit('Error en la preparación de la consulta: ' . mysqli_error($Conexion_usser_select));
}
// Vincular parámetro(s) a la consulta preparada
mysqli_stmt_bind_param($stmt, "i", $id_product);

// Ejecutar la consulta preparada
mysqli_stmt_execute($stmt);

// Vincular variables a los resultados de la consulta
mysqli_stmt_bind_result($stmt, $Nombre_Prod, $Descripcion, $Precio, $Categoria, $Subcategoria, $id_Seller, $Imagen);

// Obtener los resultados
mysqli_stmt_fetch($stmt);

// Cerrar la consulta preparada
mysqli_stmt_close($stmt);


$sql2 = "SELECT Contact_description,profile_Description,instagram,x,whatsapp FROM seller_porfile WHERE Id_sellerP = ?";
// Verificar si la preparación de la consulta tuvo éxito


$stmt2 = mysqli_prepare($Conexion_usser_select, $sql2);
if (!$stmt2) {
    exit('Error en la preparación de la consulta: ' . mysqli_error($Conexion_usser_select));
}
// Vincular parámetro(s) a la consulta preparada
mysqli_stmt_bind_param($stmt2, "i", $id_Seller);

// Ejecutar la consulta preparada
mysqli_stmt_execute($stmt2);

// Vincular variables a los resultados de la consulta
mysqli_stmt_bind_result($stmt2, $Descripcion_contact, $profile_Description, $instagram, $x, $whatsapp);

// Obtener los resultados
mysqli_stmt_fetch($stmt2);

// Cerrar la consulta preparada
mysqli_stmt_close($stmt2);

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Producto</title>
    <link rel="stylesheet" href="../Componentes/header.css">
    <link rel="stylesheet" href="../Componentes/productBoxSmaller.css">
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
                                <a href="../Frames/Pantalla-Subcategoria.php?categoria=<?php echo $cat['Nombre_Cat']; ?>" name="" class="linkCategoriesOption">
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
                    <img src="../Product-Images/<?php echo $Imagen?>" class="imagen">
                    </div>
                </section>
                <section id="more_products">
                <?php
        $productos = mysqli_query($Conexion_usser_select, "SELECT DISTINCT * FROM productos WHERE Id_usser_regristro = $id_Seller ORDER BY RAND() LIMIT 15"); ?>
        <article class="productsContainer">
            <div class="subcategoryTitleContainer">
                <h2 class="subcategoryTitle">Productos del vendedor</h2>
            </div>
            <section class="subcategoryCarrusel">
                <section class="containerCarrusel">
                    <button class="carruselButton prev">
                        <</button>
                            <section class="carrusel">
                                <section class="productsCarrusel">
                                    <?php while ($producto = mysqli_fetch_array($productos)) { ?>
                                        <form action="../Catalog/Show-product.php" method="post">
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
                <!-- ---------------------------------------------------------------------------- -->

                <!-- Contenedor Información de contacto -->
            </section>
        </article>
                </section>
            </section>
            <section id="container_info">
                <br><br><br>
                <p id="precio">$<?php echo $Precio?></p><br>
                <h1 class="namP"><?php echo $Nombre_Prod
                                    ?></h1>
                <p id="verd">Top 5 en popularidad</p>
                <p class="desc"><b>Horario de Estancia: <br></b> 7:00am - 2:00pm</p>
                <p class="desc"><?php echo $Descripcion
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
        <!-- Contenedor de la valoración -->


        <section class="cont-Valoracion">
            <section class="writeCommentSection">
                <section class="part-Comentarios">
                    <div class="subcategoryTitleContainer">
                        <h2 class="productDescriptionTitle">Deja un Comentario</h2>
                    </div>
                    <form id="inputVal" method="post" action="../php-servicios/save_data/save_new_comentario.php">
                        <input type="hidden" name="fecha_Coment" value="<?php echo date('Y-m-d'); ?>">
                        <input type="hidden" name="hora_comentario" value="<?php echo date('H:i:s'); ?>">
                        <input type="hidden" name="id_prod" value="<?php echo $id_product; ?>">
                        <textarea placeholder="Escribe una reseña del producto" name="descripcion" id="text-Comen" required></textarea>
                        <!-- <input type="text" placeholder="Escribe una reseña del producto" name="descripcion" id="text-Comen"> -->
                        <article class="input-Comentar"><input class="submit-Com" type="submit" value="Comentar"></article>
                    </form>
                </section>
            </section>
            
            <section class="reviewSectionContainer">
                <section class="part-Reseñas">
                    <div class="subcategoryTitleContainer">
                        <h2 class="productDescriptionTitle">Reseñas</h2>
                    </div>
                    <section class="contRes" id="contRes">
    
                    </section>
                </section>
            </section>
        </section>
        <form action="" method="post">
            <input type="hidden" value="<?php echo $id_product ?>" name="id_product" id="id_product">
        </form>
        <script>
            document.addEventListener("DOMContentLoaded", getData);

            function getData() {
                let input = document.getElementById("id_product").value;
                let content = document.getElementById("contRes");
                let url = "../php-servicios/load_data/load-info-comentarios-Pantalla-seller.php";
                let formData = new FormData();
                formData.append('id_product', input);

                fetch(url, {
                        method: "POST",
                        body: formData
                    }).then(response => response.text())
                    .then(data => {
                        console.log(data);
                        content.innerHTML = data;
                    }).catch(err => console.log(err));
            }
        </script>
    </main>
<!--------------------------------------------------------->
<script src="../Scripts/Script-Show-catalogo.js"></script>
<!--------------------------------------------------------->
</body>

</html>