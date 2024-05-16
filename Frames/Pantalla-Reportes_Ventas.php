<?php
require_once('../php-servicios/Conexion_db/conexion_usser_select.php');
session_start();
 $id_usser = $_SESSION['id'];
//$id_usser = 5;
$sql = "SELECT ID_Producto, Nombre_Prod FROM productos WHERE Id_usser_regristro = $id_usser";

$result = $Conexion_usser_select->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventex</title>
    <link rel="stylesheet" href="../Styles/Styles-pedidos.css">
    <link rel="stylesheet" href="../Componentes/header-v.css">
    <link rel="stylesheet" href="../Componentes/extensibleSearchInput.css">
    <link rel="stylesheet" href="../Componentes/modalForm.css">
    <link rel="stylesheet" href="../Componentes/calculationModal.css">

    <style>
        /* <-------Styles extensible search input*/
        .searchSection {
            text-align: left;
        }

        .containerSearchSection {
            min-width: 20vw;
            height: 8vh;
            display: flex;
            align-items: center;
        }

        .searchButton {
            /* <------Color Button*/
            background-color: rgb(174, 186, 175);
        }

        #searchP:valid~.searchButton {
            /* <------Color of the button when te input is valid*/
            background-color: rgb(148, 156, 148);
        }

        #total_input {
            align-items: start;
            margin-right: 15vw;
        }
    </style>

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
                    <input type="search" name="search-product" id="search-p">
                </form>
            </section>
            <section class="profileContainer">
                <button class="basket"> <img src="../Icons/bolsa-de-la-compra.png" alt="Image not found" class="basket-icon"></button>
                <button class="profile"></button>
            </section>
        </nav>
    </header>
    <main>
        <article class="container">
            <section class="table-header">
                <div colspan="3" class="searchSection">
                    <div class="containerSearchSection">
                        <div class="searchContainer">
                            <input type="search" name="searchP" id="searchP" placeholder="Buscar" onkeyup="getData()" required>
                            <button class="searchButton"><img src="../Icons/lupaB.png" alt="" class="searchIcon"></button>
                        </div>
                    </div>
                </div>
                <div class="table-name-container">
                    <h1 class="table-name">Reportes de venta</h1>
                </div>
                <div class="table-options">
                    <button class="btn calc" onclick="calcular2()">Calcular</button>
                    <button class="btn addOrder">Agregar Reporte</button>
                </div>
            </section>
            <table class="tableContainer">
                <tr class="table-header-data">

                    <th class="header-data">Terminar</th>
                    <th class="header-data">ID_Venta</th>
                    <th class="header-data">Nombre Producto</th>
                    <th class="header-data">ID-producto</th>
                    <th class="header-data">Usuario-Cliente</th>
                    <th class="header-data">Fecha</th>
                    <th class="header-data">Hora</th>
                    <th class="header-data">Total</th>
                    <th class="header-data">Descripción</th>
                </tr>
                <tbody id="container_data_reportes">


                </tbody>
            </table>
        </article>
        <div class="calculateModal hidden">
                <h1 class="titleCalculate">Recopilación de ganancias</h1>
                
                <h2 class="resultCalculation" id="parrafoSalida"></h2>
        </div>

        <div class="overlay hidden"></div>
        <div class="invisibleOverlay hidden"></div>

        <!-- Form Modal -------------------------------------------------------------------------------------------------->

        <article class="modalFormMainContainer hidden">
            <section class="titleFormContainer">
                <h1 class="titleForm">Agregar Reporte</h1>
            </section>
            <section class="contentFormInputs">
                <form action="../php-servicios/save_data/save_new_reporte_venta.php" method="post" class="formInputs">
                    <div class="inputContainer">
                        <input type="text" name="nombre_product" class="input" required>
                        <label for="nombre" class="inputText">
                            <pre> Nombre del Producto</pre>
                        </label>
                    </div>
                    <div class="inputContainer">
                        <select name="Id_producto" class="input" required>
                            <option value="" class="inputText">Escoje el producto</option>
                            <?php
                            // Itera sobre los resultados de la consulta y genera opciones para cada producto
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo '<option value="' . $row["ID_Producto"] . '">' . $row["Nombre_Prod"] . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="inputContainer">
                        <input type="text" name="Nombre_Cliente" class="input" required>
                        <label for="correo" class="inputText">
                            <pre> Nombre Cliente </pre>
                        </label>
                    </div>
                    <div class="inputContainerSmall">
                        <input type="time" name="time" class="input" required>
                        <label for="time" class="inputText">
                            <pre> Hora   </pre>
                        </label>
                    </div>
                    <div class="inputContainerSmall">
                        <input type="date" name="fechaEntrega" class="input" required>
                        <label for="fechaEntrega" class="inputText">
                            <pre> Fecha Entrega </pre>
                        </label>
                    </div>
                    <div class="inputContainer" style="width: 10vw;" id="total_input">
                        <input type="number" name="Total" class="input" required>
                        <label for="Total" class="inputText">
                            <pre> Total </pre>
                        </label>
                    </div>
                    <div class="inputContainer">
                        <input type="text" name="descripcion_report" class="input" required>
                        <label for="descripcion_report" class="inputText">
                            <pre> Descripción del pedido </pre>
                        </label>
                    </div>
                    <input type="submit" value="Agregar Pedido" class="but">
                    <button class="cancel"> Cancelar </button>
                </form>
            </section>
            </section>
        </article>

        <div class="formOverlay hidden"></div>

        <!---------------------------------------------------------------------------------------------------------------->
    </main>
    <footer></footer>
    <script>
        document.addEventListener("DOMContentLoaded", getData);

        function getData() {
            let input = document.getElementById("searchP").value;
            let content = document.getElementById("container_data_reportes");
            let url = "../php-servicios/load_data/load-info-pantalla-reportes.php";
            let formData = new FormData();
            formData.append('searchP', input);

            fetch(url, {
                    method: "POST",
                    body: formData
                }).then(response => response.text())
                .then(data => {
                    //console.log(data);
                    content.innerHTML = data;
                    asignarEventos();
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
            invisibleOverlay.addEventListener('click', closeOptionsList);
        }
    </script>
    <!--------------------------------------------------------------------------------->
    <script src="../Scripts/Scripts_reportes_ventas.js"></script>
    <!--------------------------------------------------------------------------------->

    <div class="calculateModal hidden">
        <h1 class="titleCalculate">Recopilación de ganancias</h1>

        <h2 class="resultCalculation">$00.00</h2>
    </div>

    <div class="overlay hidden"></div>

</body>

</html>