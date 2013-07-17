<?php
session_start();
include 'connect.php';
// Check, if user is already login, then jump to secured page
if (isset($_SESSION['email']) && isset($_SESSION['pass']) && isset($_SESSION['id'])) {
header('Location: ../main.php');
}

if(isset($_POST['submit'])){
$fname = mysql_real_escape_string($_POST['fname']);
$lname = mysql_real_escape_string($_POST['lname']);
$email = mysql_real_escape_string($_POST['email']);
$pass = mysql_real_escape_string($_POST['passwd']);
$conpasswd = mysql_real_escape_string($_POST['conpasswd']);


$pass = hash("sha256", $pass);


$checkMail = "SELECT * FROM gente WHERE email = '$email'";
$result = mysql_query($checkMail) or die(mysql_error());
$row = mysql_fetch_assoc($result);
    if(mysql_num_rows($result)) {
      $errMsg = 'Este email ya esta registrado';
    }else{
    	$registerDB = "INSERT INTO gente (nombre, apellido, email, pass) VALUES ('{$fname}', '{$lname}', '{$email}', '{$pass}')";
		mysql_query($registerDB)or die (mysql_error());
		header('Location: success.php');
    }
}

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

<div class="container">

  <div class="masthead">
    <ul class="nav nav-pills pull-right">
      <li><a href="#">About</a></li>
      <li><a href="#">Contact</a></li>
    </ul>
    <h3 class="muted">Ganado Bovino</h3>
  </div>

	
<div class="container">

<div class="well">    
      <form id="signup" class="form-horizontal" method="POST" action="">
      	<fieldset>
		<legend><strong>Registro</strong></legend>		
		<div class="control-group">
	        <label class="control-label">Nombre</label>
			<div class="controls">
			    <div class="input-prepend">
				<span class="add-on"><i class="icon-user"></i></span>
					<input type="text" class="input-xlarge" id="fname" name="fname" placeholder="Nombre" value="<?php if(isset($fname)) echo $fname; ?>">
				</div>
			</div>
		</div>
		<div class="control-group ">
	        <label class="control-label">Apellido</label>
			<div class="controls">
			    <div class="input-prepend">
				<span class="add-on"><i class="icon-user"></i></span>
					<input type="text" class="input-xlarge" id="lname" name="lname" placeholder="Apellido" value="<?php if(isset($lname)) echo $lname; ?>">
				</div>
			</div>
		</div>
		<div class="control-group">
	        <label class="control-label">Email</label>
			<div class="controls">
			    <div class="input-prepend">
				<span class="add-on"><i class="icon-envelope"></i></span>
					<input type="text" class="input-xlarge" id="email" name="email" placeholder="Email" value="<?php if(isset($email)) echo $email; ?>">
					<?php if(isset($errMsg)) echo "<span class=\"label label-important\">" .$errMsg . "</span>"; ?>
				</div>
			</div>	
		</div>
		</br>
		<div class="control-group">
	        <label class="control-label">Prefijo Caravana</label>
			<div class="controls">
			    <div class="input-prepend">
				<span class="add-on"><i class="icon-check"></i></span>
					<input type="text" id="prefijo" class="input-xlarge" name="prefijo" placeholder="Prefijo Caravana" readonly>
				</div>
			</div>
		</div>
		</br>
		<div class="control-group">
	        <label class="control-label">Contrase&ntilde;a</label>
			<div class="controls">
			    <div class="input-prepend">
				<span class="add-on"><i class="icon-lock"></i></span>
					<input type="Password" id="passwd" class="input-xlarge" name="passwd" placeholder="Contrase&ntilde;a">
				</div>
			</div>
		</div>
		<div class="control-group">
	        <label class="control-label">Confirmar Contrase&ntilde;a</label>
			<div class="controls">
			    <div class="input-prepend">
				<span class="add-on"><i class="icon-lock"></i></span>
					<input type="Password" id="conpasswd" class="input-xlarge" name="conpasswd" placeholder="Re-ingresar Contrase&ntilde;a">
				</div>
			</div>
		</div>

		<div class="control-group">
	        <label class="checkbox" for="agree">
	        	<div class="controls">
					<input type="checkbox" id="agree" name="agreement"><span>&nbsp;&nbsp;&nbsp;</span>Acepto t&eacute;rminos y condiciones
				</div>
			</label>
		</div>

		<div class="control-group">
		<label class="control-label" for="input01"></label>
	      <div class="controls">
	       <button type="submit" class="btn btn-success" rel="tooltip" title="first tooltip">Crear Cuenta</button>
	       <a class="btn btn-warning" rel="tooltip" title="first tooltip" href="../index.php">Volver</a>
	       <input type='hidden' name='submit' />
	      </div>
	
	</div>
		</fieldset>
	  </form>

   </div>
</div>
    <!-- Javascript placed at the end of the file to make the  page load faster -->
    <script type="text/javascript" src="../jquery/jquery-latest.js"></script> 
  	<script type="text/javascript" src="../jquery/jquery.validate.js"></script>
  	<script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script> 
	<script type="text/javascript">
	  $(document).ready(function(){
			
			$("#signup").validate({
				rules:{
					fname:"required",
					lname:"required",
					email:{
							required:true,
							email: true
						},
					passwd:{
						required:true,
						minlength: 8
					},
					conpasswd:{
						required:true,
						equalTo: "#passwd"
					},
					gender:"required"
				},
				
				errorClass: "help-inline"
				
			});
		});
	</script>



  

  </body>
</html>

	