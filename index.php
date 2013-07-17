<?php
// Inialize session
session_start();
include 'Scripts/connect.php';
// Check, if user is already login, then jump to secured page
if (isset($_SESSION['email']) && isset($_SESSION['pass']) && isset($_SESSION['id'])) {
header('Location: main.php');
}
if(mysql_real_escape_string($_GET['msg'])){
  $msg = $_GET['msg'];
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Iniciar Sesi&oacute;n</title>
<meta name="viewport" content="width=device-width, initial-scale=0.7">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<link href="bootstrap/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
<link href="bootstrap/css/bootstrap-responsive.min.css" type="text/css" rel="stylesheet" />
<link href="Css/success.css" type="text/css" rel="stylesheet" />

</head>

<body>

<div class="container-narrow">

  <div class="masthead">
    <ul class="nav nav-pills pull-right">
      <li class="active"><a href="Scripts/signup.php">Reg&iacute;strese</a></li>
      <li><a href="#">About</a></li>
      <li><a href="#">Contact</a></li>
    </ul>
    <h3 class="muted">Ganado Bovino</h3>
  </div>

  <hr>

  <div class="jumbotron">
    <h1>Bienvenido!</h1>
    <h2 class="lead">Inicie sesi&oacute;n para acceder a su informaci&oacute;n.</h2>
  </div>

  <div class="container-narrow">
      <form class="form-signin" action="Scripts/checkLogin.php" method="POST">
        <input type="email" class="input-block-level" placeholder="Email" name="email">
        <input type="password" class="input-block-level" placeholder="Password" name="pass">
        <?php if(isset($msg)) echo "<span class=\"label label-important\">" .$msg . "</span></br></br>"; ?>
        <button class="btn btn-large btn-success" type="submit">Iniciar Sesi&oacute;n</button>
      </form>
      

    </div>
  <hr>

</div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  <script type="text/javascript" src="jquery/jquery-latest.js"></script> 
  <script type="text/javascript" src="Js/vacas.js"></script>
  <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

  

</body>
</html>