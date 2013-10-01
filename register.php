<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=ISO-8859-1">
<link rel= stylesheet type= "text/css" href= "Archivos/estilos.css">
<title>eGracar - Registro de nuevo usuario</title>
<script src="Archivos/scripts.js" type="text/javascript" language="JavaScript"></script>

</head>

<body>

<div id="general">
<div id='logoi'><img src='Archivos/logo.jpg'></div>;
<div id="index">
  <form name="registrarse" action="registro.php" method="post" onSubmit="return comprobar(this)">
  DNI:
  <input type="text" name="dni" class="textbox2"><br>
  Password:
  <input type="password" name="password" class="textbox2"><br>
  Repita su password:
  <input type="password" name="password2" class="textbox2"><br>
  Propietario:
  <input type="radio" name="usuario" value="propietario">
  Apostante:
  <input type="radio" name="usuario" value="apostante"><br>
  Nombre:
  <input type="text" name="nombre" class="textbox2"><br>
  E-mail:
  <input type="text" name="email" class="textbox2"><br>
  Teléfono:
  <input type="text" name="telefono" class="textbox2"><br>
  * <i>Todos los campos son obligatorios</i><br>
  <input type="submit" name="enviar" value="Aceptar datos">
  <input type="reset" value="Restablecer campos">
  <a href="index.php"><input type="button" value="Volver"></a><br>
  </form>
  
    <?php
    error_reporting(0);
    $v=$_GET['var'];
	if($v==1){
	  $msg="El DNI introducido ya estaba registrado anteriormente";}
	else{
	  $msg="";}
	echo "<font color='red'>".$msg."</font><br>";
  ?>
  
</div>
</div>

</body>
</html>
