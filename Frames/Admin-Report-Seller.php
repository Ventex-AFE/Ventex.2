<?php 
session_start();
if (!isset($_SESSION['Admin']) || $_SESSION['Admin'] !== TRUE) {
  // Redirigir al login si no está logueado como Admin

    header('Location:..\Frames\pantalla-Login.html');
    exit(); // Asegúrate de detener el script después de la redirección
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Ventex</title>
  <link rel="stylesheet" href="../Styles/Admin-ViewProduct-porce.css" />
  <link rel="stylesheet" href="../Componentes/extensibleSearchInput.css">
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Hammersmith+One&display=swap" rel="stylesheet" />

  <style>  /* <-------Styles extensible search input*/
        .searchSection{
            text-align: left;
        }
        .containerSearchSection{
            min-width: 20vw;
            height: 8vh;
            display: flex;
            align-items: center;
        }
        .searchButton{  /*<------Color Button*/
            background-color: #61abdc;
        }
        #searchP:valid ~ .searchButton {  /* <------Color of the button when te input is valid*/
            background-color: rgb(66, 94, 66);
        }
    </style>
</head>

<body>
  <article id="bar-navegation">
    <!-- Secccion que se encarga de maquetar informacion de Admin -->
    <section id="info-user">
      <!-- Seccion para la imagen del administrador -->
      <section id="imagen-usAdm">
        <!-- imagen recoleccion con php en la db para obtner la ruta de la imagen -->
        <img src="../Imgens-Pefil/<?php echo $_SESSION['img']?>" id="img-A">

      </section>
      <section id="Name-Adm">
        <!-- Parte para nombre de adm y va hacer pasado con session php -->
        <h2><?php echo $_SESSION['name']?></h2><br>
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
          <a href="Admin-ViewProduct-Porc.php" class="linkOption">Productos - All</a>
        </section>
      </section>
      <section class="Box-navegation">
        <div class="icon-button">
        </div>
        <section class="section-buton">
          <a href="Admin-Commen-Prod.php" class="linkOption">Comentarios - Prod</a>
        </section>
      </section>
      <section class="Box-navegation">
        <div class="icon-button">
        </div>
        <section class="section-buton">
          <a href="Admin-Commen-seller.php" class="linkOption">Comentarios - Seller</a>
        </section>
      </section>
      <section class="Box-navegation">
        <div class="icon-button">
        </div>
        <section class="section-buton">
          <a href="Admin-Report-Product.php" class="linkOption">Reportes - Prod.</a>
        </section>
      </section>
      <section class="Box-navegation">
        <div class="icon-button">
        </div>
        <section class="section-buton">
          <a href="Admin-Report-User.php" class="linkOption">Reportes - User</a>
        </section>
      </section>
      <section class="Box-navegation">
        <div class="icon-button">
        </div>
        <section class="section-buton">
          <a href="Admin-Report-Seller.php" class="linkOption">Reportes - Seller</a>
        </section>
      </section>
    </section> 
    
    <section id="button-logout">
        <img src="" id="icon-logout">
        <a href="../php-servicios/deletion_data/deletion_session_usser.php" class="link-logout">Log out</a>
      <!-- Link al archivo para destruir la session -->
    </section>
  </article>

  <main> <!-- | | | | | | | | | | | | | | | | | | | | | | | | | | | | | | | | | | | | | | --- MAIN --- | | | | | | | | |-->

    <!-- La seccion del header -->
    <section id="section-header">
      <header id="header-name">
        <h1 id="Name-page">Ventex</h1>
      </header>
    </section>
    <!-- seccion para implementacion del input para la busqueda -->
    <section id="section-search">
        <div class="searchContainer">
          <input type="search" name="searchP" id="searchP" onkeyup="getData()" placeholder="Buscar" required>
          <button class="searchButton"><img src="../Icons/lupaB.png" alt="" class="searchIcon"></button>
        </div>
    </section>
    <!-- Seccion de resultado de datos regresara todos los datos encontrados si claro hay informacion en db -->
    <section id="section-data">
      <table class="tabla">
        <thead>
          <th>Id-RS</th>
          <th>Id-Usuario</th>
          <th>Id-Seller-R</th>
          <th>Motivo</th>
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
            let url = "../php-servicios/load_data/load-info-Admin-ReportSeller.php";
            let formData = new FormData();
            formData.append('searchP', input);

            fetch(url, {
              method: "POST",
              body: formData
            }).then(response => response.text())
              .then(data => {
                console.log(data);
                content.innerHTML = data;
                asignarEventos()
              }).catch(err => console.log(err));
          }
          function asignarEventos() {
          const optionsButton = document.querySelectorAll('.checkButton');
                const optionsList = document.querySelectorAll('.pointsOptions');
                const invisibleOverlay = document.querySelector('.invisibleOverlay');


            optionsButton.forEach((but, index) => {
                but.addEventListener('click', () => {
                    optionsList[index].classList.remove('hidden');
                    invisibleOverlay.classList.remove('hidden');
                });
            });
            const closeOptionsList = () =>{
    optionsList.forEach((list) => {
            list.classList.add('hidden');
    });
    invisibleOverlay.classList.add('hidden');
}

optionsButton.forEach((but, index) => {

    console.log('hola');
    but.addEventListener('click', () => {
        console.log('hola');
        optionsList[index].classList.remove('hidden');
        invisibleOverlay.classList.remove('hidden');
    });
});
invisibleOverlay.addEventListener('click', closeOptionsList);
            invisibleOverlay.addEventListener('click', closeOptionsList);

            /*--------------------------------------------------------------------*/
            document.addEventListener("DOMContentLoaded", function() {
                // Obtener los botones de editar y eliminar
                const editButtons = document.querySelectorAll('.editButton');
                const deleteButtons = document.querySelectorAll('.deleteButton');

                // Agregar event listener para el botón de editar
                editButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        // Enviar el formulario correspondiente
                        const form = this.parentNode.querySelector('form');
                        form.submit();
                    });
                });

                // Agregar event listener para el botón de eliminar
                deleteButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        // Enviar el formulario correspondiente
                        const form = this.parentNode.querySelector('form');
                        form.submit();
                    });
                });
            });
          }
       
        </script>
      </table>
    </section>
  </main>
  <div class="invisibleOverlay hidden"></div>


  <script src="../Scripts/Script-Admin-ViewProduct-Porc.js"></script>
  <footer>
    <h2 id="name-footer">Ventex</h2>
  </footer>
</body>

</html>