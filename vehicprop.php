<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=ISO-8859-1">
<link rel= stylesheet type= "text/css" href= "Archivos/estilos.css">
<title>eGracar - Consulta del usuario</title>
<script src="Archivos/scripts.js" type="text/javascript" language="JavaScript"></script>
</head>

<body>
<div id="general">
<?php

  error_reporting(0);

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
  
  $sql="SELECT * FROM `Vehiculo` WHERE `Propietario`='".$dni."'";
  $result=mysql_db_query("Rest_74736108T",$sql,$db);
  $n=mysql_num_rows($result);
  $i=0;
  echo "<table id='tabla'> <thead><td>Matricula</td><td>Marca</td><td>Modelo</td><td>A�o</td><td>Kilometraje</td><td>";
  echo "Precio actual</td><td>Estado</td><td>Fecha l�mite</td></thead>";
  
  while($i<$n){
  $array=mysql_fetch_row($result);
  $fecha=date("d-m-Y",strtotime($array[8]));
  $sql2="SELECT `Dinero` FROM `Puja` WHERE `Vehiculo`='".$array[0]."' AND `Estado`='activo' ORDER BY `Dinero` DESC LIMIT 1";
  $result2=mysql_db_query("Rest_74736108T",$sql2,$db);
  $num=mysql_num_rows($result2);
  if ($num==0){
    $precio=$array[5];}
  else{
    $inter=mysql_fetch_row($result2);
	$precio=$inter[0];}
  if ($array[7]=='subasta' || $array[7]=='sin vender'){
    $estado='baja';
    $enlace="<a href='bajavehic.php?vl=".$estado."&matr=".$array[0]."'><input type='button' value='Dar de baja' onClick='return confirmar()'></a>";}
  elseif($array[7]=='baja'){
    $estado='subasta';
    $enlace="<a href='bajavehic.php?vl=".$estado."&matr=".$array[0]."'><input type='button' value='Subastar' onClick='return confirmar()'></a>";}
  else{
    $enlace="";}
  echo "<tr><td class='tb'>".$array[0]."</td><td class='tb'>".$array[1]."</td><td class='tb'>".$array[2]."</td><td class='tb'>".$array[3]."</td><td class='tb'>";
  echo $array[4]."</td><td class='tb'>".$precio."</td><td class='tb'>".$array[7]."</td><td class='tb'>".$fecha."</td>";
  echo "<td>".$enlace."</td></tr>";
  $i++;
  }
  echo "</table><br><br>";
  
  $v=$_GET['vl'];
  if($v==1){
    $msg="Veh�culo dado de baja";}
  elseif($v==2){
    $msg="Veh�culo en subasta nuevamente";}
  else{
	$msg="";}
  echo "<font color='red'>".$msg."</font><br>";
  
  echo "</div>";
?>
</div>
</body>
</html>
