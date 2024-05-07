<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../Componentes/header-v.css" />
  <link rel="stylesheet" href="../Styles/Styles-Busqueda.css" />
  <link rel="stylesheet" href="../Componentes/productBox.css" />
  <title>Document</title>
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
          <input type="search" name="search-product" id="search-p" onkeyup="getData()" />
        </form>
      </section>
      <section class="profileContainer">
        <button class="basket">
          <img src="../Icons/bolsa-de-la-compra.png" alt="Image not found" class="basket-icon" />
        </button>
        <button class="profile"></button>
      </section>
    </nav>
  </header>
  <main>
    <article class="left">
      <section class="usersContainer" id="users_Container">
        <!-- <div class="UserstitleContainer">
          <h1 class="titUsers">Usuarios similares</h1>
        </div> -->
      </section>
    </article>
    <article class="rigth">
      <section class="titleContainer">
        <h1 class="tit">
          Resultados similares a <span class="titResult">"Busqueda"</span>
        </h1>
      </section>
      <section class="productsContainer" id="products_Container">

      </section>
    </article>
  </main>

  <script>
    // document.addEventListener("DOMContentLoaded", getData);

    // function getData() {
    //   let input = document.getElementById("search-p").value;
    //   let content = document.getElementById("users_Container");
    //   let url = "../php-servicios/load_data/load-info-pantalla-busqueda-vendedores";
    //   let formData = new FormData();
    //   formData.append('search-p', input);

    //   fetch(url, {
    //       method: "POST",
    //       body: formData
    //     }).then(response => response.text())
    //     .then(data => {
    //       console.log(data);
    //       content.innerHTML = data;
    //     }).catch(err => console.log(err));
    // }

    const usersContainer = document.querySelector(".usersContainer");

    window.addEventListener("scroll", () => {
      if (window.scrollY > 70) {
        usersContainer.classList.add("block");
      } else {
        usersContainer.classList.remove("block");
      }
    });



    document.addEventListener("DOMContentLoaded", getData);

    function getData() {
      fetchData(
        "../php-servicios/load_data/load-info-pantalla-busqueda-productos.php",
        "products_Container"
      );
      fetchData(
        "../php-servicios/load_data/load-info-pantalla-busqueda-vendedores.php",
        "users_Container"
      );
    }

    function fetchData(url, containerId) {
      let input = document.getElementById("search-p").value;
      let content = document.getElementById(containerId);
      let formData = new FormData();
      formData.append("search-p", input);

      fetch(url, {
        method: "POST",
        body: formData,
      })
        .then((response) => {
          if (!response.ok) {
            throw new Error("Network response was not ok");
          }
          return response.text();
        })
        .then((data) => {
          console.log(data);
          content.innerHTML = data;
        })
        .catch((error) => {
          console.error("Error fetching data:", error);
        });
    }
  </script>
</body>

</html>