<?php 
session_start();
include "connect.php";
if (!isset($_SESSION['email']) && !isset($_SESSION['pass']) && !isset($_SESSION['id'])) {
header('Location: ../index.php');
}

$id_usuario = $_SESSION['id'];

$senasa = mysql_real_escape_string($_POST['senasa']);
$nacimiento = mysql_real_escape_string($_POST['nacimiento']);
$tacto = $_POST['tacto'];
$paricion = $_POST['paricion'];
$vacunas = $_POST['vacunas'];
$estado = $_POST['estado'];

$time = date(Y);

//Update hembras
$up = "UPDATE hembras SET nacimiento_hembra = '$nacimiento', tacto = '$tacto', paricion = '$paricion', vacunas_hembra = '$vacunas', 
estado_hembra = '$estado' WHERE senasa_hembra = '$senasa' AND YEAR(time_hembra) = '$time' AND idusuario_hembra = '$id_usuario'";

mysql_query($up) or die (mysql_error());
header('Location: ../main.php');

?>


