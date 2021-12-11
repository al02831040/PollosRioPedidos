<?php
session_start();

$usuario = "root";
$contrasena = "roe3tkm"; 
$servidor = "localhost";
$basededatos = "panaderia";
$conexion = new mysqli($servidor,$usuario,$contrasena,$basededatos);
if ($conexion->connect_error){die("Conexion Fallida:".$conexion->connect_error);}


$sql = sprintf("select * from user where correo='%s' and contrasena = '%s'",$_POST['email'],sha1($_POST['password']));
$query = mysqli_query($conexion, $sql);
$fila = mysqli_fetch_assoc($query);
$encontrados = mysqli_num_rows($query);

if ($encontrados >= 1)
{
$_SESSION['nombre'] = $fila['nombre'];
$_SESSION['correo'] = $fila['correo'];
$_SESSION['contrasena'] = $fila['contrasena'];
$_SESSION['categoria'] = $fila['categoria'];

if ($_SESSION['categoria']=='Admin')
{
header('Location: principal.php');	
}
else if ($_SESSION['categoria']=='Cliente')
{
header('Location: cliente.php');	
}
}

else{
header('Location: index.php');
}

?>