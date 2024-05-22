<?php
// Incluir el archivo de conexión
require_once('../php-servicios/Conexion_db/conexion_usser_select.php');

// Comprobar si la sesión está iniciada
session_start();
if (!isset($_SESSION['id'])) {
//     // Si no hay sesión iniciada, redireccionar o manejar el caso según tus necesidades
//     // Por ejemplo, redireccionar a una página de inicio de sesión
//     

    header('Location:..\Frames\pantalla-Login.html');
      exit();
}

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
    <link rel="stylesheet" href="../Componentes/header.css">
    <link rel="stylesheet" href="../Componentes/footer.css">
    <link href="https://fonts.googleapis.com/css2?family=Cabin&family=Cabin+Sketch&family=Hammersmith+One&family=Hind:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
        <!-- ------parte de decoración -->
        <section class="decor">
            <div class="circle1"></div>
            <div class="circle2"></div>
            <div class="circle3"></div>
        </section>
        <!-- Sección lateral 2 (formulario para actualizar redes sociales) -->
        <section class="form">
        <h1 class="form-title">Actualizar Información de Producto</h1>
            <form action="../php-servicios/save_data/save-actualizacion-info-producto.php" method="post" id="form_product">
                <input type="hidden" name="id_Product_update" value="<?php echo $id_product ?>"><!-- aqui va ir lo de sesion -->
                <!-- Inputs para actualizar datos de redes sociales -->
                <div class="inputbox">
                    <label for="Nombre_Prod">Nombre del producto:</label>
                    <input type="text" name="Nombre_Prod" class="inp" value="<?php echo $Nombre_Prod ?>" required><br>
                </div>
                <div class="inputbox">
                    <label for="Description">Descripcion</label>
                    <input type="text" name="Descripcion" class="inp" placeholder=" " value="<?php echo $Descripcion ?>" required><br>
                </div>
                <div class="inputbox" style="height: 6vh;">
                    <label for="Precio">Precio</label>
                    <input type="number" name="Precio" class="inp" placeholder=" " value="<?php echo $Precio ?>" required><br>
                </div><br>
                <div id="input-container">
                    <!-- Selector de categoría -->
                    <select name="product_category" id="product_category" class="select-container" require>
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
                </div>
                <div>
                    <!-- Selector de subcategoría -->
                    <select name="product_subcategory" id="product_subcategory" class="select-container" require>
                        <option value="">Subcategoría</option>
                    </select>
                </div>

                <!-- Botón para enviar el formulario -->
                <div id="button-div">
                    <button type="submit" class="submit" id="button-sumit">Actualizar</button>
                </div>
            </form>
        </section>
    </main>
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

    <!-- Pie de página -->
    <footer>
        <section class="con">
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
        </section>
        <section class="aviso">
            <span>Ventex no pide a través de SMS o de las redes sociales datos bancarios, tarjetas de crédito, clave NIP,
                contraseñas o datos sensibles de cualquier tipo. 
                <br>Si necesitas aclarar cualquier duda, puedes contactar con el Call Center en 800 225 5748.
            </span>
        </section>
    </footer>
</body>

</html>