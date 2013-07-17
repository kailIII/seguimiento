<?php
session_start();
include "connect.php";
if (!isset($_SESSION['email']) && !isset($_SESSION['pass']) && !isset($_SESSION['id'])) {
header('Location: ../index.php');
}

$id_usuario = $_SESSION['id'];
$senasa = $_GET['senasa'];


$query = "UPDATE hembras SET existencia_hembra = '3' WHERE senasa_hembra = '$senasa' AND idusuario_hembra = '$id_usuario'";

//$queryVac = "DELETE FROM vacunas_int WHERE id_vaca = '$senasa' AND id_usuario = '$id_usuario'";

mysql_query($query) or die (mysql_error());
//mysql_query($queryVac) or die (mysql_error());
header('Location: ../index.php');

?>