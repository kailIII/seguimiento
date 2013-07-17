<?php

session_start();
include 'connect.php';
if (isset($_SESSION['email']) && isset($_SESSION['pass']) && isset($_SESSION['id'])) {
header('Location: ../index.php');
}

$email = mysql_real_escape_string($_POST['email']);
$pass = mysql_real_escape_string($_POST['pass']);

$pass = hash("sha256", $pass);

$checkUser = "SELECT * FROM gente WHERE email = '$email' AND pass = '$pass'";
$result = mysql_query($checkUser) or die(mysql_error());
$resultGetId = $result;

$count=mysql_num_rows($result);
if($count==1){
	while($row2 = mysql_fetch_array($resultGetId)){
		if($row2['activo'] == 1){
	$_SESSION['id'] = $row2['id'];
	$_SESSION['nombre'] = $row2['nombre'];
	$_SESSION['apellido'] = $row2['apellido'];
	// Register $myusername, $mypassword and redirect to file "login_success.php"
	$_SESSION['email'] = $email;
	$_SESSION['pass'] = $pass;
	header("location:../main.php");
		}else{
			header('Location: ../index.php');
		}
	}
} else {
	$msg = "Datos incorrectos";
	header("Location:../index.php?msg=". $msg);
}



?>