<?php
session_start();
require_once('../Conexion_db/conexion_usser_changes.php');

// Verifica y filtra los datos de entrada
$Id_usuario = $_SESSION['id'];
$nom = mysqli_real_escape_string($Conexion_usser_changes, $_POST['namet']);
$numbertar = mysqli_real_escape_string($Conexion_usser_changes, $_POST['numbertar']);
$fechex = mysqli_real_escape_string($Conexion_usser_changes, $_POST['fechex']);

// Preparar la consulta para insertar en la tabla suscripciones_ventex
$sql_insert = "INSERT INTO suscripciones_ventex (ID_Usuario, Nombre_Titular, Numero_targeta, Fecha) VALUES (?, ?, ?, ?)";

if ($stmt = mysqli_prepare($Conexion_usser_changes, $sql_insert)) {
    mysqli_stmt_bind_param($stmt, "isss", $Id_usuario, $nom, $numbertar, $fechex);
    $resultado = mysqli_stmt_execute($stmt);

    if (!$resultado) {
        echo "Error en la consulta: " . mysqli_stmt_error($stmt);
        exit();
    } else {
        // Si la inserción es exitosa, proceder con la actualización
        $sql_update = "UPDATE usuarioregistrado SET Type_usser = ? WHERE ID_Usuario = ?";
        $type_usser_new = 3;

        if ($stmt2 = mysqli_prepare($Conexion_usser_changes, $sql_update)) {
            mysqli_stmt_bind_param($stmt2, "ii", $type_usser_new, $Id_usuario);
            $envio2 = mysqli_stmt_execute($stmt2);

            if (!$envio2) {
                echo '<SCRIPT> alert("Error al actualizar el perfil del vendedor")</SCRIPT>';
                echo 'Error de MySQL: ' . mysqli_stmt_error($stmt2);
            } else {
                // Si la actualización es exitosa, proceder con la inserción en catalogo_seller
                $box_color = 'Campo vacio';
                $header_color = 'Campo vacio';
                $Category_color = 'Campo vacio';
                $Produc_type = '0';
                $Catalogo_style = '0';

                $sql_insert_catalogo = "INSERT INTO catalogo_seller (Id_vendedor, stylePage, Product_View_Style, Header_Color, Category_Color, Product_Box_Color) 
                                        VALUES (?, ?, ?, ?, ?, ?)";
                if ($stmt3 = mysqli_prepare($Conexion_usser_changes, $sql_insert_catalogo)) {
                    mysqli_stmt_bind_param($stmt3, "isssss", $Id_usuario, $Catalogo_style, $Produc_type, $header_color, $Category_color, $box_color);
                    $guardar = mysqli_stmt_execute($stmt3);

                    if (!$guardar) {
                        echo 'Error al insertar en catalogo_seller: ' . mysqli_stmt_error($stmt3);
                    } else {
                        header('Location: ../../Frames/pantalla-Login.html');
                    }

                    mysqli_stmt_close($stmt3);
                } else {
                    echo 'Error al preparar la sentencia SQL para catalogo_seller: ' . mysqli_error($Conexion_usser_changes);
                }
            }

            mysqli_stmt_close($stmt2);
        } else {
            echo 'Error al preparar la sentencia de actualización: ' . mysqli_error($Conexion_usser_changes);
        }
    }

    mysqli_stmt_close($stmt);
} else {
    echo "Error al preparar la sentencia de inserción: " . mysqli_error($Conexion_usser_changes);
}

// Cierra la conexión
mysqli_close($Conexion_usser_changes);
?>
