<?php
session_start();

if (!isset($_SESSION['email']) && !isset($_SESSION['pass']) && !isset($_SESSION['id'])) {
header('Location: index.php');
}

$id_usuario = $_SESSION['id'];
$nombre = $_SESSION['nombre'];
$apellido = $_SESSION['apellido'];

$time = date(Y);

?>

<!DOCTYPE html>
<html lang="en">
 <head>
  <title>Vacas Perdidas</title>
  <meta name="viewport" content="width=device-width, initial-scale=0.7">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
  <link href="../bootstrap/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
  <link href="../bootstrap/css/bootstrap-responsive.min.css" type="text/css" rel="stylesheet" />
 </head>
 <body>

<div class="container-narrow">

  <div class="masthead">
    <ul class="nav nav-pills pull-right">
      <li><a href="#">Usuario: <?php echo $nombre . " " . $apellido; ?></a>
      <li><a href="#">About</a></li>
      <li><a href="#">Contact</a></li>
      <li class="active"><a href="logOut.php" class="btn-danger">Cerrar sesi&oacute;n</a></li>
    </ul>
    <h3>Ganado Bovino</h3>
  </div>
</div>
<h4 class="muted">Vacas perdidas a&ntilde;o <?php echo $time; ?> </h4>
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
    <h4 class="muted">Vacas Perdidas</h4>


  <table id="completeTable" class="table table-striped">
    <thead>
    <tr>
      <th>id</th>
      <th>Nac.</th>
      <th>Tacto</th>
      <th>Parici&oacute;n</th>
      <th>Sanidad</th>
      <th>Estado</th>
      <th></th>
    </tr>
    </thead>
    <tbody>
  <?php 
    include 'connect.php';


    $result = mysql_query("SELECT hembras.id_hembra, hembras.senasa_hembra, hembras.nacimiento_hembra, hembras.sanidad_hembra, hembras.estado_hembra, YEAR(hembras.time_hembra), tacto.tacto, paricion.paricion FROM hembras 
             INNER JOIN tacto ON tacto.id = hembras.tacto INNER JOIN paricion ON paricion.id = hembras.paricion WHERE existencia_hembra = '4' AND YEAR(hembras.time_hembra) = '$time' AND hembras.id_lote = '1' AND idusuario_hembra = '$id_usuario' ") or die (mysql_error());

    /*
    $sql = $conn->prepare('SELECT vacas.id, vacas.senasa, vacas.nacimiento, vacas.vacunas, vacas.periodo, vacas.estado, tacto.tacto, paricion.paricion FROM vacas 
             INNER JOIN tacto ON tacto.id = vacas.tacto INNER JOIN paricion ON paricion.id = vacas.paricion WHERE existencia = 1 AND periodo = 2013 ');
    $sql->execute(array());
    $resultado = $sql->fetchAll();
    */

    while($row = mysql_fetch_array($result)){

    echo "<tr><td><a href=\"detallePerdida.php?senasa=" . $row['senasa_hembra'] . "\" >" . $row['senasa_hembra'] . "</a></td>
    <td>".$row['nacimiento_hembra']."</td>
    <td>".$row['tacto']."</td>
    <td>".$row['paricion']."</td>
    <td>".$row['sanidad_hembra']."</td>
    <td>".$row['estado_hembra']."</td>
    <td><a href=\"encontrada.php?id=" . $row['id_hembra'] . "&senasa=" . $row['senasa_hembra'] . "\" class=\"btn btn-info\" >Aparecio</a></td></tr>";
    }
  ?>
  </tbody>
  </table>
</div>

  <div class="footer"></div>
  <script type="text/javascript" src="../jquery/jquery-latest.min.js"></script> 
  <script type="text/javascript" src="../jquery/jquery.tablesorter.min.js"></script>
  <script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script> 
  <script type="text/javascript" src="../Js/vacas.js"></script>
 </body>
</html>
