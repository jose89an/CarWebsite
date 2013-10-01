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
  $dni=$_SESSION['propietario'];
  $vl=$_GET['vl'];
  $host="bios.ugr.es";
  $user="dai";
  $pass="tel10co";
  $db=mysql_connect($host,$user,$pass) or die ("Error durante la conexión a la base de datos");
  
  if($vl==1){
    //En este caso el usuario se dará de baja
	$sql="UPDATE `Propietario` SET `Estado`='baja' WHERE `DNI`='".$dni."';";
	mysql_db_query("Rest_74736108T",$sql,$db);
	//Se ponen en estado de baja los vehículos pertenecientes al usuario
	$sql2="UPDATE `Vehiculo` SET `Estado`='baja' WHERE `Propietario`='".$dni."';";
	mysql_db_query("Rest_74736108T",$sql2,$db);
	//Además, se eliminan las pujas realizadas por estos vehículos que ya estuvieran de baja
	$sql3="SELECT `Matricula` FROM `Vehiculo` WHERE `Propietario`='".$dni."';";
	$result3=mysql_db_query("Rest_74736108T",$sql3,$db);
	$number=mysql_num_rows($result3);
	$i=0;
	if ($number!=0){
	while($i<$number){
	  $matriculas=mysql_fetch_row($result3);
	  $sqlx="DELETE FROM `Puja` WHERE `Vehiculo`='".$matriculas[0]."' AND `Estado`='baja';";
	  mysql_db_query("Rest_74736108T",$sqlx,$db);
	
	  $sqly="SELECT * FROM `Puja` WHERE `Vehiculo`='".$matriculas[0]."' AND `Estado`='activo';";
      $resulty=mysql_db_query("Rest_74736108T",$sqly,$db);
      $num=mysql_num_rows($resulty);
	  
	  if ($num==0){
	    $sqlz="DELETE FROM `Vehiculo` WHERE `Matricula`='".$matriculas[0]."';";
		mysql_db_query("Rest_74736108T",$sqlz,$db);
	  }
	  
	  $i++;
	}}
	
	}
  else{
    //En este caso el usuario se dará de alta
	$sql="UPDATE `Propietario` SET `Estado`='activo' WHERE `DNI`='".$dni."';";
	mysql_db_query("Rest_74736108T",$sql,$db);}
  
  header("location: menupropietario.php");
  exit;
  
?>


</body>
</html>