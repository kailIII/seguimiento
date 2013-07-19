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
  <title>Feed Lot</title>
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
<h4 class="muted">Vacas Muertas a&ntilde;o <?php echo $time; ?></h4>

<div>
  <ul class="nav nav-tabs">
    <li class="dropdown">
      <a class="dropdown-toggle" data-toggle="dropdown" href="#"><h5>Vacas<b class="caret"></b></h5></a>
      <ul class="dropdown-menu">
        <li><a href="../main.php"><h5>Vivas</h5></a></li>
        <li><a href="#"><h5>Muertas</h5></a></li>
        <li><a href="vendidas.php"><h5>Vendidas<h5></a></li>
        <li class="divider"></li>
        <li><a href="perdidas.php"><h5>Perdidas</h5></a></li>
      </ul>
    </li>
    <li><a href="eventos.php"><h5>Eventos</h5></a></li>
    <li><a href="#"><h5>Vender</h5></a></li>
  </ul>
</div>
    


  <table id="completeTable" class="table table-striped">
    <thead>
    <tr>
      <th>id</th>
      <th>Nac.</th>
      <th>Sanidad</th>
      <th>Fecha de Muerte</th>
      <th>Comentario</th>
    </tr>
    </thead>
    <tbody>
  <?php 
    include 'connect.php';
    

    $result = mysql_query("SELECT DATE_FORMAT(hembras.time_hembra, '%m/%Y') AS 'date' , hembras.id_hembra, hembras.senasa_hembra, hembras.nacimiento_hembra,
              hembras.sanidad_hembra, hembras.estado_hembra, tacto.tacto, paricion.paricion, comentario_muerte.comentario_muerte FROM hembras INNER JOIN tacto ON tacto.id = hembras.tacto 
              INNER JOIN paricion ON paricion.id = hembras.paricion INNER JOIN comentario_muerte ON comentario_muerte.id = hembras.comentario_muerte
              WHERE hembras.existencia_hembra = '2' AND YEAR(hembras.time_hembra) = '$time' AND idusuario_hembra = '$id_usuario' ") or die (mysql_error());


    /*
    $sql = $conn->prepare('SELECT vacas.id, vacas.senasa, vacas.nacimiento, vacas.vacunas, vacas.periodo, vacas.estado, tacto.tacto, paricion.paricion FROM vacas 
             INNER JOIN tacto ON tacto.id = vacas.tacto INNER JOIN paricion ON paricion.id = vacas.paricion WHERE existencia = 1 AND periodo = 2013 ');
    $sql->execute(array());
    $resultado = $sql->fetchAll();
    */

    while($row = mysql_fetch_array($result)){

    echo "<tr><td>". $row['senasa_hembra'] . "</td>
    <td>".$row['nacimiento_hembra']."</td>
    <td>".$row['sanidad_hembra']."</td>
    <td>".$row['date']."</td>
    <td>".$row['comentario_muerte']."</td></tr>";
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