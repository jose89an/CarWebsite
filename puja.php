<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=ISO-8859-1">
<link rel= stylesheet type= "text/css" href= "Archivos/estilos.css">
<title>eGracar - Puja por veh�culos disponibles</title>
</head>

<body>

<div id="general">
<?php
  session_start();
  $dni=$_SESSION['apostante'];
  echo "<div id='parteizq'>";
  echo "Men� de apostante<br>";
  echo "Usuario: ".$dni."<br>";

  $host="bios.ugr.es";
  $user="dai";
  $pass="tel10co";
  $db=mysql_connect($host,$user,$pass) or die ("Error durante la conexi�n a la base de datos");
  
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
  $sql="SELECT * FROM `Vehiculo` WHERE `Estado`='subasta'";
  $result=mysql_db_query("Rest_74736108T",$sql,$db);
  $n=mysql_num_rows($result);
  $i=0;
  echo "<table id='tabla'> <thead><td>Matricula</td><td>Marca</td><td>Modelo</td><td>A�o</td><td>Kilometraje</td><td>";
  echo "Precio actual</td><td>Fecha l�mite</td></thead>";
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
  if(time() < strtotime($array[8])){
    //Solo se muestran los veh�culos si a�n no se ha superado la fecha l�mite
    echo "<tr><td class='tb'>".$array[0]."</td><td class='tb'>".$array[1]."</td><td class='tb'>".$array[2]."</td><td class='tb'>".$array[3]."</td><td class='tb'>";
    echo $array[4]."</td><td class='tb'>".$precio."</td><td class='tb'>".$fecha."</td>";
    echo "<td><form name='fpuja' method='post' action='nuevapuja.php?matr=".$array[0]."'>";
    echo "<input type='text' name='cantidad' size='10'><input type='submit' value='Pujar'></form></td></tr>";
  }
  $i++;
  }
  echo "</table>"

?>

<br>
Aqu� puede hacer su puja. La cantidad debe superar el precio actual del veh�culo.<br><br>


<?php

error_reporting(0);
    $men=$_GET['msg'];
	if($men==1){
	  $msg="No se encontr� ning�n veh�culo en subasta con esta matr�cula";}
	elseif($men==2){
	  $msg="Puja creada";}
	elseif($men==3){
	  $msg="Debes insertar m�s dinero para realizar la puja";}
	elseif($men==4){
	  $msg="Puja actualizada";}
	else{
	  $msg="";}
	echo "<font color='red'>".$msg."</font><br>";

echo "</div>";
 ?>

</div>

</body>
</html>
