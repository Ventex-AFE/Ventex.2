<?php
require_once('../php-servicios/Conexion_db/conexion_usser_select.php');

// Comprobar si la sesión está iniciada
session_start();
// $usuario = 1;
// $prod = mysqli_query($conexion, "SELECT * FROM products WHERE owner_id = $usuario");
//$Id_usser = $_POST['Id_seller'];
if(isset($_POST['Id_seller'])) {
    $Id_seller = $_POST['Id_seller'];
    // Aquí puedes utilizar el ID del vendedor como necesites
} else {
    // Manejar el caso en que no se envíe el ID del vendedor
    $Id_seller = 5;
}
$sql = "SELECT Name_Seller,profile_Description, Contact_description, instagram, x, whatsapp, facebook FROM seller_porfile WHERE Id_sellerP = ?";
$stmt = mysqli_prepare($Conexion_usser_select, $sql);

// Vincular parámetro(s) a la consulta preparada
mysqli_stmt_bind_param($stmt, "i", $Id_seller);

// Ejecutar la consulta preparada
mysqli_stmt_execute($stmt);

// Vincular variables a los resultados de la consulta
mysqli_stmt_bind_result($stmt, $Name_Seller, $profile_Description, $Contact_description, $instagram, $x, $whatsapp, $facebook);

// Obtener los resultados
mysqli_stmt_fetch($stmt);

// Cerrar la consulta preparada
mysqli_stmt_close($stmt);

$sql2 = "SELECT Imagen FROM usuarioregistrado WHERE ID_Usuario = ?";
$stmt = mysqli_prepare($Conexion_usser_select, $sql2);

mysqli_stmt_bind_param($stmt, "i", $Id_seller);

// Ejecutar la consulta preparada
mysqli_stmt_execute($stmt);

// Vincular variables a los resultados de la consulta
mysqli_stmt_bind_result($stmt, $Imagen);

// Obtener los resultados
mysqli_stmt_fetch($stmt);

// Cerrar la consulta preparada
mysqli_stmt_close($stmt);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventex</title>
    <link rel="stylesheet" href="../Styles/Styles-perifil-vc.css">
    <link rel="stylesheet" href="../Componentes/header-v.css">
    <link rel="stylesheet" href="../Componentes/extensibleSearchInput.css">
    <link rel="stylesheet" href="../Componentes/productBox.css">

    <style>  /* <-------Styles extensible search input*/
        .searchSection{
            text-align: left;
        }
        .searchButton{  /*<------Color Button*/
            background-color: #B0C881;
        }
        #searchP:valid ~ .searchButton {  /* <------Color of the button when te input is valid*/
            background-color: rgb(66, 94, 66);
        }
    </style>
</head>

