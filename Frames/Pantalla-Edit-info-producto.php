<?php
// Incluir el archivo de conexión
require_once('../php-servicios/Conexion_db/conexion_usser_select.php');

// Comprobar si la sesión está iniciada
session_start();
// if (!isset($_SESSION['id'])) {
//     // Si no hay sesión iniciada, redireccionar o manejar el caso según tus necesidades
//     // Por ejemplo, redireccionar a una página de inicio de sesión
//     
    header('Location: ..\..\Frames\pantalla-Login.html');
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
//     exit;
// }

// Obtener el ID de usuario de la sesión
 $id_product = $_POST['id_product']; //extraido desde el perfil con el boton del editar producto
//$id_product = 5;
// Preparar la consulta para obtener los datos del usuario
$sql = "SELECT Nombre_Prod, Descripcion, Precio, Categoria, Subcategoria FROM productos WHERE ID_Producto = ?";
// Verificar si la preparación de la consulta tuvo éxito

$stmt = mysqli_prepare($Conexion_usser_select, $sql);
if (!$stmt) {
    exit('Error en la preparación de la consulta: ' . mysqli_error($Conexion_usser_select));
}
// Vincular parámetro(s) a la consulta preparada
mysqli_stmt_bind_param($stmt, "i", $id_product);

// Ejecutar la consulta preparada
mysqli_stmt_execute($stmt);

// Vincular variables a los resultados de la consulta
mysqli_stmt_bind_result($stmt, $Nombre_Prod, $Descripcion, $Precio, $Categoria, $Subcategoria);

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
            <h3 id="Descrip-AgregarP2">Información producto</h3>
        </section>
        <!-- Sección lateral 2 (formulario para actualizar redes sociales) -->
        <section id="side2">
            <section id="imagen-usser-container">
                <img src="../Icons/bolsa-de-la-compra.png" id="imagen-product">
            </section>
            <form action="../php-servicios/save_data/save-actualizacion-info-producto.php" method="post" id="form_product">
                <input type="hidden" name="id_Product_update" value="<?php echo $id_product ?>"><!-- aqui va ir lo de sesion -->
                <br>
                <!-- Inputs para actualizar datos de redes sociales -->
                <div class="inputbox" style="height: 6vh;">
                    <input type="text" name="Nombre_Prod" class="inp" placeholder=" " value="<?php echo $Nombre_Prod ?>" required><br>
                    <span class="text_input">Nombre del producto:</span>
                </div>
                <div class="inputbox" style="height: 6vh;">
                    <input type="text" name="Descripcion" class="inp" placeholder=" " value="<?php echo $Descripcion ?>" required><br>
                    <span class="text_input">Descripcion</span>
                </div>
                <div class="inputbox" style="height: 6vh;">
                    <input type="number" name="Precio" class="inp" placeholder=" " value="<?php echo $Precio ?>" required><br>
                    <span class="text_input">Precio:</span>
                </div>
                <div id="contaner-selects">
                    <!-- Selector de categoría -->
                    <select name="product_category" id="product_category" class="selects" require>
                        <option value="">Categoría</option>
                        <?php
                        // Consulta SQL para obtener todas las categorías
                        $sql_categorias = "SELECT DISTINCT Nombre_Cat FROM categoria";
                        $result_categorias = mysqli_query($Conexion_usser_select, $sql_categorias);

                        // Verificar si se obtuvieron resultados
                        if ($result_categorias && mysqli_num_rows($result_categorias) > 0) {
                            // Recorrer los resultados y mostrar cada categoría como una opción en el selector
                            while ($row = mysqli_fetch_assoc($result_categorias)) {
                                echo '<option value="' . $row['Nombre_Cat'] . '">' . $row['Nombre_Cat'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                    <!-- Selector de subcategoría -->
                    <select name="product_subcategory" id="product_subcategory" require class="selects" style="margin-left: 10%;">
                        <option value="">Subcategoría</option>
                    </select>
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
        $(document).ready(function() {
            // Manejar el cambio en el primer selector de categoría
            $('#product_category').change(function() {
                // Realizar una solicitud AJAX para obtener las subcategorías de la categoría seleccionada
                $.ajax({
                    url: '../php-servicios/load_data/load-subcategoria-pantallas-Edit-Add-Producto.php',
                    type: 'POST',
                    dataType: 'json',
                    data: $('#form_product').serialize(), // Serializar los datos del formulario
                    success: function(response) {
                        // Limpiar el selector de subcategorías
                        $('#product_subcategory').empty();
                        console.log('#product_subcategory')
                        // Agregar una opción por defecto
                        $('#product_subcategory').append($('<option>', {
                            value: '',
                            text: 'Subcategoría'
                        }));

                        // Agregar las subcategorías obtenidas al selector
                        $.each(response, function(index, subcategoria) {
                            $('#product_subcategory').append($('<option>', {
                                value: subcategoria,
                                text: subcategoria
                            }));
                        });
                    }
                });
            });
        });
    </script>
</body>

</html>