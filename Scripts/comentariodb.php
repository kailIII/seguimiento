<?php
session_start();
include "connect.php";
if (!isset($_SESSION['email']) && !isset($_SESSION['pass']) && !isset($_SESSION['id'])) {
header('Location: ../index.php');
}

$id_usuario = $_SESSION['id'];

$UID = $_POST['senasa'];

$comentario = $_POST['comment'];


$insert = "INSERT INTO comentarios (senasa_comentario, comentario, idusuario_comentario) VALUES ('$UID', '$comentario', '$id_usuario' )";
mysql_query($insert)or die(mysql_error());

header('Location: detail.php?senasa=' . $UID);

?>