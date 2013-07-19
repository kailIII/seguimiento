<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['email']) && !isset($_SESSION['pass']) && !isset($_SESSION['id'])) {
header('Location: ../index.php');
}

$UID = mysql_real_escape_string($_GET['senasa']);

$id_usuario = $_SESSION['id'];


$q = "SELECT hembras.id_hembra, hembras.senasa_hembra, hembras.nacimiento_hembra, hembras.sanidad_hembra, hembras.estado_hembra, tacto.tacto, paricion.paricion FROM hembras 
             INNER JOIN tacto ON tacto.id = hembras.tacto INNER JOIN paricion ON paricion.id = hembras.paricion WHERE `existencia_hembra` = '1' AND `senasa_hembra` = '$UID' AND `idusuario_hembra` = '$id_usuario' ";

$result = mysql_query($q) or die (mysql_error());
$row = mysql_fetch_array($result);

$senasa = $row['senasa_hembra'];
$nacimiento = $row['nacimiento_hembra'];
$tacto = $row['tacto'];
$paricion = $row['paricion'];
$vacunas = $row['sanidad_hembra'];
$estado = $row['estado_hembra'];


//Traigo vacunas por usuario
$obtenerVacunas = mysql_query("SELECT id, vacunas FROM vacunas WHERE idusuario_vacunas = '$id_usuario'") or die (mysql_error());
	
?>

<head>
  <title>Editar Vaca</title>

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
  		<h4 class="muted">Editando Vaca N&#176; <?php echo $UID; ?></h4>
    </div>
  </div>
  <hr>
  </br>



<div class="container">
  <form class="form-inline" action="editDb.php" method="POST">
    <legend>Editar</legend>
    <fieldset>
      <label>Caravana:
      <input type="text" name="senasa" value="<?php echo $senasa; ?>" readonly>
      </label>

      <span>&nbsp;&nbsp;</span>

      <label>Fecha de Nac.:
      <input type="text" name="nacimiento" placeholder="Fecha Nac." value="<?php echo $nacimiento; ?>" >
      </label>

      </br>
      </br>
      <label>Tacto:
      <select name="tacto" >
        <option <?php if ($tacto == "Si" ) echo 'SELECTED'; ?> value="1">Si</option>
        <option <?php if ($tacto == "Llena" ) echo 'SELECTED'; ?> value="2">Llena</option>
        <option <?php if ($tacto == "Vacia" ) echo 'SELECTED'; ?> value="3">Vacia</option>
        <option <?php if ($tacto == "No" ) echo 'SELECTED'; ?> value="4">No</option>
      </select>
      </label>

      <span>&nbsp;&nbsp;</span>
      <label>Paricion:
      <select name="paricion">
        <option <?php if ($paricion == "Macho" ) echo 'SELECTED'; ?> value="1">Macho</option>
        <option <?php if ($paricion == "Hembra" ) echo 'SELECTED'; ?> value="2">Hembra</option>
        <option <?php if ($paricion == "Mal pario" ) echo 'SELECTED'; ?> value="3">Malpario</option>
        <option <?php if ($paricion == "No" ) echo 'SELECTED'; ?> value="4">No</option>
        <option <?php if ($paricion == "No sabe" ) echo 'SELECTED'; ?> value="5">No sabe</option>
      </select>
      </label>

      </br>
      </br>
      <label>Sanidad:
      <select name="vacunas">
        <option <?php if ($vacunas == "Si" ) echo 'SELECTED'; ?> value="Si">Si</option>
        <option <?php if ($vacunas == "No" ) echo 'SELECTED'; ?> value="No">No</option>
      </select>
      </label>

      </br>
      </br>
      <labe>Estado:
      <select name="estado">
        <option <?php if ($estado == 1 ) echo 'SELECTED'; ?> value="1">1</option>
        <option <?php if ($estado == 2 ) echo 'SELECTED'; ?> value="2">2</option>
        <option <?php if ($estado == 3 ) echo 'SELECTED'; ?> value="3">3</option>
        <option <?php if ($estado == 4 ) echo 'SELECTED'; ?> value="4">4</option>
        <option <?php if ($estado == 5 ) echo 'SELECTED'; ?> value="5">5</option>
        <option <?php if ($estado == 6 ) echo 'SELECTED'; ?> value="6">6</option>
      </select>
      </label>

      <div class="form-actions">
        <a <?php echo "href=\"detail.php?senasa=" . $UID . "\"" ?> class="btn btn-info" >Volver</a>
        <button type="submit" name="submit" class="btn btn-success" value="Edit">Editar</button>
      </div>
  </fieldset>
  </form>
</div>




</body>
</html>




