<?php
require_once('../php-servicios/Conexion_db/conexion_usser_select.php');
$mywher = isset($_GET['id']) ? $_GET['id'] : null;
$categoria = isset($_GET['categoria']) ? $_GET['categoria'] : null;
$subc = mysqli_query($Conexion_usser_select, "SELECT DISTINCT Categoria FROM productos WHERE Id_usser_regristro='$mywher';");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventex</title>
    <link rel="stylesheet" href="./Styles-Product-Box/product-box-1.css" id="style-product-box">
    <link rel="stylesheet" href="./Styles-Frames/Styles-catalogo-1.css" id="style-catalog">
    <link rel="stylesheet" href="../Componentes/editCatalogModal.css">
    <link rel="stylesheet" href="./Queries-responsive/queries-catalogo-1.css" id="style-catalog">
    <script src="catalog-styles-election.js"></script>
</head>

<body>
    <header>
        <nav>
            <article class="headerContainer">
                <div class="logoContainer"></div>
                <input type="search" placeholder="Buscar" class="search" name="searchP" id="searchP" onkeyup="getData()">
            </article>
            <article class="categoriesContainer">
                <form action="../Catalog/catalogo.php" method="get">
                    <input type="hidden" name="id" value="<?php echo $mywher; ?>">
                    <button class="categoryButton" type="submit">All</button>
                </form>

                <?php
                while ($categorias_button = mysqli_fetch_array($subc)) {
                ?>
                    <form action="../Catalog/catalogo.php" method="get">
                        <input type="hidden" name="id" value="<?php echo $mywher; ?>">
                        <input type="hidden" name="categoria" value="<?php echo $categorias_button['Categoria']; ?>">
                        <button class="categoryButton" type="submit"><?php echo $categorias_button['Categoria']; ?></button>
                    </form>
                <?php
                }
                ?>
            </article>
        </nav>
    </header>

    <main id="sectionProductsContainer">
    </main>
    <footer></footer>

    <article class="editCatalogModalContainer hidden"></article>
    <div class="editCatalogOverlay hidden"></div>

    <form action="">
        <input type="hidden" name="id_usser" value="<?php echo $mywher ?>" id="id_usser">
        <input type="hidden" name="categoria" value="<?php echo $categoria ?>" id="categoria">
    </form>

    <script>
        document.addEventListener("DOMContentLoaded", getData);

        function getData() {
            let id_usser = document.getElementById("id_usser").value;
            let categoria = document.getElementById("categoria").value;
            let searchP = document.getElementById("searchP").value;

            let content = document.getElementById("sectionProductsContainer");
            let url = "../php-servicios/load_data/load-info-pantalla-catalogos.php";
            let formData = new FormData();
            formData.append('id_usser', id_usser);
            formData.append('categoria', categoria);
            formData.append('searchP', searchP);

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
</body>
</html>
