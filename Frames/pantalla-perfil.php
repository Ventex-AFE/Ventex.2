<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Perfil</title>
    <link rel="stylesheet" href="../header.css">
    <link rel="stylesheet" href="../footer.css">
    <link rel="stylesheet" href="../Styles/Styls-profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
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
                            <a href="pantalla_EditProfile.php" class="edit"><i class="fa-solid fa-user-pen"></i></a>
                            <h1>Manu</h1>
                            <h2>manu@manu.com</h2>
                            <section class="cel" style="width: 80%; height: 100px;  display: flex; align-items: center; justify-content: space-between;">
                                <section class="data">
                                    <table>
                                        <tr>
                                            <td>Fecha de nacimiento: </td>
                                            <td>24/06/2000</td>
                                        </tr>
                                        <tr>
                                            <td>Número de teléfono: </td>
                                            <td>3322557745</td>
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
                            </section>


                    </section>

            </section>
 <!--Info del vendedor------------------------------------------------------------------------------------------->           
            <section class="parent_Child">
                <section class="parent_LastChild">
                    <section class="group">
                        <section class="inputSearch">
                            <input type="search" id="searchP" name="searchP" placeholder="Buscar" required> <br>
                        </section>
                            <!--<script>
                                document.addEventListener("DOMContentLoaded", getData);

                                function getData() {
                                let input = document.getElementById("searchP").value;
                                let content = document.getElementById("resultados");
                                let url = "../php-servicios/load-info-pantalla-perfil.php";
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
                            </script>-->
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