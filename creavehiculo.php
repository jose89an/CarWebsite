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
  
  session_start();
  $dni=$_SESSION['propietario'];
  $matr=$_POST['matricula'];
  $marca=$_POST['marca'];
  $modelo=$_POST['modelo'];
  $anyo=$_POST['anyo'];
  $km=$_POST['kilometraje'];
  $precio=$_POST['precio'];
  $dialim=$_POST['dialim'];
  $meslim=$_POST['meslim'];
  $anyolim=$_POST['anyolim'];
  
  if (!checkdate($meslim, $dialim, $anyolim)){
    header("location: altavehiculo.php?vl=1");
  }
  else{
  
    $sqlm="SELECT * FROM `Vehiculo` WHERE `Matricula`='".$matr."'";
	$result=mysql_db_query("Rest_74736108T",$sqlm,$db);
	$n=mysql_num_rows($result);
	
	if ($n==0){
  
    $sql=" INSERT INTO `Vehiculo` (`Matricula` ,`Marca` ,`Modelo` ,`Anyo` ,`Kilometraje` ,`Precio_Salida` ,`Propietario` ,`Estado` ,`Fecha`)VALUES ('".$matr."', '".$marca."', '".$modelo."', '".$anyo."', '".$km."', '".$precio."', '".$dni."', 'subasta', '".$anyolim."-".$meslim."-".$dialim." 00:00:00') ";
    mysql_db_query("Rest_74736108T",$sql,$db);
	header("location: menupropietario.php?vl=1");}
	else{
	  header("location:altavehiculo.php?vl=2");}
  }

?>
</body>
</html>
