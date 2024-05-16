<?php

// Función para mostrar los productos vistos recientemente
function mostrarProductosVistosRecientemente($Conexion_usser_select) {
    // Verificar si existe la cookie de productos vistos recientemente
    $productos_vistos = isset($_COOKIE['productos_vistos']) ? json_decode($_COOKIE['productos_vistos'], true) : [];

    // Verificar si hay productos vistos recientemente
    if (!empty($productos_vistos)) {
        echo '<section class="productos-Recomendados">';
        echo '<h1>Vistos recientemente</h1>';
        echo '<section class="slider">';
        foreach ($productos_vistos as $producto_id) {
            // Consultar la información del producto desde la base de datos
            $sql = "SELECT * FROM productos WHERE id = $producto_id";
            $resultado = $Conexion_usser_select->query($sql);
            if ($resultado->num_rows > 0) {
                $row = $resultado->fetch_assoc();
                // Mostrar los productos 
                echo '<section class="card">';
                echo '<div class="image"><img src="' . $row['Imagen'] . '"></div>';
                echo '<span class="title">' . $row['Nombre_Prod'] . '</span>';
                echo '<span class="price">$' . $row['Precio'] . '</span>';
                echo '</section>';
            }
        }
        echo '</section>';
        echo '</section>';
    } else {
        echo '<p styles="text-aling:center;">No hay productos vistos recientemente.</p>';
    }
}
// require('../Conexion_db/conexion_usser_select.php');
$hostname = '127.0.0.1'; //Url de la direccion dela base de datos 
$username = 'Usser_consult';
//$username = 'root'; //Usuario que se uso para esta conexion y la verifcacion 
$password = 'Dw0&Q=]o95F]Wlj5y/TMvt:=UX'; //Password del usuario 
//$password = ''; //Password del usuario 
$database = 'ventexafe'; //nombre de la db

// Conexión a la base de datos
$Conexion_usser_select = mysqli_connect($hostname, $username, $password, $database);

// Verificar la conexión
 if (mysqli_connect_error()) {
     exit('Fallo en la conexión de MySQL: ' . mysqli_connect_error());
 }else{
   // echo'Conexion is look well 😄 4';
}

    $sql = "SELECT * FROM productos ORDER BY RAND() LIMIT 5";
    $resultado = $Conexion_usser_select->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Componentes/header.css">
    <link rel="stylesheet" href="../Componentes/footer.css">
    <link rel="stylesheet" href="../Styles/Styles-Inicio.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Inicio</title>
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

    <main>

      <section class="presentacion">
        <div class="circle1"></div>
        <div class="circle2"></div>
        <div class="ventex"><span>Ventex</span></div>
        <div class="slogan">
          <span>En busca de nuevos emprendedores.</span><br>
          <span>Sé tú el siguiente.</span>
        </div>
      </section>

      <section class="productos-Recomendados">
    <h1>Productos Recomendados</h1>
    <section class="slider">
        <?php
        while ($row = $resultado->fetch_assoc()) {
            ?>
            <section class="card">
                <div class="image"><img src="<?php echo $row['Imagen']; ?>"></div>
                <span class="title"><?php echo $row['Nombre_Prod']; ?></span>
                <span class="price">$<?php echo $row['Precio']; ?></span>
            </section>
            <?php
        }
        ?>
    </section>
</section>

      <section class="ad">
          <div class="e-card playing">
              <div class="image"></div>
              <div class="wave"></div>
                  <div class="infotop">
                  <span>Gran Variedad de Productos</span> 
              </div>
            </div>
      </section>

      <section class="productos-Recomendados">
        <h1>Vistos recientemente</h1>
        <?php mostrarProductosVistosRecientemente($Conexion_usser_select); ?>
        </section>
      </section>

    </main>
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
