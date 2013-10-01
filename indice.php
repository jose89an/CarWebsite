<?php
  $dni=$_POST["dni"];
  $password=$_POST["password"];
  $usuario=$_POST["usuario"];
  
  $host="bios.ugr.es";
  $user="dai";
  $pass="tel10co";
  $db=mysql_connect($host,$user,$pass) or die ("Error durante la conexión a la base de datos");
  
  if ($usuario=="apostante"){
    $sql="SELECT * FROM `Apostante` WHERE `dni`='".$dni."'";
  }
  if ($usuario=="propietario"){
    $sql="SELECT * FROM `Propietario` WHERE `dni`='".$dni."'";
  }
  $result=mysql_db_query("Rest_74736108T",$sql,$db);
  $array=mysql_fetch_row($result);
  $length=mysql_num_rows($result);
  mysql_close();
  
  if ($password!=$array[4] || $length==0){
    if ($length==0){
	  $v=1;}
	elseif ($password!=$array[4]){
	  $v=2;}
	header("location: index.php?var=$v");
	exit;
	}

  if ($dni=="74736108T"){
  //En este caso se ejecutará la sesión de administrador
  session_start();
  $_SESSION['administrador']=$dni;
  header("location: menuadmin.php");
  exit;
  }
  
  
  if ($usuario=="apostante"){
  	session_start();
	$_SESSION['apostante']=$dni;
    header("location: menuapostante.php");
	exit;
	}
  else{
    session_start();
	$_SESSION['propietario']=$dni;
    header("location: menupropietario.php");
	exit;
	}
?>