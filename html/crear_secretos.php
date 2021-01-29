<?php
session_start();

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

// Include config file
require_once "db.php";

$nombre = $sexo = $categoria = $descripcion = "";
$username_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(empty(trim($_POST["nombre"]))){
      $username_err = "Por favor introduce un nombre.";
    } else{
      $nombre = trim($_POST["nombre"]);
    }
    if(empty(trim($_POST["sexo"]))){
      $username_err = "Por favor introduce un sexo.";
    } else{
      $sexo = trim($_POST["sexo"]);
    }
    if(empty(trim($_POST["categoria"]))){
      $username_err = "Por favor introduce una categoria.";
    } else{
      $categoria = trim($_POST["categoria"]);
    }
    if(empty(trim($_POST["descripcion"]))){
      $username_err = "Por favor introduce una descripcion.";
    }else{
      $descripcion = trim($_POST["descripcion"]);
    }

    if(empty($username_err)){
      $sql = "INSERT INTO `formulario` (nombre,sexo,categoria,descripcion) VALUES ('$nombre','$sexo','$categoria','$descripcion')";
              $q = $conn->query($sql);
          mysqli_close($conn);
      }else{
        echo "ERROR";
      }

}
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" href="estilo.css">
    <meta charset="utf-8">
    <title>Crear Secreto</title>
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
    <div id="secret">
  		<h1>Crea tu Secreto</h1>
  		<form action="crear_secretos.php" class="form" method="POST">
        <div class="nom">
          <input type="text" name="nombre" for="nombre" placeholder="Tu nombre" class="nom">
        </div>
        <div class="sexo">
            <select name="sexo" for="sexo" data-validations="required" class="sexo">
              <option value="s" style="font-size: 14px;">Sexo</option>
              <option value="Hombre">Hombre</option>
              <option value="Mujer">Mujer</option>
            </select>
        </div>
        <div class="categoria">
            <select name="categoria" for="categoria" data-validations="required" class="categoria">
              <option value="c">Categoria</option>
              <option value="Amor">Amor</option>
              <option value="Formula 1">Formula 1</option>
              <option value="Andorra">Andorra</option>
            </select>
        </div>
        <div class="desc">
    			<textarea name="descripcion" for="descripcion" cols="66" rows="10" placeholder="Descripción" class="desc"></textarea>
        </div>
        <div>
          <button type="submit" class="button">Enviar</button>
        </div>
          <button type="button" onclick="history.back()" class="back">Volver Atrás</button>
  		</form>
  	</div>
  </body>
</html>
