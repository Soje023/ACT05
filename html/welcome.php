<?php

session_start();

$conexion=mysqli_connect('localhost','root','','ciberseguridad');

$sql="SELECT * FROM formulario";
$resultado=mysqli_query($conexion,$sql);

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="estilo.css">
  <meta charset="utf-8">
  <title>Welcome</title>
</head>
<body>
  <nav><ul class="menu">
      <li><a href="welcome.php">Inicio</a></li>
      <li><a href="#">Categorias</a>
        <ul><li><a href="amor.php">Amor</a></li>
        <li><a href="formula1.php">Formula 1</a></li>
        <li><a href="andorra.php">Andorra</a></li></ul>
        </li>
      </li>
      <li><a href="crear_secretos.php">Crear Secretos</a></li>
      <li><a href="logout.php">Cerrar Sesion</a></li>
  </ul></nav>


  <h1 class="mensaje">Hola, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Bienvenido a nuestra pagina web.</h1>
  <?php
  while($fila = mysqli_fetch_array($resultado)) {

  ?>
  <div id="contenedor">
    <p class="mostrar"><b>Nombre:</b></p>
    <p class="dato"><?php echo $fila['nombre']?></p>
    <p class="mostrar"><b>Sexo:</b></p>
    <p class="dato"><?php echo $fila['sexo']?></p>
    <p class="mostrar"><b>Categoria:</b></p>
    <p class="dato"><?php echo $fila['categoria']?></p>
    <p><b>Secreto:</b></p>
    <p class="secret"><?php echo $fila['descripcion']?></p>
    <br>
    <br>
  </div>
  <?php
  }
  ?>
</body>
</html>
