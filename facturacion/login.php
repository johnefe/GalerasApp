<?php
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit("Sorry, Simple PHP Login does not run on a PHP version smaller than 5.3.7 !");
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    require_once("libraries/password_compatibility_library.php");
}
require_once("config/db.php");
require_once("classes/Login.php");

$login = new Login();

if ($login->isUserLoggedIn() == true) {
   header("location: facturas.php");

} else {
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
   <link rel=icon href='img/iconos/sale.png' sizes="32x32" type="image/png">

    <title>Sys-Galeras | Login</title>


  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link href="css/login.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  </head>

  <body class="text-center">
    <form method="post" accept-charset="utf-8" action="login.php" name="loginform" autocomplete="off" role="form" class="form-signin" >
      
        <?php

        if (isset($login)) {
          if ($login->errors) {
            ?>
            <div class="alert alert-danger alert-dismissible" role="alert" style="font-size: 13px; text-align: center;">
                <strong>Error!</strong><br>
                Nombre de usuario o contraseña incorrectos.
            
            <?php 
            foreach ($login->errors as $error) {
            }
            ?>
            </div>
            <?php
          }
          if ($login->messages) {
            ?>
            <div class="alert alert-secondary alert-dismissible " role="alert" style="font-size: 15px; text-align: center;">
                <strong>Aviso!</strong>
            <?php
            foreach ($login->messages as $message) {
              echo $message;
            }
            ?>
            </div> 
            <?php 
          }
        }
        ?>

      <img class="mb-4" src="img/iconos/sale.png" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">SYS-GALERAS 2018</h1>
      <label for="user_name" class="sr-only">Nombre de usuario</label>
      <input type="text" id="user_name" name="user_name" class="form-control py-2 my-2" placeholder="Nombre de usuario" required autofocus>
      <label for="inputPassword" class="sr-only">Contraseña</label>
      <input type="password" id="user_password" name="user_password" class="form-control py-2 my-2" placeholder="Contraseña" required>
      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Recordarme
        </label>
      </div>
      <button class="btn btn-lg btn-primary btn-block" name="login" id="submit" type="submit">Inicia Sesión</button>
      <p class="mt-5 mb-3 text-muted">&copy; 2018 | Pasto,Nariño</p>
    </form>

    <script src="js/jquery-3.2.1.slim.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
  </body>
</html>
  <?php
}

