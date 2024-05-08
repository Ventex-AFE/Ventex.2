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
$id_product = $_POST['id_product'];//extraido desde el perfil con el boton del editar producto
// $id_usser = 5;
// Preparar la consulta para obtener los datos del usuario
$sql = "SELECT Nombre_Prod, Descripcion, Precio, Categoria, Subcategoria,  FROM seller_porfile WHERE id_product = ?";
$stmt = mysqli_prepare($Conexion_usser_select, $sql);

// Vincular parámetro(s) a la consulta preparada
mysqli_stmt_bind_param($stmt, "i", $id_product);

// Ejecutar la consulta preparada
mysqli_stmt_execute($stmt);

// Vincular variables a los resultados de la consulta
mysqli_stmt_bind_result($stmt, $profile_Description, $Contact_description, $instagram, $x, $whatsapp, $facebook);

// Obtener los resultados
mysqli_stmt_fetch($stmt);

// Cerrar la consulta preparada
mysqli_stmt_close($stmt);
?>

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventex</title>
    <!-- Enlaces a tus hojas de estilo y fuentes -->
    <link rel="stylesheet" href="../Styles/Styles-Edit-Product.css">
    <link href="https://fonts.googleapis.com/css2?family=Cabin&family=Cabin+Sketch&family=Hammersmith+One&family=Hind:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <!-- Barra de navegación -->
    <nav id="nav">
        <h1 id="name">Ventex</h1>
        <!-- Botones de navegación -->
        <button class="buttonP">Inicio</button>
        <button class="buttonP">Categoría</button>
        <button class="buttonP">Planes</button>
        <!-- Barra de búsqueda -->
        <input type="search" name="search" id="search">
        <!-- Sección para fotos de perfil  -->
        <section id="photo"></section>
    </nav>
    <!-- Contenido principal -->
    <section id="main">
                  
        <!-- Sección lateral 1 -->
        <section id="side1">
            <h1 id="Descrip-AgregarP">Actualiza</h1>
            <h3 id="Descrip-AgregarP2">Información producto</h3>
        </section>
        <!-- Sección lateral 2 (formulario para actualizar redes sociales) -->
        <section id="side2">
             <section id="imagen-usser-container">
                <img src="../Icons/bolsa-de-la-compra.png" id="imagen-product" >
             </section>
            <form action="..\php-servicios\save_data\save-actualizacion-datos-personales.php" method="post">
                <input type="hidden" name="id_Product_update" value=""><!-- aqui va ir lo de sesion -->
                <br>
                <!-- Inputs para actualizar datos de redes sociales -->
                <div class="inputbox" style="height: 6vh;">
                    <input type="text" name="Nombre_Prod" class="inp" placeholder=" " required><br>
                    <span class="text_input">Nombre del producto:</span>
                </div>
                <div class="inputbox" style="height: 6vh;">
                    <input type="text" name="Precio" class="inp" placeholder=" " required><br>
                    <span class="text_input">Precio:</span>
                </div>
                <div class="inputbox" style="height: 6vh;">
                    <input type="text" name="categoria" class="inp" placeholder=" " required><br>
                    <span class="text_input">Categoría</span>
                </div>
                <div class="inputbox" style="height: 6vh;">
                    <input type="text" name="subcategoria" class="inp" placeholder=" " required><br>
                    <span class="text_input">Subcategoría</span>
                </div>
                <!-- Botón para enviar el formulario -->
                <div id="button-div">
                    <button type="submit" id="button-sumit">Actualizar</button>
                </div>
            </form>
        </section>
    </section>
    <!-- Pie de página -->
    <footer id="footler-v">
        <h1 id="name-footer">Ventex</h1>
    </footer>
</body>
</html>
