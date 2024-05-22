<?php
// Incluir el archivo de conexión
require_once('../php-servicios/Conexion_db/conexion_usser_select.php');

// Comprobar si la sesión está iniciada
session_start();
// if (!isset($_SESSION['id'])) {
//     // Si no hay sesión iniciada, redireccionar o manejar el caso según tus necesidades
//     // Por ejemplo, redireccionar a una página de inicio de sesión
//     

    header('Location:..\Frames\pantalla-Login.html');

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
</head>  exit(); // Asegúrate de detener el script después de la redirección
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
//     exit;
// }

// Obtener el ID de usuario de la sesión
$Id_Usuario = $_SESSION['id'];
 //$Id_Usuario = 9; //extraido desde el perfil con el boton del editar producto

// Preparar la consulta para obtener los datos del usuario
$sql = "SELECT 	Nombre_Us, Correo, Fecha_Nac, telefono, Imagen FROM usuarioregistrado WHERE ID_Usuario = ?";
// Verificar si la preparación de la consulta tuvo éxito

$stmt = mysqli_prepare($Conexion_usser_select, $sql);
if (!$stmt) {
    exit('Error en la preparación de la consulta: ' . mysqli_error($Conexion_usser_select));
}
// Vincular parámetro(s) a la consulta preparada
mysqli_stmt_bind_param($stmt, "i", $Id_Usuario);

// Ejecutar la consulta preparada
mysqli_stmt_execute($stmt);

// Vincular variables a los resultados de la consulta
mysqli_stmt_bind_result($stmt, $Nombre_Us, $Correo, $Fecha_Nac, $telefono, $Imagen);

// Obtener los resultados
mysqli_stmt_fetch($stmt);

// Cerrar la consulta preparada
mysqli_stmt_close($stmt);

?>
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
                <form action="..\php-servicios\save_data\save-actualizacion-datos-personales.php" method="post" enctype="multipart/form-data">
                    <br>
                    <!-- Inputs para actualizar datos de redes sociales -->
                    <div class="inputbox" style="height: 6vh;">
                    <input type="file" name="Imagen" class="inp" accept="image/*"  onchange="previewImage(event, '#imgPreview')">
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
                        <input type="hidden" name="imagenanterior" value="<?php echo $Imagen ?>">

                    <div class="inputbox" style="height: 6vh;">
                        <input type="text" name="nombre" class="inp" placeholder="" value="<?php echo $Nombre_Us ?>" required><br>
                        <span class="text_input">Nombre(s):</span>
                    </div>

                    <div class="inputbox" style="height: 6vh;">
                        <input type="email" name="correo" class="inp" placeholder="" value="<?php echo $Correo ?>" required><br>
                        <span class="text_input">Email</span>
                    </div>

                    <div class="inputbox" style="height: 6vh;">
                        <input type="date" name="fecha" class="inp" placeholder="" value="<?php echo $Fecha_Nac ?>" required><br>
                        <span class="text_input">Fecha Nacimiento</span>
                    </div>

                    <div class="inputbox" style="height: 6vh;">
                        <input type="number" name="telefono" class="inp" placeholder="" value="<?php echo $telefono ?>" required><br>
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
