<?php
session_start();
include "connect.php";
if (!isset($_SESSION['email']) && !isset($_SESSION['pass']) && !isset($_SESSION['id'])) {
header('Location: ../index.php');
}

$id_usuario = $_SESSION['id'];

$senasa = $_GET['senasa'];

?>
<html>
<head>
  <title>Agregar Comentario</title>
  <meta name="viewport" content="width=device-width, initial-scale=0.7">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

  <link href="../bootstrap/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
  <link href="../bootstrap/css/bootstrap-responsive.min.css" type="text/css" rel="stylesheet" />
  <link href="../Css/vacas.css" type="text/css" rel="stylesheet" />

  <div class="container-narrow">

  <div class="masthead">
    <ul class="nav nav-pills pull-right">
      <li><a href="#">Usuario: <?php echo $nombre . " " . $apellido; ?></a>
      <li><a href="#">About</a></li>
      <li><a href="#">Contact</a></li>
      <li class="active"><a href="Scripts/logOut.php" class="btn-danger">Cerrar sesi&oacute;n</a></li>
    </ul>
    <h3 class="">Ganado Bovino</h3>
  </div>
</div>
<h4 class="muted">Comentario de vaca n&uacute;mero <?php echo $senasa; ?></h4>

<div>
  <ul class="nav nav-tabs">
    <li class="dropdown">
      <a class="dropdown-toggle" data-toggle="dropdown" href="#"><h5>Vacas<b class="caret"></b></h5></a>
      <ul class="dropdown-menu">
        <li><a href="../main.php"><h5>Vivas</h5></a></li>
        <li><a href="muertas.php"><h5>Muertas</h5></a></li>
        <li><a href="vendidas.php"><h5>Vendidas<h5></a></li>
        <li class="divider"></li>
        <li><a href="#"><h5>Perdidas</h5></a></li>
      </ul>
    </li>
    <li><a href="eventos.php"><h5>Eventos</h5></a></li>
    <li><a href="#"><h5>Vender</h5></a></li>
  </ul>
</div>
<div class="container">

<form action="comentariodb.php" id="comentario" method="POST">
	<legend>Comentario<legend>
    <fieldset>
 		<textarea name="comment" form="comentario" rows="4" placeholder="Escriba aqu&iacute;..."></textarea>
 	</br>
    <input type="hidden" name="senasa" value= <?php echo "\"" . $senasa . "\" "; ?> >
    <div class="form-action">
    <button <?php echo "href=\"detail.php?senasa=" . $senasa . " \" "; ?> class="btn btn-warning" value="Edit">Cancelar</button>
    <button type="submit" name="submit" class="btn btn-success" value="Edit">Confirmar</button>
    </div>
  </fieldset>
</form>

</div>
<script type="text/javascript" src="../jquery/jquery-latest.min.js"></script> 
  <script type="text/javascript" src="../jquery/jquery.tablesorter.min.js"></script>
  <script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script> 
  <script type="text/javascript" src="../Js/vacas.js"></script> 

 </body>
</html>