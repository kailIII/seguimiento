<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['email']) && !isset($_SESSION['pass']) && !isset($_SESSION['id'])) {
header('Location: ../index.php');
}

$UID = mysql_real_escape_string($_GET['senasa']);

$id_usuario = $_SESSION['id'];

	
?>

<head>
  <title>Editar Vacunas</title>

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

<hr>

</head>
<body>
  <div class="container-narrow">
  	<div class="masthead">
  		<h4 class="muted">Editando Vacunas: Vaca N&#176; <?php echo $UID; ?></h4>
    </div>
  </div>