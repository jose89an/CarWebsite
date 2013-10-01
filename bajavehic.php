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
  
  $dni=$_GET['var'];
  $matr=$_GET['matr'];
  $estado=$_GET['vl'];
  
  if ($estado=='baja'){
    $stpuja='baja';}
  elseif($estado=='subasta'){
    $stpuja='activo';}
  
  $sql2="SELECT * FROM `Puja` WHERE `Vehiculo`='".$matr."' AND `Estado`='activo';";
  $result2=mysql_db_query("Rest_74736108T",$sql2,$db);
  $num=mysql_num_rows($result2);
  
  if ($num==0 && $estado=='baja'){
    //Si no hay pujas por el vehículo y quiere darse de baja, se elimina de la base de datos
    $sql="DELETE FROM `Vehiculo` WHERE `Matricula`='".$matr."';";
	mysql_db_query("Rest_74736108T",$sql,$db);}
  else{
    //En caso contrario, se actualiza el estado del vehículo según sea subasta o baja
    $sql="UPDATE `Vehiculo` SET `Estado`='".$estado."' WHERE `Matricula`='".$matr."';";
    mysql_db_query("Rest_74736108T",$sql,$db);
	if ($estado=='baja'){
	  //Si se quiere dar de baja un vehículo, se eliminan de la base de datos las pujas que hayan sido dadas de baja
	  $sqlx="DELETE FROM `Puja` WHERE `Vehiculo`='".$matr."' AND `Estado`='baja';";
	  mysql_db_query("Rest_74736108T",$sqlx,$db);}
  }
    
  
  if ($estado=='baja'){
    $vl=1;}
  elseif ($estado=='subasta'){
    $vl=2;}
	
  header("location: vehicprop.php?vl=$vl");
  exit;
  
?>
</body>
</html>
