<?php
// checking for minimum PHP version
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit("Sorry, Simple PHP Login does not run on a PHP version smaller than 5.3.7 !");
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    // if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
    // (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
    require_once("libraries/password_compatibility_library.php");
}

// include the configs / constants for the database connection
require_once("config/db.php");

// load the login class
require_once("classes/Login.php");

// create a login object. when this object is created, it will do all login/logout stuff automatically
// so this single line handles the entire login process. in consequence, you can simply ...
$login = new Login();

// ... ask if we are logged in here:
if ($login->isUserLoggedIn() == true) {
    // the user is logged in. you can do whatever you want here.
    // for demonstration purposes, we simply show the "you are logged in" view.
   header("location: facturas.php");

} else {
    // the user is not logged in. you can do whatever you want here.
    // for demonstration purposes, we simply show the "you are not logged in" view.
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Sys-Galeras | Login</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
   <link href="css/login.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  </head>

  <body class="text-center">
    <form method="post" accept-charset="utf-8" action="login.php" name="loginform" autocomplete="off" role="form" class="form-signin" >
      
        <?php
        //show potential errors / feedback (from login object)
        if (isset($login)) {
          if ($login->errors) {
            ?>
            <div class="alert alert-danger alert-dismissible" role="alert" style="font-size: 13px; text-align: center;">
                <strong>Error!</strong><br>
                Nombre de usuario o contraseña incorrectos.
            
            <?php 
            foreach ($login->errors as $error) {
              //echo $error;
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

      <img class="mb-4" src="https://getbootstrap.com/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
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

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  </body>
</html>
  <?php
}

