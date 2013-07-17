<?php
session_start();

if (!isset($_SESSION['email']) && !isset($_SESSION['pass']) && !isset($_SESSION['id'])) {
header('Location: index.php');
}

$id_usuario = $_SESSION['id'];
$nombre = $_SESSION['nombre'];
$apellido = $_SESSION['apellido'];
if(isset($_GET['error'])){
  $errorDash = "Solo puede introducir letras o numeros";
}
 
if(isset($_GET['errorNacimiento'])){
  $errorNacimiento = "Corrija el formato de la fecha";
}

if(isset($_GET['errorCaravana'])){
  $errorCaravana = "Ya existe una vaca con esa varavana en este periodo";
}

if(isset($_GET['errorRango'])){
  $errorRango = "Debe agregar menos de 500 vacas por vez";
}

?>

<!DOCTYPE html>
<html lang="en">
 <head>
  <title>Feed Lot</title>
  <meta name="viewport" content="width=device-width, initial-scale=0.7">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
  <link href="bootstrap/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
  <link href="bootstrap/css/bootstrap-responsive.min.css" type="text/css" rel="stylesheet" />
  <link href="Css/vacas.css" type="text/css" rel="stylesheet" />
 </head>
 <body>

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

<div class="container-narrow">
  <div class="masthead">
      <div class="navbar">
        <div class="navbar-inner">
          <div class="container">
            <ul class="nav">
              <li class="active"><a href="#">Madres</a></li>
              <li><a href="Scripts/muertas.php">Muertas</a></li>
              <li><a href="Scripts/vendidas.php">Vendidas</a></li>
              <li><a href="Scripts/eventos.php">Eventos</a></li>
            </ul>
          </div>
        </div>
      </div><!-- /.navbar -->
    </div>
  <button href="#" onclick="showForm()" id="addButton" class="btn btn-warning">Agregar</button>
  <br/>
  <br/>
  <form id="formContainer" <?php if(isset($errorDash) || isset($errorNacimiento) || isset($errorRango)) echo "style=\"display:block\" "; ?> action="Scripts/addCow.php" method="POST">
    <fieldset>
        Caravana:
        <input type="text" name="senasa" required maxlength="10"><?php if(isset($errorDash)) echo "<span class=\"label label-important\">" .$errorDash . "</span></br></br>"; ?>
        <?php if(isset($errorCaravana)) echo "<span class=\"label label-important\">" .$errorCaravana . "</span></br></br>"; ?>
        <?php if(isset($errorRango)) echo "<span class=\"label label-important\">" .$errorRango . "</span></br></br>"; ?>
        </br>
        Fecha de Nac.:
        <input type="text" name="nacimiento" placeholder="mm/aa" id="edad" required><?php if(isset($errorNacimiento)) echo "<span class=\"label label-important\">" .$errorNacimiento . "</span></br></br>"; ?>
        <br/>
        <br/>
        <input type="submit" value="Agregar" class="btn btn-success"></input>
      </fieldset>
  </form>

  <table id="completeTable" class="table table-striped">
    <thead>
    <tr>
      <th>id</th>
      <th>Nac.</th>
      <th>Tacto</th>
      <th>Parici&oacute;n</th>
      <th>Sanidad</th>
      <th>Estado</th>
      <th>Venta</th>
    </tr>
    </thead>
    <tbody>
  <?php 
    include 'Scripts/connect.php';

    $time = date(Y);


    $result = mysql_query("SELECT hembras.id_hembra, hembras.senasa_hembra, hembras.nacimiento_hembra, hembras.vacunas_hembra, hembras.estado_hembra, YEAR(hembras.time_hembra), tacto.tacto, paricion.paricion FROM hembras 
             INNER JOIN tacto ON tacto.id = hembras.tacto INNER JOIN paricion ON paricion.id = hembras.paricion WHERE existencia_hembra = '1' AND YEAR(hembras.time_hembra) = '$time' AND hembras.id_lote = '1' AND idusuario_hembra = '$id_usuario' ") or die (mysql_error());

    /*
    $sql = $conn->prepare('SELECT vacas.id, vacas.senasa, vacas.nacimiento, vacas.vacunas, vacas.periodo, vacas.estado, tacto.tacto, paricion.paricion FROM vacas 
             INNER JOIN tacto ON tacto.id = vacas.tacto INNER JOIN paricion ON paricion.id = vacas.paricion WHERE existencia = 1 AND periodo = 2013 ');
    $sql->execute(array());
    $resultado = $sql->fetchAll();
    */

    while($row = mysql_fetch_array($result)){

    echo "<tr><td><a href=\"Scripts/detail.php?senasa=" . $row['senasa_hembra'] . "\" >" . $row['senasa_hembra'] . "</a></td>
    <td>".$row['nacimiento_hembra']."</td>
    <td>".$row['tacto']."</td>
    <td>".$row['paricion']."</td>
    <td>".$row['vacunas_hembra']."</td>
    <td>".$row['estado_hembra']."</td>
    <td><a href=\"Scripts/vendida.php?id=" . $row['id_hembra'] . "&senasa=" . $row['senasa_hembra'] . "\" ><i class=\"icon-stop\"></a></td></tr>";
    }
  ?>
  </tbody>
  </table>
  
</div>

  <div class="footer"></div>
  <script type="text/javascript" src="jquery/jquery-latest.js"></script> 
  <script type="text/javascript" src="jquery/jquery.tablesorter.min.js"></script>
  <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="../jquery/jquery.validate.js"></script> 
  <script type="text/javascript" src="Js/vacas.js"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      
      $("#formContainer").validate({
        rules:{
          senasa:"required",
          nacimiento:"required",    
        errorClass: "help-inline"
      }
    });
    });  
  </script>
 </body>
</html>
