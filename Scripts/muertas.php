<?php
session_start();

if (!isset($_SESSION['email']) && !isset($_SESSION['pass']) && !isset($_SESSION['id'])) {
header('Location: index.php');
}

$id_usuario = $_SESSION['id'];
$nombre = $_SESSION['nombre'];
$apellido = $_SESSION['apellido'];


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
    <h3 class="muted">Ganado Bovino</h3>
  </div>
</div>

<div class="container-narrow">
  <div class="masthead">
      <div class="navbar">
        <div class="navbar-inner">
          <div class="container">
            <ul class="nav">
              <li><a href="../main.php">Madres</a></li>
              <li class="active"><a href="#">Muertas</a></li>
              <li><a href="vendidas.php">Vendidas</a></li>
              <li><a href="eventos.php">Eventos</a></li>
            </ul>
          </div>
        </div>
      </div><!-- /.navbar -->
    </div>
    <h4 class="muted">Vacas Muertas</h4>


  <table id="completeTable" class="table table-striped">
    <thead>
    <tr>
      <th>id</th>
      <th>Nac.</th>
      <th>Sanidad</th>
      <th>Estado</th>
      <th>Fecha de Muerte</th>
    </tr>
    </thead>
    <tbody>
  <?php 
    include 'connect.php';
    
    $time = date(Y);

    $result = mysql_query("SELECT DATE_FORMAT(hembras.time_hembra, '%m/%Y') AS 'date' , hembras.id_hembra, hembras.senasa_hembra, hembras.nacimiento_hembra,
              hembras.vacunas_hembra, hembras.estado_hembra, tacto.tacto, paricion.paricion FROM hembras INNER JOIN tacto ON tacto.id = hembras.tacto 
              INNER JOIN paricion ON paricion.id = hembras.paricion WHERE hembras.existencia_hembra = '2' AND YEAR(hembras.time_hembra) = '$time' AND idusuario_hembra = '$id_usuario' ") or die (mysql_error());

    /*
    $sql = $conn->prepare('SELECT vacas.id, vacas.senasa, vacas.nacimiento, vacas.vacunas, vacas.periodo, vacas.estado, tacto.tacto, paricion.paricion FROM vacas 
             INNER JOIN tacto ON tacto.id = vacas.tacto INNER JOIN paricion ON paricion.id = vacas.paricion WHERE existencia = 1 AND periodo = 2013 ');
    $sql->execute(array());
    $resultado = $sql->fetchAll();
    */

    while($row = mysql_fetch_array($result)){

    echo "<tr><td>". $row['senasa_hembra'] . "</td>
    <td>".$row['nacimiento_hembra']."</td>
    <td>".$row['vacunas_hembra']."</td>
    <td>".$row['estado_hembra']."</td>
    <td>".$row['date']."</td></tr>";
    }
  ?>
  </tbody>
  </table>
  
</div>

  <div class="footer"></div>
  <script type="text/javascript" src="../jquery/jquery-latest.js"></script> 
  <script type="text/javascript" src="../jquery/jquery.tablesorter.min.js"></script>
  <script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script> 
  <script type="text/javascript" src="../Js/vacas.js"></script> 

 </body>
</html>