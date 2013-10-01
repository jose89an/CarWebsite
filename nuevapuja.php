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
  $cant=$_POST['cantidad'];
  $host="bios.ugr.es";
  $user="dai";
  $pass="tel10co";
  $db=mysql_connect($host,$user,$pass) or die ("Error durante la conexión a la base de datos");
  
  $sql="SELECT * FROM `Vehiculo` WHERE `Matricula`='".$matr."' AND `Estado`='subasta'";
  $result=mysql_db_query("Rest_74736108T",$sql,$db);
  $n=mysql_num_rows($result);
  if($n==0){
    //Este mensaje se produce en caso de no existir un vehículo en subasta con la matrícula introducida
    $msg=1;}
  else{
    $sql2="SELECT * FROM `Puja` WHERE `Vehiculo`='".$matr."' AND `Estado`='activo'";
	$result2=mysql_db_query("Rest_74736108T",$sql2,$db);
	$n2=mysql_num_rows($result2);
	if($n2==0){
	  //Caso en el que no hay ninguna puja hecha para este vehículo
	  $sql3="SELECT `Precio_Salida` FROM `Vehiculo` WHERE `Matricula`='".$matr."'";
	  $result3=mysql_db_query("Rest_74736108T",$sql3,$db);
	  $precio=mysql_fetch_row($result3);
	  if($cant>$precio[0]){
	    //Caso en el que se oferta una cantidad mayor que el precio de salida
		$sqlh="SELECT * FROM `Puja` WHERE `Vehiculo`='".$matr."' AND `Apostante`='".$dni."'";
		$resulth=mysql_db_query("Rest_74736108T",$sqlh,$db);
		$nh=mysql_num_rows($resulth);
		if ($nh==0){
		//En caso de que no haya apuestas nuestras en estado de baja anteriormente
		  $sql4="INSERT INTO `Puja` (`Vehiculo`,`Apostante`,`Dinero`,`Estado`) VALUES ('".$matr."', '".$dni."', '".$cant."', 'activo')"; 
	      mysql_db_query("Rest_74736108T",$sql4,$db);}
		//En caso de que ya hayamos apostado pero diéramos de baja la apuesta
		else{
		  $sql4="UPDATE `Puja` SET `Dinero`=".$cant.",`Estado`='activo' WHERE `Apostante`='".$dni."' AND `Vehiculo`='".$matr."';";
		  mysql_db_query("Rest_74736108T",$sql4,$db);
		}
		//En este caso se crea la puja y se manda el mensaje de puja creada
		$msg=2;}
	  else{
	    //Caso en el que se oferta una cantidad menor que el precio de salida
		$msg=3;} //Mensaje de precio insuficiente para la puja
	}
	else{
	  //Caso en el que ya hay pujas realizadas para este vehículo
	  $sql3="SELECT `Dinero` FROM `Puja` WHERE `Vehiculo`='".$matr."' AND `Estado`='activo' ORDER BY `Dinero` DESC LIMIT 1";
	  $result3=mysql_db_query("Rest_74736108T",$sql3,$db);
	  $precio=mysql_fetch_row($result3);
	  if($cant>$precio[0]){
	    // Caso en el que se oferta una cantidad mayor a la máxima puja realizada para el vehículo
		$sql4="SELECT * FROM `Puja` WHERE `Vehiculo`='".$matr."' AND `Apostante`='".$dni."'";
		$result4=mysql_db_query("Rest_74736108T",$sql4,$db);
		$n4=mysql_num_rows($result4);
		if($n4==0){
		  //Caso en el que el usuario no haya realizado pujas por este vehículo
		  $sql5="INSERT INTO `Puja` (`Vehiculo`,`Apostante`,`Dinero`,`Estado`) VALUES ('".$matr."', '".$dni."', '".$cant."', 'activo')";
	      mysql_db_query("Rest_74736108T",$sql5,$db);
		  //En este caso se crea la puja y se manda el mensaje de puja creada
		  $msg=2;}
		else{
		  //Caso en el que el usuario ya haya realizado pujas por este vehículo
		  $sql5="UPDATE `Puja` SET `Dinero`=".$cant.",`Estado`='activo' WHERE `Apostante`='".$dni."' AND `Vehiculo`='".$matr."';";
		  mysql_db_query("Rest_74736108T",$sql5,$db);
		  //En este caso se actualiza la puja y se manda el mensaje de puja actualizada
		  $msg=4;}
	  }
	  else{
	  	//Caso en el que se oferta una cantidad menor que el mayor precio ofertado
		$msg=3;} //Mensaje de precio insuficiente para la puja
	}
  }
  
  header("location: puja.php?msg=$msg");
  exit;
  
?>


</body>
</html>
