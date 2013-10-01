<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=ISO-8859-1">
<link rel= stylesheet type= "text/css" href= "Archivos/estilos.css">
<title>eGracar - Menú de propietario</title>
<script src="Archivos/scripts.js" type="text/javascript" language="JavaScript"></script>
</head>

<body>

<div id="general">

<?php
  $host="bios.ugr.es";
  $user="dai";
  $pass="tel10co";
  $db=mysql_connect($host,$user,$pass) or die ("Error durante la conexión a la base de datos");
  
  session_start();
  $dni=$_SESSION['propietario'];
  echo "<div id='parteizq'>";
  echo "Menú de propietario<br>";
  echo "Usuario: ".$dni."<br>";
  
  $sqls="SELECT `Estado` FROM `Propietario` WHERE `DNI`='".$dni."'";
  $results=mysql_db_query("Rest_74736108T",$sqls,$db);
  $arrays=mysql_fetch_row($results);
  
  if($arrays[0]=='activo'){
    $ba='baja';
	$msg="¿Seguro que quiere darse de baja?<br>Se darán de baja todos sus vehículos y se eliminarán aquellas pujas que hayan sido declaradas en estado de baja sobre estos vehículos. Podrá darse de alta en cualquier momento, pero tendrá que volver a declarar sus vehículos en estado de subasta. No podrá realizar consultas mientras esté en estado de baja.<br>";
	$valor=1;
    echo "<a href='altavehiculo.php'>Registrar un vehículo</a><br>";
    echo "<a href='vehicprop.php'>Consultar vehículos ofertados</a><br>";
    echo "<a href='menupropietario.php?ac=1'>Darse de baja</a><br>";
    echo "<a href='index.php'>Cerrar sesión</a><br><br>";}
  else{
    $ba='alta';
	$msg="¿Seguro que quiere volver a un estado activo?<br> Tendrá que volver a poner en subasta sus vehículos.<br>";
	$valor=2;
    echo "Registrar un vehículo<br>";
    echo "Consultar vehículos ofertados<br>";
    echo "<a href='menupropietario.php?ac=1'>Darse de alta</a><br>";
    echo "<a href='index.php'>Cerrar sesión</a><br><br>";
  }
  echo "</div>";
  echo "<div id='logo'><img src='Archivos/logo.jpg'></div>";
  echo "<div id='parteder'>";
    error_reporting(0);
    $ac=$_GET['ac'];
	echo "<br><br>";
	if($ac==1){
	  echo $msg;
	  echo "<a href='bajaltapro.php?vl=$valor'><input type='button' value='Aceptar'></a>";
	  echo "<a href='menupropietario.php'><input type='button' value='Cancelar'></a>";
	  }
	else{
	  echo "Bienvenido al menú de propietario.<br> Desde aquí podrá registrar vehículos para ponerlos en subasta, consultar el precio que adquieren sus vehículos al ser pujados y podrá dar de baja sus vehículos. Además, podrá darse de baja como propietario.<br>";}
  
  $v=$_GET['vl'];
  if($v==1){
    $msg="Vehículo añadido satisfactoriamente";}
  else{
	$msg="";}
  echo "<font color='red'>".$msg."</font><br>";
  echo "</div>";
?>
</div>

</body>
</html>
