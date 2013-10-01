<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=ISO-8859-1">
<link rel= stylesheet type= "text/css" href= "Archivos/estilos.css">
<title>Menú de propietario</title>
<script src="Archivos/scripts.js" type="text/javascript" language="JavaScript"></script>
</head>

<body>

<div id="general3">
<?php
  $host="bios.ugr.es";
  $user="dai";
  $pass="tel10co";
  $db=mysql_connect($host,$user,$pass) or die ("Error durante la conexión a la base de datos");
  
  session_start();
  $dni=$_SESSION['administrador'];
  
  if($dni=="74736108T"){
  
  $sql="SELECT * FROM `Vehiculo` WHERE `Estado`='subasta'";
  $result=mysql_db_query("Rest_74736108T",$sql,$db);
  $num=mysql_num_rows($result);
  $i=0;
  $s=1;
  while($i<$num){
    $array=mysql_fetch_row($result);
	$fechafin=strtotime($array[8]);
	$sql2="SELECT * FROM Puja WHERE Vehiculo='".$array[0]."' AND `Estado`='activo' ORDER BY Dinero DESC LIMIT 1";
	$result2=mysql_db_query("Rest_74736108T",$sql2,$db);
	$numap=mysql_num_rows($result2);
	$arraypuja=mysql_fetch_row($result2);
	if (time() > $fechafin){
	  if ($numap>0){
	    $s=0;
	    $sql3="UPDATE `Vehiculo` SET `Estado`='vendido' WHERE `Matricula`='".$array[0]."';";
	    mysql_db_query("Rest_74736108T",$sql3,$db);
		//Ahora seleccionamos al apostante que ha ganado la puja para enviarle un correo
		$sqlap="SELECT `Email` FROM `Apostante` WHERE `DNI`='".$arraypuja[1]."';";
		$resultap=mysql_db_query("Rest_74736108T",$sqlap,$db);
		$emailap=mysql_fetch_row($resultap);
		$enlace="http://bios.ugr.es/cgi-bin/formmail.cgi?recipient=".$emailap[0]."&Vehiculo_adquirido=".$arraypuja[0]."&Precio=".$arraypuja[2]."";
		header("location: ".$enlace."");
		}
	  else{
	    $sql3="UPDATE `Vehiculo` SET `Estado`='sin vender' WHERE `Matricula`='".$array[0]."';";
	    mysql_db_query("Rest_74736108T",$sql3,$db);}
	}
	$i++;
  }
  if ($s!=0){
  header("location: menuadmin.php?vl=2");}
  }
?>
</div>

</body>
</html>
