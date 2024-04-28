<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventex</title>
    <link rel="stylesheet" href="../Styles/Styles-Add-Prod.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cabin&family=Cabin+Sketch&family=Hammersmith+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cabin&family=Cabin+Sketch&family=Hammersmith+One&family=Hind:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>
    <nav id="nav">
        <h1 id="name">Ventex</h1>
        <button class="buttonP">Incio</button>
        <button class="buttonP">Categoria</button>
        <button class="buttonP">Planes</button>
        <input type="search" name="" id="search">
        <section id="photo"></section>
    </nav>
    <section id="main">
        <section id="side1">
            <h1 id="Descrip-AgregarP">Agregar Producto</h1>
        </section>
        <section id="side2">
            <form action="" method="post">
                <br>
                <div class="inputbox" style="height: 5vh;">
                    <input type="text" name="name" class="inp" placeholder=" " required><br>
                    <span class="text_input">Nombre del producto</span>
                </div>
                <div class="inputbox">
                    <input type="text" name="date" class="inp" placeholder=" " required><br>
                    <span class="text_input">Descripcion</span>
                </div>
                <div id="contaner-selects">
                    <select name="" id="" class="selects">
                        <option value="">Categoria</option>
                    </select>
                    <select name="" id="" class="selects" style="margin-left: 10%;">
                        <option value="">Subcategoria</option>
                    </select>
                </div>
                <div id="up-photo">
                    <label for="archivo" class="custom-file-input">Añadir Imagen
                        <input type="file" name="archivo" id="archivo">
                    </label>
                </div>
                <div id="button-div">
                    <button type="submit" id="button-sumit">Publicar Producto</button>
                </div>
            </form>
        </section>
    </section>
    <footer id="footler-v">
        <h1 id="name-footer">Ventex</h1>
    </footer>
</body>

</html>