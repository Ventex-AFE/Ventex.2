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
$id_usser = $_SESSION['id'];
//$id_usser = 5;
// Preparar la consulta para obtener los datos del usuario
$sql = "SELECT profile_Description, Contact_description, instagram, x, whatsapp, facebook FROM seller_porfile WHERE Id_sellerP = ?";
$stmt = mysqli_prepare($Conexion_usser_select, $sql);

// Vincular parámetro(s) a la consulta preparada
mysqli_stmt_bind_param($stmt, "i", $id_usser);

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
    <link rel="stylesheet" href="../Styles/Styles-Edit-RedesSocial.css">
    <link rel="stylesheet" href="../Componentes/header.css">
    <link rel="stylesheet" href="../Componentes/footer.css">
    <link href="https://fonts.googleapis.com/css2?family=Cabin&family=Cabin+Sketch&family=Hammersmith+One&family=Hind:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <header>
            <section><p class="logo">Ventex</p></section>
            <nav>
                <ul class="menu">
                    <li><a href="">Inicio</a></li>
                    <li><a href="">Categoria</a></li>
                    <li><a href="">Planes</a></li>
                    <li><a href="">Vender</a></li>
                </ul>
            </nav>
            <form class="busqueda">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" placeholder="Buscar">
            </form>
            <section class="imgProfile">
                <div></div>
            </section>
    </header>


    <!-- Contenido principal -->
    <section id="main">
        <!-- Sección lateral 1 -->
        <section id="side1">
            <h1 id="Descrip-AgregarP">Actualiza</h1>
            <h3 id="Descrip-AgregarP2">Redes sociales</h3>
        </section>
        <!-- Sección lateral 2 (formulario para actualizar redes sociales) -->
        <section id="side2">

            <form action="../php-servicios/save_data/save-actulizacion-RedesSociales.php" method="post">
                <input type="hidden" name="id-usser-update" value=""><!-- aqui va ir lo de sesion -->
                <br>
                <!-- Inputs para actualizar datos de redes sociales -->
                <div class="inputbox" style="height: 5vh;">
                    <input type="text" name="description" class="inp" placeholder=" " required value="<?php echo $profile_Description; ?>"><br>
                    <span class="text_input">Descripción</span>
                </div>
                <div class="inputbox" style="height: 5vh;">
                    <input type="text" name="whatsapp" class="inp" placeholder=" " required value="<?php echo $whatsapp; ?>"><br>
                    <span class="text_input">WhatsApp</span>
                </div>
                <div class="inputbox" style="height: 5vh;">
                    <input type="text" name="x" class="inp" placeholder=" " required value="<?php echo $x; ?>"><br>
                    <span class="text_input">X</span>
                </div>
                <div class="inputbox" style="height: 5vh;">
                    <input type="text" name="facebook" class="inp" placeholder=" " required value="<?php echo $facebook; ?>"><br>
                    <span class="text_input">Facebook</span>
                </div>
                <div class="inputbox" style="height: 5vh;">
                    <input type="text" name="instagram" class="inp" placeholder=" " required value="<?php echo $instagram; ?>"><br>
                    <span class="text_input">Instagram</span>
                </div>
                <div class="inputbox" style="height: 5vh;">
                    <input type="text" name="contact_info" class="inp" placeholder=" " required value="<?php echo $Contact_description; ?>"><br>
                    <span class="text_input">Información de contacto</span>
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