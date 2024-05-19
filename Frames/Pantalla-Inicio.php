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

<?php 
  require_once('../php-servicios/Conexion_db/conexion_usser_select.php');
  $cats = mysqli_query($Conexion_usser_select, "SELECT DISTINCT Nombre_Cat FROM categoria;");
?>
        <section>
            <p class="logo">Ventex</p>
        </section>
        <nav>
            <ul class="menu">
                <li><a href="" class="headerOption">Inicio</a></li>
                <li><a href="#" id="categorias" class="headerOption">Categorías</a>
                    <div class="invisible"></div>
                    <ul class="menuv">
                        <?php while ($cat = mysqli_fetch_array($cats)) { ?>
                            <li class="ca">
                                <a href="Pantalla-Subcategoria?categoria=<?php echo $cat['Nombre_Cat']; ?>" name="" class="linkCategoriesOption">
                                    <div class="categorieSection">
                                        <p class="categorieOption"><?php echo $cat['Nombre_Cat']; ?></p>
                                    </div>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </li>
                <li><a href="" class="headerOption">Planes</a></li>
                <li><a href="" class="headerOption">Vender</a></li>
            </ul>
        </nav>
        <section class="busqueda">
            <form class="busquedaForm" action="../Frames/Pantalla-Busqueda.php" method="post" onsubmit="return enviarFormulario()">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="search" placeholder="Buscar" name="busqueda" class="inputSearchHeader" require>
                <button class="searchButtonHeader">
                    <img src="../Icons/lupaB.png" alt="" class="imageSearchHeader">
                </button>
            </form>
        </section>
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
      <section class="slider" id="resultados">
        <!-- <section class="card">
            <div class="image"><span class="text">dsdas</span></div>
            <span class="title">dadas</span>
            <span class="price">$dsd</span>
          </section>

          <section class="card">
            <div class="image"><span class="text">dsdas</span></div>
            <span class="title">dadas</span>
            <span class="price">$dsd</span>
          </section>

          <section class="card">
            <div class="image"><span class="text">dsdas</span></div>
            <span class="title">dadas</span>
            <span class="price">$dsd</span>
          </section>

          <section class="card">
            <div class="image"><span class="text">dsdas</span></div>
            <span class="title">dadas</span>
            <span class="price">$dsd</span>
          </section>

          <section class="card">
            <div class="image"><span class="text">dsdas</span></div>
            <span class="title">dadas</span>
            <span class="price">$dsd</span>
          </section> -->

        <script>
          document.addEventListener("DOMContentLoaded", getData);

          function getData() {
            //let input = document.getElementById("searchP").value;
            let content = document.getElementById("resultados");
            let url = "../php-servicios/load_data/load-info-pantalla-Inicio.php";
            let formData = new FormData();
            //formData.append('searchP', input);

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
      <div id="contenedor"></div>

    </section>
    </section>
    <script>
      document.addEventListener("DOMContentLoaded", getData);

      function getData() {
        //let input = document.getElementById("searchP").value;
        let content = document.getElementById("contenedor");
        let url = "../php-servicios/load_data/load-info-productos-visitados.php";
        let formData = new FormData();
        //formData.append('searchP', input);

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