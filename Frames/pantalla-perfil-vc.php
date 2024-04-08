<?php 
$usuario = 1;
$prod = mysqli_query($conexion, "SELECT * FROM products WHERE owner_id = $usuario");

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventex</title>
    <link rel="stylesheet" href="../Styles/Styles-perifil-vc.css">
    <link rel="stylesheet" href="../Componentes/header-v.css">
    <link rel="stylesheet" href="../Componentes/productBox.css">
</head>
<body>
    <header class="main-container-header">
        <section class="c-logo"><p class="logo">Ventex</p></section>
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
            <button class="basket"> <img src="../Icons/bolsa-de-la-compra.png" alt=""></button>
            <button class="profile"></button>
        </section>
    </header>
    <main>
<!--Left------------------------------------------------------------------------------------------->
        <article class="left">
            <section class="personalInfo">
                <div class="photoContainer" ></div>
                <div class="nameContainer">
                    <p class="userName">Nombre del Usuario</p>
                </div>
                <div class="descriptionContainer">
                    <p class="text">Aquí va una descripción mamalona proporcionada por el vendedor sobre cualquier cosa que tenga que decír respecto a sus productos
        
                        ATTE: Kim Kardashan nuevamente 👄💋

                    </p>
                </div>
            </section>
            <section class="personalInfo">
                <p class="userName">Información de contacto</p>
                <div class="socialMedia-container">
                    <div class="socialMedia"></div>
                    <div class="socialMedia"></div>
                    <div class="socialMedia"></div>
                </div>
                <p class="text">Aquí va una descripción mamalona sobre el horario de atención del vendedor e información relacionada con contactar a dicho vendedor

                    ATTE: Kim Kardashan nuevamente 👄💋
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
                    <input type="search" name="searchP" id="searchP" placeholder="Buscar" required>
                    <button class="searchButton"><img src="../Icons/lupaB.png" alt=""></button>
                </div>
            </section>
            <?php while($mostrar = mysqli_fetch_array($prod)) { ?>
                <button class="productContainer">
                    <div class="productPhoto"><img src="../Product-Images/<?php echo $mostrar['image'] ?>" class="productImage"></div>
                    <div class="productPrice"><p class="priceStyle">$<?php echo $mostrar['price'] ?></p></div>
                    <div class="productName"><p class="nameStyle"><?php echo $mostrar['name'] ?></p></div>
                </button>
            <?php } ?>
        </article>
    </main>
    <footer><p class="logo-f">Ventex</p></footer>
</body>
</html>