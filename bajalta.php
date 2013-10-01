<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=ISO-8859-1">
<link rel= stylesheet type= "text/css" href= "Archivos/estilos.css">
<title>Consulta de vehículos disponibles</title>
</head>

<body>

<?php
  session_start();
  $dni=$_SESSION['apostante'];
  $vl=$_GET['vl'];
  $host="bios.ugr.es";
  $user="dai";
  $pass="tel10co";
  $db=mysql_connect($host,$user,$pass) or die ("Error durante la conexión a la base de datos");
  
  if($vl==1){
    //En este caso el usuario se dará de baja
	$sql="UPDATE `Apostante` SET `Estado`='baja' WHERE `DNI`='".$dni."';";
	mysql_db_query("Rest_74736108T",$sql,$db);
	$sql2="UPDATE `Puja` SET `Estado`='baja' WHERE `Apostante`='".$dni."';";
	mysql_db_query("Rest_74736108T",$sql2,$db);
	}
  else{
    //En este caso el usuario se dará de alta
	$sql="UPDATE `Apostante` SET `Estado`='activo' WHERE `DNI`='".$dni."';";
	mysql_db_query("Rest_74736108T",$sql,$db);}
  
  header("location: menuapostante.php?var=$dni");
  exit;
  
?>


</body>
</html>