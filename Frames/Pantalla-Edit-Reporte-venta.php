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
$id_reporte = $_POST['Id_Reporte_Venta']; //extraido desde el perfil con el boton del editar producto
//$id_product = 5;
// Preparar la consulta para obtener los datos del usuario
$sql = "SELECT ID_Venta, Usuario_Venta, fecha, hora, total, Descripcio FROM regristroventa WHERE ID_Venta = ?";
// Verificar si la preparación de la consulta tuvo éxito

$stmt = mysqli_prepare($Conexion_usser_select, $sql);
if (!$stmt) {
    exit('Error en la preparación de la consulta: ' . mysqli_error($Conexion_usser_select));
}
// Vincular parámetro(s) a la consulta preparada
mysqli_stmt_bind_param($stmt, "i", $id_reporte);

// Ejecutar la consulta preparada
mysqli_stmt_execute($stmt);

// Vincular variables a los resultados de la consulta
mysqli_stmt_bind_result($stmt, $Id_venta, $Usuario_Venta, $fecha, $hora, $total, $Descripcio);

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
    <link rel="stylesheet" href="../Styles/Styles-Edit-Product.css">
    <link href="https://fonts.googleapis.com/css2?family=Cabin&family=Cabin+Sketch&family=Hammersmith+One&family=Hind:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <!-- Barra de navegación -->
    <nav id="nav">
        <h1 id="name">Ventex</h1>
        <!-- Botones de navegación -->
        <button class="buttonP">Inicio</button>
        <button class="buttonP">Categoría</button>
        <button class="buttonP">Planes</button>
        <!-- Barra de búsqueda -->
        <input type="search" name="search" id="search">
        <!-- Sección para fotos de perfil  -->
        <section id="photo"></section>
    </nav>
    <!-- Contenido principal -->
    <section id="main">

        <!-- Sección lateral 1 -->
        <section id="side1">
            <h1 id="Descrip-AgregarP">Actualiza</h1>
            <h3 id="Descrip-AgregarP2">Información reporte </h3>
        </section>
        <!-- Sección lateral 2 (formulario para actualizar redes sociales) -->
        <section id="side2">
            <form action="../php-servicios/save_data/save_actulizacion_de_reportes_ventas.php" method="post" id="form_product">
                <input type="hidden" name="id_Reporte_update" value="<?php echo $Id_venta ?>"><!-- aqui va ir lo de sesion -->
                <br>
                <!-- Inputs para actualizar datos de redes sociales -->
                <div class="inputbox" style="height: 6vh;">
                    <input type="text" name="Nombre_Cliente" class="inp" placeholder=" " value="<?php echo $Usuario_Venta ?>" required><br>
                    <span class="text_input">Nombre del cliente:</span>
                </div>
                <div class="inputbox" style="height: 6vh;">
                    <input type="text" name="Descripcion" class="inp" placeholder=" " value="<?php echo $Descripcio ?>" required><br>
                    <span class="text_input">Descripcion:</span>
                </div>
                <div class="inputbox" style="height: 6vh;">
                    <input type="date" name="Fecha" class="inp" placeholder=" " value="<?php echo $fecha ?>" required><br>
                    <span class="text_input">Fecha</span>
                </div>
                <div class="inputbox" style="height: 6vh;">
                    <input type="time" name="Hora" class="inp" placeholder=" " value="<?php echo $hora ?>" required><br>
                    <span class="text_input">Hora</span>
                </div>
                <div class="inputbox" style="height: 6vh;">
                    <input type="number" name="Total" class="inp" placeholder=" " value="<?php echo $total ?>" required><br>
                    <span class="text_input">Total:</span>
                </div>

                <!-- Botón para enviar el formulario -->
                <div id="button-div">
                    <button type="submit" id="button-sumit">Actualizar</button>
                </div>
            </form>
        </section>
    </section>
    <!-- Pie de página -->
    <footer id="footler-v">
        <h1 id="name-footer">Ventex</h1>
    </footer>
    <script>
        
    </script>
</body>

</html>