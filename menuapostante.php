<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=ISO-8859-1">
<link rel= stylesheet type= "text/css" href= "Archivos/estilos.css">
<title>eGracar - Men� de apostante</title>
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
  $dni=$_SESSION['apostante'];
  echo "<div id='parteizq'>";
  echo "Men� de apostante<br>";
  echo "Usuario: ".$dni."<br>";
  $sqls="SELECT `Estado` FROM `Apostante` WHERE `DNI`='".$dni."'";
  $results=mysql_db_query("Rest_74736108T",$sqls,$db);
  $arrays=mysql_fetch_row($results);
  
  if($arrays[0]=='activo'){
    $ba='baja';
	$msg="�Seguro que quiere darse de baja?<br>Se dar�n de baja todas las pujas realizadas y se eliminar�n aquellas pujas que hayan sido declaradas en estado de baja. Podr� darse de alta en cualquier momento, pero tendr� que volver a realizar sus pujas. No podr� consultar el estado de los veh�culos mientras est� en estado de baja.<br>";
	$valor=1;
    echo "<a href='puja.php'>Pujar por un veh�culo</a><br>";
    echo "<a href='consulta.php'>Consultar/Anular tus pujas</a><br>";
    echo "<a href='menuapostante.php?ac=1'>Darse de baja</a><br>";
    echo "<a href='index.php'>Cerrar sesi�n</a>";}
  else{
    $ba='alta';
	$msg="�Seguro que quiere volver a un estado activo?<br> Tendr� que volver a realizar todas sus pujas.<br>";
	$valor=2;
    echo "Pujar por un veh�culo<br>";
    echo "Consultar/Anular tus pujas<br>";
    echo "<a href='menuapostante.php?ac=1'>Darse de alta</a><br>";
    echo "<a href='index.php'>Cerrar sesi�n</a>";}
	echo "</div>";
	echo "<div id='logo'><img src='Archivos/logo.jpg'></div>";
	echo "<div id='parteder'>";
	error_reporting(0);
	$ac=$_GET['ac'];
	if ($ac!=1){
	  echo "Bienvenido al men� de apostante.<br> Desde aqu� podr� realizar sus pujas por los veh�culos ofertados, consultar el estado de sus pujas ya realizadas as� como la opci�n de anularlas y podr� darse de baja o alta en el servicio de subasta de veh�culos.";}
	else{
	  echo $msg;
	  echo "<a href='bajalta.php?vl=$valor'><input type='button' value='Aceptar'></a>";
	  echo "<a href='menuapostante.php'><input type='button' value='Cancelar'></a></div>";}
    ?>

</div>

</body>
</html>
