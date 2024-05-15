<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Perfil</title>
    <link rel="stylesheet" href="../Componentes/header.css">
    <link rel="stylesheet" href="../Componentes/footer.css">
    <link rel="stylesheet" href="../Componentes/extensibleSearchInput.css">
    <link rel="stylesheet" href="../Styles/Styls-profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <style>  
    /* <-------Styles extensible search input*/
        .searchSection{
            text-align: left;
        }
        .searchButton{  /*<------Color Button*/
            background-color: black;
        }
        #searchP:valid ~ .searchButton {  /* <------Color of the button when te input is valid*/
            background-color: rgb(66, 94, 66);
        }
    </style>
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
        <section class="parent">
            <section class="parent_Child">
                <section class="parent_FirstChild">
                    <article id="background">
                        <article id="profile_Card_Img"></article>
                    </article>
                    
                </section>

                <section class="parent_LastChild">
                        <article class="info">                              
                            <a href="Pantalla-Edit-Info-Personal.php" class="edit"><i class="fa-solid fa-user-pen"></i></a>
                            <h1>Ateez<!-- <?php echo $_SESSION['name']; ?> --></h1>
                            <h2> ateez@gmail.comdsbhahb<!--<?php echo $_SESSION['email']; ?>--></h2>
                            <section class="details">
                                <section class="data">
                                    <table>
                                        <tr>
                                            <td>Fecha de nacimiento: </td>
                                            <td>20/07/2005<!--<?php echo $_SESSION['birthdate']; ?>--></td>
                                        </tr>
                                        <tr>
                                            <td>Número de teléfono: </td>
                                            <td>3323989259<!--<?php echo $_SESSION['phone']; ?>--></td> 
                                        </tr>
                                    </table>
                                </section>
                            </section>
                
                            <section class="socialMedia">
                                <section class="info-edit">
                                    <h1>Informacion de Contacto</h1>
                                    <a href="Pantalla-Edit-RedesSocial.php"><i class="fa-solid fa-pen"></i></a>
                                </section>
                                
                                <section>
                                    <a href=""><i class="fa-brands fa-facebook"></i></a>
                                    <a href=""><i class="fa-brands fa-square-x-twitter"></i></a>
                                    <a href=""><i class="fa-brands fa-tiktok"></i></a>
                                </section>

                                <a href="" class="subs">Suscribirse</a>
                                <a href="" class="subs">Cerrar Sesión <i class="fa-solid fa-right-from-bracket"></i></a>  

                            </section>


                    </section>

            </section>
 <!--Info del vendedor------------------------------------------------------------------------------------------->           
            <section class="parent_Child">
                <section class="parent_LastChild">
                    <section class="group">
                    <div class="searchContainer">
                        <input type="search" name="searchP" id="searchP" placeholder="Buscar" required>
                        <button class="searchButton"><img src="../Icons/lupaB.png" alt="" class="searchIcon"></button>
                    </div>
                        <section class="cards">
                           
                        <section class="inputSearch">
                            <input type="search" id="searchP" name="searchP" placeholder="Buscar" required> <br>
                            
                        </section>
                        <section class="cards">
                            <script>
                                document.addEventListener("DOMContentLoaded", getData);

                                function getData() {
                                let input = document.getElementById("searchP").value;
                                let content = document.getElementById("resultados");
                                let url = "../php-servicios/load_data/load-info-pantalla-perfil.php";
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
                        </section>
                    <div id="resultados"></div>
                    </section>
                </section>
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