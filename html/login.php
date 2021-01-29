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
      $sql = "SELECT * FROM login WHERE username='$user' AND password='$passwd'";
      if($q = $conn->query($sql)){
        if($q->num_rows !== 0){
          session_start();

          $_SESSION["loggedin"] = true;
          $_SESSION["id"] = $id;
          $_SESSION["username"] = $user;

          header("location: welcome.php");
          exit;
        }else{
          echo "ERROR1";
        }
      }else{
        echo "ERROR2";
    }

    mysqli_close($conn);
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
	<h1>Login</h1>
    <form action="login.php" method="post">
    	<input type="text" placeholder="Usuario" name="user" required="required" />
        <input type="password" placeholder="Contraseña" name="passwd" required="required" />
        <button type="submit" class="btn btn-primary btn-block btn-large">Entrar</button>
        <br>
        <a class="sign-up" href="registro.php">Registrate</a>
    </form>
  </div>
</body>
</html>
