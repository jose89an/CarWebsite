<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=ISO-8859-1">
<link rel= stylesheet type= "text/css" href= "Archivos/estilos.css">
<title>eGracar - Men� de administrador</title>
<script src="Archivos/scripts.js" type="text/javascript" language="JavaScript"></script>
</head>

<body>

<div id="general">

<?php
  $host="bios.ugr.es";
  $user="dai";
  $pass="tel10co";
  $db=mysql_connect($host,$user,$pass) or die ("Error durante la conexi�n a la base de datos");
  
  session_start();
  $dni=$_SESSION['administrador'];
  if ($dni=="74736108T"){
    echo "<div id='parteizq'>";
    echo "Men� de administrador<br>";
    echo "Usuario: Administrador<br>";
	echo "<a href='finsubasta.php'>Notificar subastas concluidas</a><br>";
    echo "<a href='index.php'>Cerrar sesi�n</a></div>";
	echo "<div id='logo'><img src='Archivos/logo.jpg'></div>";
	echo "<div id='parteder'>";
	echo "Bienvenido al men� de administrador.<br> Su labor ser� la de administrar las subastas concluidas cada d�a para que se cambie el estado del veh�culo en consecuencia y se env�e un correo al ganador de la puja por el veh�culo.<br>";
	error_reporting(0);
	$v=$_GET['vl'];
	if($v==2){
    echo "<font color='RED'>Ninguno de los veh�culos ha llegado a su fecha l�mite o ha sido vendido</font>";}
	echo "</div>";
	}
  else{
	echo "Error.";}
    ?>

</div>

</body>
</html>
