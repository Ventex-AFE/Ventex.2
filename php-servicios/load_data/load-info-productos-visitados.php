<?php
// Archivo: mostrar_productos_visitados.php

// Verificar si existen productos visitados en las cookies
if (isset($_COOKIE['productos_visitados'])) {
    // Decodificar los productos visitados desde las cookies
    $productos_visitados = json_decode($_COOKIE['productos_visitados'], true);

    // Incluir el archivo de conexión a la base de datos
    require_once('../Conexion_db/conexion_usser_select.php');

    // Inicializar un array para almacenar los ID de productos visitados únicos
    $productos_visitados_unicos = array();

    // Iterar sobre cada ID de producto visitado y agregarlo al array de productos visitados únicos
    foreach ($productos_visitados as $id_producto) {
        if (!in_array($id_producto, $productos_visitados_unicos)) {
            $productos_visitados_unicos[] = $id_producto;
        }
    }

    // Iterar sobre cada ID de producto visitado único para obtener la información del producto
    foreach ($productos_visitados_unicos as $id_producto) {
        // Consultar la base de datos para obtener la información del producto
        $consulta = "SELECT * FROM productos WHERE ID_Producto = $id_producto";
        $resultado = $Conexion_usser_select->query($consulta);

        // Verificar si la consulta fue exitosa
        if ($resultado) {
            // Obtener la información del producto
            $producto = $resultado->fetch_assoc();

            // Mostrar la información del producto en el contenedor
?>
            <form action="../Frames/pantalla-producto.php" method="post">
                <input type="hidden" name="id_product" value="<?php echo $producto['ID_Producto']; ?>"> <!-- Campo oculto con el ID del producto -->
                <button class="productContainer" type="submit">
                    <div class="productPhoto">
                        <img src="../Product-Images/<?php echo $producto['Imagen']; ?>" class="productImage" /> <!-- Imagen del producto -->
                    </div>
                    <div class="productPrice">
                        <p class="priceStyle">$<?php echo $producto['Precio']; ?></p> <!-- Precio del producto -->
                    </div>
                    <div class="productName">
                        <p class="nameStyle"><?php echo $producto['Nombre_Prod']; ?></p> <!-- Nombre del producto -->
                    </div>
                </button>
            </form>
<?php
        } else {
            // Mostrar un mensaje de error si la consulta falla
            echo "Error en la consulta: " . $Conexion_usser_select->error;
        }
    }
} else {
    // Mostrar un mensaje si no hay productos visitados en las cookies
    echo "No hay productos visitados.";
}
?>