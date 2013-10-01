<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=ISO-8859-1">
<link rel= stylesheet type= "text/css" href= "Archivos/estilos.css">
<title>Consulta de vehículos disponibles</title>
</head>

<body>

<?php

  $host="bios.ugr.es";
  $user="dai";
  $pass="tel10co";
  $db=mysql_connect($host,$user,$pass) or die ("Error durante la conexión a la base de datos");
  
  $dni=$_POST["dni"];
  $password=$_POST["password"];
  $usuario=$_POST["usuario"];
  $nombre=$_POST["nombre"];
  $email=$_POST["email"];
  $telefono=$_POST["telefono"];
  
  if($usuario=="propietario"){
    $sql="SELECT * FROM `Propietario` WHERE `dni`='".$dni."'";
    $sql2="INSERT INTO `Propietario` (`Nombre` ,`Telefono` ,`DNI` ,`Estado` ,`Password` ,`Email`) VALUES ('".$nombre."', '".$telefono."', '".$dni."', 'activo', '".$password."', '".email."');";}
  elseif($usuario=="apostante"){
    $sql="SELECT * FROM `Apostante` WHERE `dni`='".$dni."'";
	$sql2="INSERT INTO `Apostante` (`Nombre` ,`DNI` ,`Telefono` ,`Estado` ,`Password` ,`Email`) VALUES ('".$nombre."', '".$dni."', '".$telefono."', 'activo', '".$password."', '".email."');";}
  
  
  $result=mysql_db_query("Rest_74736108T",$sql,$db);
  $n=mysql_num_rows($result);
  if($n!=0){
	$s=1;
  }
  else{
    mysql_db_query("Rest_74736108T",$sql2,$db);
	$s=2;
	}
	
  if($s==1){
    header("location: register.php?var=1");
	exit;}
  if($s==2){
    header("location: index.php?var=3");
	exit;}

?>
</body>
</html>
