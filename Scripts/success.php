<?php
// Inialize session
session_start();
// Check, if user is already login, then jump to secured page
if (isset($_SESSION['email']) && isset($_SESSION['pass']) && isset($_SESSION['id'])) {
header('Location: ../main.php');
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
<title>Success!</title>
<meta name="viewport" content="width=device-width, initial-scale=0.7">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<link href="../bootstrap/css/bootstrap.css" type="text/css" rel="stylesheet" />
<link href="../Css/success.css" type="text/css" rel="stylesheet" />

</head>

<body>

<div class="container-narrow">

  <div class="masthead">
    <ul class="nav nav-pills pull-right">
      <li class="active"><a href="#">Home</a></li>
      <li><a href="#">About</a></li>
      <li><a href="#">Contact</a></li>
    </ul>
    <h3 class="muted">Vacas</h3>
  </div>

  <hr>

  <div class="jumbotron">
    <h1>Felicitaciones!</h1><h2>Usted se ha registrado correctamente!</h2>
    <h2 class="lead">Inicie sesi&oacute;n para empezar a cargar datos.</h2>
  </div>

  <div class="container-narrow">
      <form class="form-signin" action="checkLogin.php" method="POST">
        <input type="text" class="input-block-level" placeholder="Email" name="email">
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
  <script type="text/javascript" src="../jquery/jquery-latest.js"></script> 
  <script type="text/javascript" src="../Js/vacas.js"></script>
  <script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>

  

</body>
</html>
