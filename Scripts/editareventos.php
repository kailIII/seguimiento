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
  <title>Editar Actividades</title>

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
  		<h4 class="muted">Agregando Eventos: Vaca N&#176; <?php echo $UID; ?></h4>
    </div>
  </div>
  <hr>
  </br>

  <div id="formActividades">
  <form action="editardbeventos.php" method="POST">
    <h4 class="text-error">Indique las actividades que desea agregar</h4>
    	</br>
        <label class="checkbox inline">
        <input type="checkbox" name="check2[]" value="1">Servicio</input>
        </label>
        <label class="checkbox inline">
        <input type="checkbox" name="check2[]" value="2">Destete</input>
        </label>
        <label class="checkbox inline">
        <input type="checkbox" name="check2[]" value="3">Descorne</input>
        </label>
        <label class="checkbox inline">
        <input type="checkbox" name="check2[]" value="4">Se&ntilde;alada</input>
        </label>
        </br>
        </br>
        <label class="checkbox inline">
        <input type="checkbox" name="check2[]" value="5">Marcacion</input>
        </label>
        <label class="checkbox inline">
        <input type="checkbox" name="check2[]" value="6">Castracion</input>
        </label>
        <label class="checkbox inline">
        <input type="checkbox" name="check2[]" value="7">Tacto Rectal</input>
        </label>
        </br>
        </br>
        <label class="checkbox inline">
        <input type="checkbox" name="check2[]" value="8">Descarte de Vacas</input>
        </label>
        <label class="checkbox inline">
        <input type="checkbox" name="check2[]" value="9">Revisi&oacute;n de Toros</input>
        </label>
        <label class="checkbox inline">
        <input type="checkbox" name="check2[]" value="10">Inventario</input>
        </label>
        <br/>
        <br/>
        <input type="hidden" name="senasa" value="<? echo $UID; ?>">
        <input type="submit" value="Agregar" class="btn btn-success"></input>
      </fieldset>
  </form>
</div>
</body>
</html>