<?php
// Incluir el archivo de conexión
require_once('../php-servicios/Conexion_db/conexion_usser_select.php');

// Comprobar si la sesión está iniciada
session_start();
// if (!isset($_SESSION['id'])) {
//     // Si no hay sesión iniciada, redireccionar o manejar el caso según tus necesidades
//     // Por ejemplo, redireccionar a una página de inicio de sesión
//     header("Location: login.php");
//     exit;
// }

// Obtener el ID de usuario de la sesión
if(!isset($_POST['id_product'])){
    $id_product = 5;
}else{
    $id_product = $_POST['id_product'];
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
mysqli_stmt_bind_result($stmt2, $Descripcion_contact,$profile_Description,$instagram,$x,$whatsapp);

// Obtener los resultados
mysqli_stmt_fetch($stmt2);

// Cerrar la consulta preparada
mysqli_stmt_close($stmt2);
$more = mysqli_query($Conexion_usser_select, "SELECT * FROM productos WHERE Categoria = '$Categoria' ORDER BY RAND() LIMIT 5");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Producto</title>
    <link rel="stylesheet" href="../Styles/Styles-producto.css">
    <link rel="stylesheet" href="../Componentes/header-v.css">
    <link rel="stylesheet" href="../Componentes/productBox.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <header class="main-container-header">
        <section class="c-logo">
            <p class="logo">Ventex</p>
        </section>
        <section class="h-options">
            <button class="butt-h">Inicio</button>
            <button class="butt-h">Categorías</button>
            <button class="butt-h">Planes</button>
            <button class="butt-h">Vender</button>
            <form action="" method="post">
                <input type="search" name="search-product" id="search-p">
            </form>
        </section>
        <section class="profileContainer">
            <button class="basket"> <img src="#" alt=""></button>
            <button class="profile"></button>
        </section>
    </header>
    <section id="containerD">
        <section id="ima">
            <section class="imagen"><img src="../Imagens-Products/img.png"></section>
            <section class="imagen"><img src="../Imagens-Products/img.png"></section>
            <section class="imagen"><img src="../Imagens-Products/img.png"></section>
            <section class="imagen"><img src="../Imagens-Products/img.png"></section>
        </section>
        <section id="bigima">
            <section class="phpto"><img src="../Product-Images/<?php echo $Imagen ?>"></section>
        </section>
        <article id="description">
            <section class="desc">
                <h1 class="namP"><?php echo $Nombre_Prod ?></h1>
                <p id="precio">$<?php echo $Precio ?></p><br>

                <p id="verd">Top 5 en popularidad</p>
                <p class=""><b><?php echo $Descripcion_contact ?><br></b></p>
                <p class=""><?php echo $Descripcion ?></p>
                <p id="mas">¿Quieres ver mas productos de este vendedor?</p>
                <form action="../Frames/pantalla-perfil-vc.php" method="post">
                    <input type="hidden" name="Id_seller" value="<?php echo $id_Seller; ?>">
                    <input type="submit" id="bot" value="Ver perfil del vendedor">
                </form>

            </section>
        </article>
    </section>

    <section id="containerT">
        <article id="textU">
            <h1 class="textorel">Productos Relacionados</h1>
        </article>
        <section class="cont">
            <?php while ($mostrar = mysqli_fetch_array($more)) { ?>

                <form action="../Frames/pantalla-producto.php" method="post" id="form1">
                    <button class="producto" onclick="enviarFormulario()">
                        <input type="hidden" name="id_product" value="<?php echo $mostrar['ID_Producto']; ?>">
                        <section> <!--Esto contiene la informacion de un producto-->
                            <article class="part1"><img src="../Product-Images/<?php echo $mostrar['Imagen']; ?>"></article>
                            <article class="part2">
                                <article>
                                    <p>$<?php echo $mostrar['Precio'] ?></p>
                                </article>
                                <article>
                                    <p><?php echo $mostrar['Nombre_Prod'] ?></p>
                                </article>
                            </article>
                        </section>

                        <script>
                            function enviarFormulario() {
                                document.getElementById('form1').submit();
                            }
                        </script>
                    </button>
                </form>

            <?php } ?>
        </section>
        <section class="contD">
            <section class="partU">
                <article id="textD">
                    <article>
                        <h1 id="Informacion">Informacion de contacto</h1>
                    </article>
                </article>
                <article id="contacto">
                    <article class="redes">
                        <article class="red"><a href="<?php echo $instagram ?>"><img src="../Icons/instagram.png"></a></article>
                        <article class="red"><a href="<?php echo $whatsapp ?>"><img src="../Icons/whatsapp.png"></a></article>
                        <article class="red"><a href="<?php echo $x ?>"><img src="../Icons/x.png" alt=""></a></article>
                    </article>
                </article>
            </section>
            <section class="partU2">
                <article id="descriptionD">
                    <p class="text"><?php echo $profile_Description ?>

                    </p>
                </article>
            </section>
        </section>
    </section>


    <section class="conte">
        <section class="partU">
            <article id="valoracion">

                <section class="textVal">
                    <h2>Valoracion</h2>
                </section>

                <section id="rating">
                    <input type="radio" name="star">
                    <input type="radio" name="star">
                    <input type="radio" name="star">
                    <input type="radio" name="star">
                    <input type="radio" name="star">
                </section>

                <article id="inputVal">
                    <input type="text" placeholder="Escribe una reseña del producto">
                </article>
                <article id="inputSub"><input type="submit"></article>
            </article>
        </section>
        <section class="partU">
            <article id="reseña">
                <section class="textVal">
                    <h2>Reseñas</h2>
                    <h1>Promedio de estrellas:</h1>
                </section>
                <section class="contRes">
                    <article class="viewRes">
                        <p>No hay reseña</p>
                    </article>
                    <article class="viewRes">esta chido</article>
                    <article class="viewRes">esta chido</article>
                    <article class="viewRes">esta chido</article>
                    <article class="viewRes">esta chido</article>

                    <article class="viewRes">
                        <p>ygygygygygygygygygygygygygygygygygygygygygygygygygygygygygygygygygygygygygygygygygygygygygygygygygygygygfd
                            hffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff
                            aisuggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggg
                            ytuhuuuuuuuuuuuuuuuuuuuuuuuuyh
                        </p>
                    </article>
                    <article class="viewRes">no me gustos</article>
                </section>
            </article>
        </section>
    </section>
</body>
<footer></footer>

</html>