<?php
session_start();
include "connect.php";
if (!isset($_SESSION['email']) && !isset($_SESSION['pass']) && !isset($_SESSION['id'])) {
header('Location: ../index.php');
}

$id_usuario = $_SESSION['id'];
$id_vaca = $_GET['id'];
$senasa = $_GET['senasa'];


$query = "DELETE FROM vacas WHERE id = '$id_vaca' AND id_usuario = '$id_usuario'";

$queryVac = "DELETE FROM vacunas_int WHERE id_vaca = '$senasa' AND id_usuario = '$id_usuario'";

mysql_query($query) or die (mysql_error());
mysql_query($queryVac) or die (mysql_error());
header('Location: ../index.php');

?>