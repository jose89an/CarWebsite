<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=ISO-8859-1">
<link rel= stylesheet type= "text/css" href= "Archivos/estilos.css">
<title>eGracar - Subasta de veh�culos</title>
</head>

<body>

<div id="general">
<div id='logoi'><img src='Archivos/logo.jpg'></div>
<div id="index">
  Bienvenido a eGracar, el servicio de subasta de veh�culos por Internet.<br> Podr� poner en venta sus propios veh�culos as� como pujar por veh�culos de otros usuarios.<br><br>
  
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
	  $msg="No se encontr� el usuario introducido";}
	elseif($v==2){
	  $msg="La password introducida es incorrecta para el usuario";}
	elseif($v==3){
	  $msg="Ha sido registrado satisfactoriamente. Puede entrar al servicio a partir de ahora";}
	else{
	  $msg="";}
	echo $msg."<br>";
  ?>
  �No est� registrado? <a href="register.php">Reg�strese</a> para poder acceder al servicio.
</div>
</div>

</body>
</html>
