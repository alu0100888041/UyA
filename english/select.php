<?php
include("conexion.php");

$con = mysqli_connect($host, $user, $pw) or die ("problemas al conectar server");

mysqli_select_db($con,$db) or die ("problemas al conectar base de datos");

$origen=$_POST["origen"];
$destino=$_POST["destino"];
$ida=$_POST["ida"];
$SQL = "select * from vuelos where origen= '$origen' and destino= '$destino' and ida= '$ida' ";
$registro = mysqli_query($con,$SQL) or die ("problemas en consulta: ". mysqli_error());

while($reg = mysqli_fetch_array($registro)){
	echo $reg['origen']."<br>";
	echo $reg['destino']."<br>";
	echo $reg['ida']."<br>";
}
?>