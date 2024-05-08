<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventex</title>
    <!-- Enlaces a tus hojas de estilo y fuentes -->
    <link rel="stylesheet" href="../Styles/Styles-Edit-Info-Personal.css">
    <link rel="stylesheet" href="../Componentes/header.css">
    <link rel="stylesheet" href="../Componentes/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
    <!-- Barra de navegación -->
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
    <main>
        <section>
            <!-- Sección lateral 1 -->
            <section id="side1">
                <h1 id="Descrip-AgregarP">Actualiza</h1>
                <h3 id="Descrip-AgregarP2">Información Personal</h3>
            </section>
            <!-- Sección lateral 2 (formulario para actualizar redes sociales) -->
            <section id="side2">
                <section id="imagen-usser-container">
                    <img src="../Icons/perfilPic.png" class="imagen-usser" id="imgPreview" >
                </section>
                <form action="..\php-servicios\save_data\save-actualizacion-datos-personales.php" method="post">
                    <input type="hidden" name="id-usser-update" value=""><!-- aqui va ir lo de sesion -->
                    <br>
                    <!-- Inputs para actualizar datos de redes sociales -->
                    <div class="inputbox" style="height: 6vh;">
                    <input type="file" name="" class="inp" accept="image/*" onchange="previewImage(event, '#imgPreview')">
                    <script>
                        function previewImage(event, querySelector){
                        const input = event.target;
                        $imgPreview = document.querySelector(querySelector);

                        if(!input.files.length) return

                        file = input.files[0];

                        objectURL = URL.createObjectURL(file);

                        $imgPreview.src = objectURL;
                        }
                    </script>
                    </div>

                    <div class="inputbox" style="height: 6vh;">
                        <input type="text" name="description" class="inp" placeholder=" " required><br>
                        <span class="text_input">Nombre(s):</span>
                    </div>

                    <div class="inputbox" style="height: 6vh;">
                        <input type="text" name="whatsapp" class="inp" placeholder=" " required><br>
                        <span class="text_input">Email</span>
                    </div>

                    <div class="inputbox" style="height: 6vh;">
                        <input type="text" name="x" class="inp" placeholder=" " required><br>
                        <span class="text_input">Fecha Nacimiento</span>
                    </div>

                    <div class="inputbox" style="height: 6vh;">
                        <input type="text" name="facebook" class="inp" placeholder=" " required><br>
                        <span class="text_input">Telefono</span>
                    </div>
                    <!-- Botón para enviar el formulario -->
                    <div id="button-div">
                        <button type="submit" id="button-sumit">Actualizar</button>
                    </div>
                </form>
            </section>
        </section>
    </main>
    <!-- Pie de página -->
    <footer>
        <section class="name-year"><h1>2023-Ventex</h1></section>
        <section class="logo-ventex"><h1>Ventex</h1></section>
        <section class="socialmedia-ventex">
            <a href=""><i class="fa-brands fa-facebook"></i></a>
            <a href=""><i class="fa-brands fa-square-x-twitter"></i></a>
            <a href=""><i class="fa-brands fa-tiktok"></i></a>
        </section>
    </footer>
</body>
</html>
