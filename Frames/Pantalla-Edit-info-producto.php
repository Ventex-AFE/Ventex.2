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
            <h3 id="Descrip-AgregarP2">Información Personal</h3>
        </section>
        <!-- Sección lateral 2 (formulario para actualizar redes sociales) -->
        <section id="side2">
             <section id="imagen-usser-container">
                <img src="../Icons/bolsa-de-la-compra.png" id="imagen-product" >
             </section>
            <form action="../php-servicios/save-actualizacion-datos-personales.php" method="post">
                <input type="hidden" name="id-usser-update" value=""><!-- aqui va ir lo de sesion -->
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
