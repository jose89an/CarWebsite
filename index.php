<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=ISO-8859-1">
<link rel= stylesheet type= "text/css" href= "Archivos/estilos.css">
<title>eGracar - Subasta de vehículos</title>
</head>

<body>

<div id="general">
<div id='logoi'><img src='Archivos/logo.jpg'></div>
<div id="index">
  Bienvenido a eGracar, el servicio de subasta de vehículos por Internet.<br> Podrá poner en venta sus propios vehículos así como pujar por vehículos de otros usuarios.<br><br>
  
  <form name="inicio" action="inicio.php" method="post">
  DNI:
  <input type="text" name="dni" class="textbox"><br>
  Password:
  <input type="password" name="password" class="textbox"><br>
  Propietario
  <input type="radio" name="usuario" value="propietario">
  Apostante
  <input type="radio" name="usuario" value="apostante"><br>
  <input type="submit" name="enviar"><br>
  </form>
  <?php
    error_reporting(0);
	session_start();
	session_unset();
	session_destroy();
    $v=$_GET['var'];
	if($v==1){
	  $msg="No se encontró el usuario introducido";}
	elseif($v==2){
	  $msg="La password introducida es incorrecta para el usuario";}
	elseif($v==3){
	  $msg="Ha sido registrado satisfactoriamente. Puede entrar al servicio a partir de ahora";}
	else{
	  $msg="";}
	echo $msg."<br>";
  ?>
  ¿No está registrado? <a href="register.php">Regístrese</a> para poder acceder al servicio.
</div>
</div>

</body>
</html>
