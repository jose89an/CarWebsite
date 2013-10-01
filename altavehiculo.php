<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=ISO-8859-1">
<link rel= stylesheet type= "text/css" href= "Archivos/estilos.css">
<title>eGracar - Registro de nuevo vehículo</title>
<script src="Archivos/scripts.js" type="text/javascript" language="JavaScript"></script>

</head>

<body>

<div id="general">
  <?php 
  error_reporting(0);

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
  echo "<form name='altavehic' action='creavehiculo.php' method='post' onSubmit='return comprobarvehiculo(this)'>";
  
  ?>
  <div id='nuevov'>
  Matrícula:
  <input type="text" name="matricula" class="textbox2"><br>
  Marca:
  <input type="text" name="marca" class="textbox2"><br>
  Modelo:
  <input type="text" name="modelo" class="textbox2"><br>
  Año:
  <input type="text" name="anyo" class="textbox2"><br>
  Kilometraje:
  <input type="text" name="kilometraje" class="textbox2"><br>
  Precio de salida:
  <input type="text" name="precio" class="textbox2"><br>
  Fecha límite para pujar:
  <select name="dialim">
  <?php 
    $i=1;
    while($i<=31){
	  echo "<option value=$i>".$i."</option>";
	  $i++;
	} ?>
  </select>
	
  <select name="meslim">
    <option value=01>Enero</option>
    <option value=02>Febrero</option>
    <option value=03>Marzo</option>
    <option value=04>Abril</option>
    <option value=05>Mayo</option>
    <option value=06>Junio</option>
    <option value=07>Julio</option>
    <option value=08>Agosto</option>
    <option value=09>Septiembre</option>
    <option value=10>Octubre</option>
    <option value=11>Noviembre</option>
    <option value=12>Diciembre</option>
  </select>
  
  <select name="anyolim">
  <?php 
    $i=2010;
    while($i<=2014){
	  echo "<option value=$i>".$i."</option>";
	  $i++;
	} ?>
  </select>
	<br>
  * <i>Todos los campos son obligatorios</i><br>
  <input type="submit" name="enviar" value="Aceptar datos">
  <input type="reset" value="Restablecer campos">
  <?php echo "<a href='menupropietario.php'><input type='button' value='Volver'></a><br>"; ?>
  </form>
  </div>
  
    <?php
    error_reporting(0);
    $v=$_GET['vl'];
	if($v==1){
	  $msg="Formato de fecha incorrecto";}
	elseif($v==2){
	  $msg="Ya hay un vehículo añadido con esta matrícula";}
	else{
	  $msg="";}
	echo "<font color='red'>".$msg."</font><br>";
	echo "</div>";
  ?>
  
</div>

</body>
</html>
