<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>
    <link rel="stylesheet" href="../header.css">
    <link rel="stylesheet" href="../Styles/Styles-Edit-Profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
        <form>
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" placeholder="Buscar">
        </form>
        <section class="imgProfile"></section>
    </header>
    
    <main>
        <section class="line"></section>
        <section class="line"></section>
        <section class="form">
            <h1 class="form-title">Editar Perfil</h1>
            <form action="./php-servicios/save-actualizacion-datos-personales.php" method="PUT">

                <div class="profileImage">
                    <img src="https://static-00.iconduck.com/assets.00/user-avatar-icon-512x512-vufpcmdn.png" alt="" id="imgPreview">
                </div>

                <div class="input-container">
                <input type="file" name="" accept="image/*" onchange="previewImage(event, '#imgPreview')">
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

                <div class="input-container">
                    <input type="text" name="nombre" required>
                    <span>Nombre</span>
                </div>

                <div class="input-container">
                    <input type="email" name="correo" required>
                    <span>Correo</span>
                </div>

                <div class="input-container">
                    <input type="date" name="fecha" required>
                    <span>Fecha de Nacimiento</span>
                </div>

                <div class="input-container">
                    <input type="tel" name="telefono" required>
                    <span>Teléfono</span>
                </div>
                
                <input class="submit" type="submit">
            </form>
        </section>
    </main>
</body>
</html>