<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['email']) && !isset($_SESSION['pass']) && !isset($_SESSION['id'])) {
header('Location: ../index.php');
}

$UID = mysql_real_escape_string($_GET['senasa']);

$id_usuario = $_SESSION['id'];

//Traigo vacunas por usuario
$obtenerVacunas = mysql_query("SELECT id, vacunas FROM vacunas WHERE idusuario_vacunas = '$id_usuario'") or die (mysql_error());
	
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
</head>
<body>
  <div class="container-narrow">
  	<div class="masthead">
  		<h4 class="muted">Editando Vacunas: Vaca N&#176; <?php echo $UID; ?></h4>
    </div>
  </div>
  <hr>
  </br>
  <div id="formVacunas">
  <form action="editardbvacunas.php" method="POST">
    <h4 class="text-error">Se&ntilde;ale todas las vacunas que tiene el animal el d&iacute;a de la fecha.</h4>
        <label class="checkbox inline">
        <input type="checkbox" name="check[]" value="1">Antiparasitario</input>
        </label>
        <span>&nbsp;&nbsp;</span>
        <label class="checkbox inline">
        <input type="checkbox" name="check[]" value="2">Brucelosis</input>
        </label>
        <span>&nbsp;&nbsp;</span>
        <label class="checkbox inline">
        <input type="checkbox" name="check[]" value="3">Aftosa</input>
        </label>

        <?php

          $flag = 0;
          while($listadoVacunas = mysql_fetch_array($obtenerVacunas)){
            $flag = $flag + 1;
            echo "<label class=\"checkbox inline\" > ";
            echo "<input type=\"checkbox\" name=\"check[]\" value =\" ". $listadoVacunas['id'] . "\" >". $listadoVacunas['vacunas'] . "</input>";
            echo "</label>";
            if($flag % 3 == 0){
              echo "</br>";
            }
          }
          ?>
        </br>
        </br>
        <div class="form-action">
          <input type="hidden" name="senasa" value="<? echo $UID; ?>">
          <a <?php echo "href=\"detail.php?senasa=" . $UID . " \" " ?> class="btn btn-primary">Volver</a>
          <button type="submit" name="submit" class="btn btn-success" value="Edit">Confirmar</button>
        </div>
      </form>
</div>
</body>
</html>




