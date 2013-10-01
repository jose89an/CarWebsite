<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=ISO-8859-1">
<link rel= stylesheet type= "text/css" href= "Archivos/estilos.css">
<title>eGracar - Consulta de pujas realizadas</title>
<script src="Archivos/scripts.js" type="text/javascript" language="JavaScript"></script>
</head>

<body>

<div id="general">
<?php
  session_start();
  $dni=$_SESSION['apostante'];
  
  $host="bios.ugr.es";
  $user="dai";
  $pass="tel10co";
  $db=mysql_connect($host,$user,$pass) or die ("Error durante la conexi�n a la base de datos");
  
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
  $sql="SELECT * FROM `Puja` WHERE `Apostante`='".$dni."'";
  $result=mysql_db_query("Rest_74736108T",$sql,$db);
  $n=mysql_num_rows($result);
  $i=0;
  echo "<table id='tabla'> <thead><td>Matricula veh�culo</td><td>Cantidad ofrecida</td><td>Precio actual</td><td>Estado veh�culo</td><td>Estado tu puja</td></thead>";
  while($i<$n){
  $array=mysql_fetch_row($result);
  
  $sql2="SELECT `Estado` FROM `Vehiculo` WHERE `Matricula`='".$array[0]."'";
  $result2=mysql_db_query("Rest_74736108T",$sql2,$db);
  $state=mysql_fetch_row($result2);
  
  $sqlh="SELECT `Dinero` FROM `Puja` WHERE `Vehiculo`='".$array[0]."' AND `Estado`='activo' ORDER BY `Dinero` DESC LIMIT 1";
  $resulth=mysql_db_query("Rest_74736108T",$sqlh,$db);
  $nh=mysql_num_rows($resulth);
  if ($nh==0){
    $sqlq="SELECT Precio_Salida FROM `Vehiculo` WHERE `Matricula`='".$array[0]."'";
	$resultq=mysql_db_query("Rest_74736108T",$sqlq,$db);
    $inter=mysql_fetch_row($resultq);
    $precio=$inter[0];}
  else{
    $inter=mysql_fetch_row($resulth);
	$precio=$inter[0];}
  
  echo "<tr><td class='tb'>".$array[0]."</td><td class='tb'>".$array[2]."</td><td class='tb'>".$precio."</td><td class='tb'>".$state[0]."</td><td class='tb'>".$array[3]."</td>";
  if ($array[3]=='activo'){
    $boton="<a href='anularpuja.php?matr=".$array[0]."'><input type='button' value='Anular' onClick='return confirmar()'></a>";}
  else{
    $boton="";}
  echo "<td>".$boton."</td></tr>";
  $i++;
  }
  echo "</table>"

?>

<br><br>

<?php

error_reporting(0);
    $men=$_GET['msg'];
	if($men==1){
	  $msg="No se encontr� ning�n veh�culo con esta matr�cula por el que hayas pujado";}
	elseif($men==2){
	  $msg="Puja eliminada";}
	else{
	  $msg="";}
	echo "<font color='red'>".$msg."</font><br>";

echo "</div>"; ?>

</div>

</body>
</html>
