<?php
session_start();

// credenciales de acceso a la base datos
$hostname=''; //Url de la direccion dela base de datos 
$username=''; //Usuario que se uso para esta conexion y la verifcacion 
$password=''; //Password del usuario 
$database='ventex';//nombre de la db

// conexión a la base de datos
$Conexion = mysqli_connect($hostname, $username, $password, $database);

if (mysqli_connect_error()) {
    // si se encuentra error en la conexión
    exit('Fallo en la conexión de MySQL:' . mysqli_connect_error());
}

// Se valida si se ha enviado información, con la función isset()
if (!$_POST) {
    // si no hay datos muestra error y re direccionar
    //header('Location: Login_que_jale.html');
    echo'pato';
}

// Obtener el ID del usuario usando el nombre de usuario
if ($Result = $Conexion->prepare('SELECT id,pass FROM users WHERE correo = ?')) {
    // parámetros de enlace de la cadena s
    $Result->bind_param('s', $_POST['correo']);
    $Result->execute();
    $Result->bind_result($id, $Pato); // vincula las variables $id y $Pato a los resultados de la consulta
    $Result->fetch(); // obtiene una fila de resultados
    $Result->close();
} else {
    header('Location: Incios.html');
}

// Cambiar la contraseña del usuario 
$new_hash = password_hash($_POST['correonew'], PASSWORD_DEFAULT, ['cost' => 15]);
//if ($Update = $Conexion->prepare('UPDATE accounts SET Pato = ? WHERE id = ?')) {
    $Update = $Conexion->prepare('UPDATE users SET pass = ? WHERE id = ?');
    $Update->bind_param('si', $new_hash, $id);
    $Update->execute();
    
    $Update->close();
    echo'pato2.0';
    // redirigir al usuario a la página de éxito
    header('Location: Incios.html');
//} else {
    // error al actualizar la contraseña
    //header('Location: Forget_password.php');
//}
//aaaaa waaa

$Conexion->close();
?>
