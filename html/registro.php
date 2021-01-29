<?php
session_start();

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;
}

// Include config file
require_once "db.php";

$user = $passwd = "";
$username_err = $password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(empty(trim($_POST["user"]))){
      $username_err = "Please enter username.";
    } else{
      $user = trim($_POST["user"]);
    }

    if(empty(trim($_POST["passwd"]))){
      $password_err = "Please enter your password.";
    }else{
      $passwd = trim($_POST["passwd"]);
    }

    if(empty($username_err) && empty($password_err)){
      $sql = "INSERT INTO `login` (username, password) VALUES ('$user','$passwd')";
              $q = $conn->query($sql);
          if($q){
            echo "Te has registrado con exito.";
          }else {
            echo "No has podido registrarte.";
          }
          mysqli_close($conn);
      }else{
        echo "ERROR";
      }

}
?>

<html>
<head>
  <link rel="stylesheet" href="login.css">
  <meta charset="utf-8">
  <title> Basic SQL injection </title>
</head>
<body>
  <div class="login">
  <h1>Registro</h1>
    <form action="registro.php" method="post">
      <input type="text" placeholder="Usuario" name="user" required="required" />
        <input type="password" placeholder="Contraseña" name="passwd" required="required" />
        <button type="submit" class="btn btn-primary btn-block btn-large">Registrarse</button>
        <br>
        <a class="sign-up2" href="login.php">Login</a>
    </form>
  </div>
  </form>
</body>
</html>
