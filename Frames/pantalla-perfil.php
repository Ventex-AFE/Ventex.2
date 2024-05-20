<?php
session_start();

if (!isset($_SESSION['id'])) {
    // Si no hay sesión iniciada, redireccionar a la página de inicio de sesión
    header("Location: ../Frames/pantalla-Login.html");
    exit;
} 

if($_SESSION['Type'] === 2){
    //header("Location: ../Frames/Pantalla-Perfil.php");
}else{
    header("Location: ../Frames/Pantalla-Perfil-Vip.php");
}

require_once('../php-servicios/Conexion_db/conexion_usser_select.php');
// Obtener el ID de usuario de la sesión
$id_usser = $_SESSION['id'];
//$id_usser = 5;
// Preparar la consulta para obtener los datos del usuario
$sql = "SELECT instagram, x, whatsapp, facebook FROM seller_porfile WHERE Id_sellerP = ?";
$stmt = mysqli_prepare($Conexion_usser_select, $sql);

// Vincular parámetro(s) a la consulta preparada
mysqli_stmt_bind_param($stmt, "i", $id_usser);

// Ejecutar la consulta preparada
mysqli_stmt_execute($stmt);

// Vincular variables a los resultados de la consulta
mysqli_stmt_bind_result($stmt, $instagram, $x, $whatsapp, $facebook);

// Obtener los resultados
mysqli_stmt_fetch($stmt);

// Cerrar la consulta preparada
mysqli_stmt_close($stmt);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Perfil</title>
    <link rel="stylesheet" href="../Componentes/header.css">
    <link rel="stylesheet" href="../Componentes/footer.css">
    <link rel="stylesheet" href="../Componentes/extensibleSearchInput.css">
    <link rel="stylesheet" href="../Styles/Styls-profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <style>
        /* <-------Styles extensible search input*/
        .searchSection {
            text-align: left;
        }

        .searchButton {
            /*<------Color Button*/
            background-color: black;
        }

        #searchP:valid~.searchButton {
            /* <------Color of the button when te input is valid*/
            background-color: rgb(66, 94, 66);
        }
    </style>
</head>

<body>
    <header>
        <section>
            <p class="logo">Ventex</p>
        </section>
        <nav>
            <ul class="menu">
                <li><a href="">Inicio</a></li>
                <li><a href="">Categoria</a></li>
                <li><a href="">Planes</a></li>
                <li><a href="">Vender</a></li>
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
        <section class="parent">
            <section class="parent_Child">
                <section class="parent_FirstChild">
                    <article id="background">
                    <article id="profile_Card_Img"><img id="profile_Card_Img" src="../Imgens-Pefil/<?php echo $_SESSION['img']; ?>" ></article>
                    </article>

                </section>

                <section class="parent_LastChild">
                    <article class="info">
                        <a href="Pantalla-Edit-Info-Personal.php" class="edit"><i class="fa-solid fa-user-pen"></i></a>
                        <h1><?php echo $_SESSION['name']; ?> </h1>
                        <h2> <?php echo $_SESSION['email']; ?></h2>
                        <section class="details">
                            <section class="data">
                                <table>
                                    <tr>
                                        <td>Fecha de nacimiento: </td>
                                        <td><?php echo $_SESSION['birthdate']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Número de teléfono: </td>
                                        <td><?php echo $_SESSION['phone']; ?></td>
                                    </tr>
                                </table>
                            </section>
                        </section>

                        <section class="socialMedia">
                            <section class="info-edit">
                                <h1>Informacion de Contacto</h1>
                                <a href="Pantalla-Edit-RedesSocial.php"><i class="fa-solid fa-pen"></i></a>
                            </section>

                            <section>
                                <a href="<?php echo $facebook ?>"><i class="fa-brands fa-facebook"></i></a>
                                <a href="<?php echo $x ?>"><i class="fa-brands fa-square-x-twitter"></i></a>
                                <a href="<?php echo $whatsapp ?>"><i class="fa-brands fa-tiktok"></i></a>
                            </section>

                            <a href="../Frames/Pantalla-Pago-Suscripcion.php" class="subs">Suscribirse</a>
                            <a href="../php-servicios/deletion_data/deletion_session_usser.php" class="subs">Cerrar Sesión <i class="fa-solid fa-right-from-bracket"></i></a>

                        </section>


                </section>

            </section>
            <!--Info del vendedor------------------------------------------------------------------------------------------->
            <section class="parent_Child">
                <section class="parent_LastChild">
                    <section class="group">
                        <div class="searchContainer">
                            <input type="search" name="searchP" id="searchP" placeholder="Buscar" required onkeyup="getData()"> 
                            <button class="searchButton"><img src="../Icons/lupaB.png" alt="" class="searchIcon"></button>
                        </div>
                        <section class="cards">



                            <script>

                                document.addEventListener("DOMContentLoaded", getData);

                                function getData() {
                                    let input = document.getElementById("searchP").value;
                                    let content = document.getElementById("resultados");
                                    let url = "../php-servicios/load_data/load-info-pantalla-perfil.php";
                                    let formData = new FormData();
                                    formData.append('searchP', input);

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


                    <div id="resultados"></div>


                            <div id="resultados"></div>
                        </section>

                    </section>
                </section>

            </section>
    </main>

    <footer>
        <section class="name-year">
            <h1>2023-Ventex</h1>
        </section>
        <section class="logo-ventex">
            <h1>Ventex</h1>
        </section>
        <section class="socialmedia-ventex">
            <a href=""><i class="fa-brands fa-facebook"></i></a>
            <a href=""><i class="fa-brands fa-square-x-twitter"></i></a>
            <a href=""><i class="fa-brands fa-tiktok"></i></a>
        </section>
    </footer>

</body>

</html>