<body>

    <header class="main-container-header">
        <nav>
            <section class="c-logo">
                <p class="logo">Ventex</p>
            </section>
            <ul class="h-options">
                <li>
                    <button class="butt-h">Inicio</button>
                </li>
                <li>
                    <button class="butt-h">Categorías</button>
                </li>
                <li>
                    <button class="butt-h">Planes</button>
                </li>
                <li>
                    <button class="butt-h">Vender</button>
                </li>
            </ul>
            <section class="">
                <form action="" method="post">
                    <input type="search" name="search-product" id="search-p">
                </form>
            </section>
            <section class="profileContainer">
                <button class="basket"> <img src="../Icons/bolsa-de-la-compra.png" alt=""></button>
                <button class="profile"></button>
            </section>
        </nav>
    </header>
    <main>
        <!--Left------------------------------------------------------------------------------------------->
        <article class="left">
            <section class="personalInfo">
                <div class="photoContainer"><img src="../Imgens-Pefil/<?php echo $Imagen ?>" alt="" class="profilePhoto"></div>
                <div class="nameContainer">
                    <p class="userName"><?php echo $Name_Seller ?></p>
                </div>
                <div class="descriptionContainer">
                    <p class="text"> <?php echo $profile_Description ?>

                    </p>
                </div>
            </section>
            <section class="personalInfo">
                <p class="userName">Información de contacto</p>
                <div class="socialMedia-container">
                    <div class="socialMedia"><a href="<?php echo $whatsapp ?>"><img src="../Icons/whatsapp.png" alt="" class="iconMedia"></a></div>
                    <div class="socialMedia"><a href="<?php echo $instagram ?>"><img src="../Icons/instagram.png" alt="" class="iconMedia"></a></div>
                    <div class="socialMedia"><a href="<?php echo $x ?>"><img src="../Icons/x.png" alt="" class="iconMedia"></a></div>
                </div>
                <p class="text"><?php echo $Contact_description ?>
                </p>
            </section>
        </article>
        <!--Rigth------------------------------------------------------------------------------------------->
        <article class="rigth">
            <section class="searchSection">
                <div class="tit-c">
                    <p class="tit">Productos del Usuario</p>
                </div>
                <div class="searchContainer"> 
                    <form action="" method="post">
                        <input type="search" name="searchP" id="searchP" placeholder="Buscar" required onkeyup="getData()">
                        <input type="hidden" name="usser_id" id="usser_id" value="<?php echo $Id_seller; ?>">
                    </form>
                    <button class="searchButton"><img src="../Icons/lupaB.png" alt="" class="searchIcon"></button>
                </div>
            </section>
                <section id="container_all_products_seller">
                <button class="productContainer">
                    <div class="productPhoto"><img src="../Product-Images/<?php //echo $mostrar['image'] 
                                                                            ?>" class="productImage"></div>
                    <div class="productPrice">
                        <p class="priceStyle">$<?php //echo $mostrar['price'] 
                                                ?></p>
                    </div>
                    <div class="productName">
                        <p class="nameStyle"><?php //echo $mostrar['name'] 
                                                ?></p>
                    </div>
                </button>
                <button class="productContainer">
                    <div class="productPhoto"><img src="../Product-Images/<?php //echo $mostrar['image'] 
                                                                            ?>" class="productImage"></div>
                    <div class="productPrice">
                        <p class="priceStyle">$<?php //echo $mostrar['price'] 
                                                ?></p>
                    </div>
                    <div class="productName">
                        <p class="nameStyle"><?php //echo $mostrar['name'] 
                                                ?></p>
                    </div>
                </button>
                <button class="productContainer">
                    <div class="productPhoto"><img src="../Product-Images/<?php //echo $mostrar['image'] 
                                                                            ?>" class="productImage"></div>
                    <div class="productPrice">
                        <p class="priceStyle">$<?php //echo $mostrar['price'] 
                                                ?></p>
                    </div>
                    <div class="productName">
                        <p class="nameStyle"><?php //echo $mostrar['name'] 
                                                ?></p>
                    </div>
                </button>
                <button class="productContainer">
                    <div class="productPhoto"><img src="../Product-Images/<?php //echo $mostrar['image'] 
                                                                            ?>" class="productImage"></div>
                    <div class="productPrice">
                        <p class="priceStyle">$<?php //echo $mostrar['price'] 
                                                ?></p>
                    </div>
                    <div class="productName">
                        <p class="nameStyle"><?php //echo $mostrar['name'] 
                                                ?></p>
                    </div>
                </button>
                <button class="productContainer">
                    <div class="productPhoto"><img src="../Product-Images/<?php //echo $mostrar['image'] 
                                                                            ?>" class="productImage"></div>
                    <div class="productPrice">
                        <p class="priceStyle">$<?php //echo $mostrar['price'] 
                                                ?></p>
                    </div>
                    <div class="productName">
                        <p class="nameStyle"><?php //echo $mostrar['name'] 
                                                ?></p>
                    </div>
                </button>
                <button class="productContainer">
                    <div class="productPhoto"><img src="../Product-Images/<?php //echo $mostrar['image'] 
                                                                            ?>" class="productImage"></div>
                    <div class="productPrice">
                        <p class="priceStyle">$<?php //echo $mostrar['price'] 
                                                ?></p>
                    </div>
                    <div class="productName">
                        <p class="nameStyle"><?php //echo $mostrar['name'] 
                                                ?></p>
                    </div>
                </button>
                <button class="productContainer">
                    <div class="productPhoto"><img src="../Product-Images/<?php //echo $mostrar['image'] 
                                                                            ?>" class="productImage"></div>
                    <div class="productPrice">
                        <p class="priceStyle">$<?php //echo $mostrar['price'] 
                                                ?></p>
                    </div>
                    <div class="productName">
                        <p class="nameStyle"><?php //echo $mostrar['name'] 
                                                ?></p>
                    </div>
                </button>
                <button class="productContainer">
                    <div class="productPhoto"><img src="../Product-Images/<?php //echo $mostrar['image'] 
                                                                            ?>" class="productImage"></div>
                    <div class="productPrice">
                        <p class="priceStyle">$<?php //echo $mostrar['price'] 
                                                ?></p>
                    </div>
                    <div class="productName">
                        <p class="nameStyle"><?php //echo $mostrar['name'] 
                                                ?></p>
                    </div>
                </button>
            </section>

        </article>
    </main>
    <footer>
        <p class="logo-f">Ventex</p>
    </footer>
    <script>
        document.addEventListener("DOMContentLoaded", getData);

        function getData() {
            let input = document.getElementById("searchP").value;
            let id_usser = document.getElementById("usser_id").value;
            let content = document.getElementById("container_all_products_seller");
            let url = "../php-servicios/load_data/load-info-Pantalla-Perfil-Selller.php";
            let formData = new FormData();
            formData.append('searchP', input);
            formData.append('usser_id', id_usser);

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
</body>

</html>