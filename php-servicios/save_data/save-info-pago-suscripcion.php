<?php
session_start();

require_once('../Conexion_db/conexion_usser_changes.php');

// Verifica y filtra los datos de entrada
//$Id_usuario = $_SESSION['id'];
$Id_usuario = 5;
$nom = mysqli_real_escape_string($Conexion_usser_changes, $_POST['namet']);
$numbertar = mysqli_real_escape_string($Conexion_usser_changes, $_POST['numbertar']);
$fechex = mysqli_real_escape_string($Conexion_usser_changes, $_POST['fechex']);

// Asegúrate de que sea un número entero

// Utiliza un UPDATE con sentencia preparada para intentar actualizar el registro
$sql_update = "INSERT INTO suscripciones_ventex (ID_Usuario, Nombre_Titular, Numero_targeta, Fecha) VALUES (?, ?, ?, ?)";


if ($stmt = mysqli_prepare($Conexion_usser_changes, $sql_update)) {
    mysqli_stmt_bind_param($stmt, "isss", $Id_usuario, $nom, $numbertar, $fechex);
    $resultado = mysqli_stmt_execute($stmt);

    if (!$resultado) {
        echo "Error en la consulta: " . mysqli_error($Conexion_usser_changes);
        echo "Consulta SQL: $sql_update";
        exit();
    } else {
        // Redireccionar si todo está bien y cambiar nombre

        // Hacer la segunda sentencia de actualización (UPDATE) con sentencia preparada
        $sql2 = "UPDATE usuarioregistrado SET Type_usser = ? WHERE ID_Usuario = $Id_usuario";
        $type_usser_new = 3;
        // Verificar la conexión antes de preparar la segunda sentencia
        if ($Conexion_usser_changes) {
            $stmt2 = mysqli_prepare($Conexion_usser_changes, $sql2);

            // Verificar la preparación de la segunda sentencia
            if ($stmt2) {
                mysqli_stmt_bind_param($stmt2, "i", $type_usser_new);
                $envio2 = mysqli_stmt_execute($stmt2);

                // Verificar si hubo errores en la consulta
                if (!$envio2) {
                    // Mostrar un mensaje de error y detalles de MySQL
                    echo '<SCRIPT> alert("Error al actualizar el perfil del vendedor")</SCRIPT>';
                    echo 'Error de MySQL: ' . mysqli_error($Conexion_usser_changes);
                } else {
                    header('Location: ../../Frames/pantalla-Login.html');
                }
            } else {
                // Mostrar un mensaje de error si la preparación falla
                echo 'Error al preparar la segunda sentencia SQL';
            }
        }
    }

    mysqli_stmt_close($stmt);
} else {
    echo "Error al preparar la sentencia de actualización: " . mysqli_error($Conexion_usser_changes);
}

// Cierra la conexión
mysqli_close($Conexion_usser_changes);
