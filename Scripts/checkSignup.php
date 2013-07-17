<?php
// Inialize session
session_start();
include 'connect.php';
// Check, if user is already login, then jump to secured page
if (isset($_SESSION['email']) && isset($_SESSION['pass'])) {
header('Location: ../main.php');
}


$fname = mysql_real_escape_string($_POST['fname']);
$lname = mysql_real_escape_string($_POST['lname']);
$email = mysql_real_escape_string($_POST['email']);
$prefijo = mysql_real_escape_string($_['prefijo']);
$pass = mysql_real_escape_string($_POST['passwd']);
$conpasswd = mysql_real_escape_string($_POST['conpasswd']);

// $_POST['agreement'];


$pass = hash("sha256", $pass);


$checkMail = "SELECT * FROM gente WHERE email = '$email'";
$result = mysql_query($checkMail) or die(mysql_error());
$row = mysql_fetch_assoc($result);
    if(mysql_num_rows($result)) {
      $errMsg = 'Este email ya esta registrado';
    }else{
    	$registerDB = "INSERT INTO gente (nombre, apellido, prefijo, email, pass) VALUES ('{$fname}', '{$lname}', '{$email}', '{$prefijo}', '{$pass}')";
		mysql_query($registerDB)or die (mysql_error());
		header('Location: success.php');
    }



?>