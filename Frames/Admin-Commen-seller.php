<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Ventex</title>
  <link rel="stylesheet" href="../Styles/Admin-ViewProduct-porce.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Hammersmith+One&display=swap" rel="stylesheet" />
</head>

<body>
  <section id="bar-navegation">
    <!-- Secccion que se encarga de maquetar informacion de Admin -->
    <section id="info-user">
      <!-- Seccion para la imagen del administrador -->
      <section id="imagen-usAdm">
        <!-- imagen recoleccion con php en la db para obtner la ruta de la imagen -->
        <img src="" id="img-A">
      </section>
      <section id="Name-Adm">
        <!-- Parte para nombre de adm y va hacer pasado con session php -->
        <h2>Alejandro G</h2>
        <P>CEO - Ventex</P>
      </section>
    </section>
    <section id="button-navegation">
      <!-- Secciones para cajas para los link de direccion -->
      <section class="Box-navegation">
        <!-- Creo seccion para adentro hacer 2 cajas que compartan y depues andentro, icon y el nombre de la pantalla. -->
        <div class="icon-button">
        </div>
        <section class="section-buton">
          <a href="Admin-ViewProduct-Porc.html">Productos - All</a>
        </section>
      </section>
      <section class="Box-navegation">
        <div class="icon-button">
        </div>
        <section class="section-buton">
          <a href="Admin-Commen-Prod.html">Comentarios - Prod</a>
        </section>
      </section>
      <section class="Box-navegation">
        <div class="icon-button">
        </div>
        <section class="section-buton">
          <a href="Admin-Commen-seller.html">Comentarios - Seller</a>
        </section>
      </section>
      <section class="Box-navegation">
        <div class="icon-button">
        </div>
        <section class="section-buton">
          <a href="Admin-Report-Product.html">Reportes - Prod.</a>
        </section>
      </section>
      <section class="Box-navegation">
        <div class="icon-button">
        </div>
        <section class="section-buton">
          <a href="Admin-Report-User.html">Reportes - User</a>
        </section>
      </section>
      <section class="Box-navegation">
        <div class="icon-button">
        </div>
        <section class="section-buton">
          <a href="Admin-Report-Seller.html">Reportes - Seller</a>
        </section>
      </section>
    </section>

    <section id="button-logout">
      <section><img src="" id="icon-logout"><a href="o">Log out</a></section>
      <!-- Link al archivo para destruir la session -->
    </section>
  </section>
  <!-- La seccion del header -->
  <section id="section-header">
    <header id="header-name">
      <h1 id="Name-page">Ventex</h1>
    </header>
  </section>
  <!-- seccion para implementacion del input para la busqueda -->
  <section id="section-serch">
    <section class="searchSection">
      <div class="searchContainer">
        <input type="search" name="searchP" id="searchP" placeholder="Buscar" required>
        <button class="searchButton"><img src="../Icons/lupaB.png" alt=""></button>
      </div>
    </section>
  </section>
  <!-- Seccion de resultado de datos regresara todos los datos encontrados si claro hay informacion en db -->
  <section id="section-data">
    <table class="tabla">
      <thead>
        <th>Id-CS</th>
        <th>Id-Usuario</th>
        <th>Id-seller</th>
        <th>Descripcion</th>
        <th>Fecha</th>
        <th>Hora</th>
        <th>Modificacion</th>
      </thead>
      <!-- contiene la informacion regresada de la db organizada en filas -->
      <TBody id="container-data-table"></TBody>
      <script>
        document.addEventListener("DOMContentLoaded", getData);

        function getData() {
          let input = document.getElementById("searchP").value;
          let content = document.getElementById("container-data-table");
          let url = "load-info-Admin-ComentSeller.php";
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
    </table>
  </section>
  <footer>
    <h2 id="name-footer">Ventex</h2>
  </footer>
</body>

</html>