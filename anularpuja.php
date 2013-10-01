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
  $matr=$_GET['matr'];
  $host="bios.ugr.es";
  $user="dai";
  $pass="tel10co";
  $db=mysql_connect($host,$user,$pass) or die ("Error durante la conexión a la base de datos");
  
  $sql="SELECT * FROM `Puja` WHERE `Vehiculo`='".$matr."' AND `Apostante`='".$dni."'";
  $result=mysql_db_query("Rest_74736108T",$sql,$db);
  $num=mysql_num_rows($result);
  if($num==0){
    //Este mensaje se produce en caso de no haber pujado por este vehículo
    $msg=1;}
  else{
    $sql2="UPDATE `Puja` SET `Estado`='baja' WHERE `Vehiculo`='".$matr."' AND `Apostante`='".$dni."'";
	mysql_db_query("Rest_74736108T",$sql2,$db);
	//En este caso la puja ha sido borrada
	$msg=2;
	}
	echo $msg;
  
  header("location: consulta.php?msg=$msg");
  exit;
  
?>


</body>
</html>
