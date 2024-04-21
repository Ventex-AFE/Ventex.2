<?php
session_start();

//credenciales de acceso a la base datos

$hostname=''; //Url de la direccion dela base de datos 
$username=''; //Usuario que se uso para esta conexion y la verifcacion 
$password=''; //Password del usuario 
$database='ventex';//nombre de la db

// conexion a la base de datos

$Conexion = mysqli_connect($hostname, $username, $password, $database);

if (mysqli_connect_error()) {

    // si se encuentra error en la conexión

    exit('Fallo en la conexión de MySQL:' . mysqli_connect_error());
}

// Se valida si se ha enviado información, con la función isset()

if (!isset($_POST['correo'], $_POST['contra'])) {

    // si no hay datos muestra error y re direccionar

    header('Location: Incios.html');
}

// evitar inyección sql
// pasar los parametros a recolectar 
if ($Result = $Conexion->prepare('SELECT id,pass,nameUser, email, birthdate, phone, img FROM users WHERE email = ?')) {
    // parámetros de enlace de la cadena s

    //s=string i=intenger 
    $Result->bind_param('s', $_POST['correo']);
    $Result->execute();

} else {
    // Si la preparación de la consulta falla, muestra el error
    die('Error en la preparación de la consulta: ' . mysqli_error($Conexion));
}

// acá se valida si lo ingresado coincide con la base de datos

$Result->store_result();
if ($Result->num_rows > 0) {
    $Result->bind_result($id, $hash_password, $name, $email, $birthdate, $phone, $img);
    $Result->fetch();

    // se confirma que la cuenta existe ahora validamos la contraseña

    if (password_verify($_POST['contra'], $hash_password)) {

        // la conexion sería exitosa, se crea la sesión
        
        session_regenerate_id();
        $_SESSION['loggedin'] = TRUE;
        $_SESSION['name'] = $name;
        $_SESSION['birthdate'] = $birthdate;
        $_SESSION['phone'] = $phone;
        $_SESSION['id'] = $id;
        $_SESSION['email']= $email;
        $_SESSION['img']= $img;
        //dederir al incio
        header('Location: perfil.php');
    } else {

        header('<script>Tu contraseña es incorrecta</script>');
        header('Location: Incios.php');
        exit; // Asegurar que el script se detenga después de la redirección
    }
} else {
    // usuario incorrecto
    
    header('Location: Incios.html');
    echo '<script>Tu usuario es incorrecto</script>';
}

//vaciar el stock
$Result->close();
//cierrara base de datos :D
$Conexion->close();
?>
