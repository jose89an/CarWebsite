<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=ISO-8859-1">
<link rel= stylesheet type= "text/css" href= "Archivos/estilos.css">
<title>eGracar - Men� de propietario</title>
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
  $dni=$_SESSION['propietario'];
  echo "<div id='parteizq'>";
  echo "Men� de propietario<br>";
  echo "Usuario: ".$dni."<br>";
  
  $sqls="SELECT `Estado` FROM `Propietario` WHERE `DNI`='".$dni."'";
  $results=mysql_db_query("Rest_74736108T",$sqls,$db);
  $arrays=mysql_fetch_row($results);
  
  if($arrays[0]=='activo'){
    $ba='baja';
	$msg="�Seguro que quiere darse de baja?<br>Se dar�n de baja todos sus veh�culos y se eliminar�n aquellas pujas que hayan sido declaradas en estado de baja sobre estos veh�culos. Podr� darse de alta en cualquier momento, pero tendr� que volver a declarar sus veh�culos en estado de subasta. No podr� realizar consultas mientras est� en estado de baja.<br>";
	$valor=1;
    echo "<a href='altavehiculo.php'>Registrar un veh�culo</a><br>";
    echo "<a href='vehicprop.php'>Consultar veh�culos ofertados</a><br>";
    echo "<a href='menupropietario.php?ac=1'>Darse de baja</a><br>";
    echo "<a href='index.php'>Cerrar sesi�n</a><br><br>";}
  else{
    $ba='alta';
	$msg="�Seguro que quiere volver a un estado activo?<br> Tendr� que volver a poner en subasta sus veh�culos.<br>";
	$valor=2;
    echo "Registrar un veh�culo<br>";
    echo "Consultar veh�culos ofertados<br>";
    echo "<a href='menupropietario.php?ac=1'>Darse de alta</a><br>";
    echo "<a href='index.php'>Cerrar sesi�n</a><br><br>";
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
	  echo "Bienvenido al men� de propietario.<br> Desde aqu� podr� registrar veh�culos para ponerlos en subasta, consultar el precio que adquieren sus veh�culos al ser pujados y podr� dar de baja sus veh�culos. Adem�s, podr� darse de baja como propietario.<br>";}
  
  $v=$_GET['vl'];
  if($v==1){
    $msg="Veh�culo a�adido satisfactoriamente";}
  else{
	$msg="";}
  echo "<font color='red'>".$msg."</font><br>";
  echo "</div>";
?>
</div>

</body>
</html>
