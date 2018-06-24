<?php
	session_start();
	include 'conexion.php';
	$query1 = mysqli_query($con,"SELECT id, origen FROM binter GROUP BY origen ORDER BY origen ASC");
	$query2 = mysqli_query($con,"SELECT id, destino FROM binter GROUP BY destino ORDER BY destino ASC");
	$query3 = mysqli_query($con,"SELECT id, origen FROM binter GROUP BY origen");
	$query4 = mysqli_query($con,"SELECT id, destino FROM binter GROUP BY destino");

?>



<!DOCTYPE html>
<html>
<head>
    <html lang="es">
	<meta charset="UTF-8">
	<title>Vuelos</title>
	<link rel="stylesheet" type="text/css" href="css/vuelos.css">
	<link rel="stylesheet" type="text/css" href="css/materialize.min.css">
	<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/css/materialize.min.css">-->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<script type = "text/javascript" src = "https://code.jquery.com/jquery-3.3.1.min.js"></script>           
    <script src = "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js"></script> 
	<script src="js/irarriba.js"></script>

</head>
<body>

<div class="navbar-fixed">
	<nav>
	    <div class="nav-wrapper">
	      <a href="index.php" class="brand-logo">TripFinder</a>
	      <ul id="nav-mobile" class="right hide-on-med-and-down margencabeceras">
	        <li><a href="index.php">Inicio</a></li>
	        <li  class="active"><a href="vuelos.php">Vuelos</a></li>
	        <li><a href="hoteles.php">Hoteles</a></li>
	        <li><a href="contacto.php">Contacto</a></li>
	      </ul>
	    </div>
	</nav>
</div>

<nav>
    <div class="nav-wrapper margenbread">
      <div class="col s12">
        <a href="#!" class="breadcrumb margenbreadtext">Vuelos</a>
        <a href="#!" class="breadcrumb">Ida y Vuelta</a>
      </div>
    </div>
</nav>


<div class="container">
	<div class="row margentabs">
	    <div class="col s12">
	      <ul class="tabs">
	      	<li class="tab col s3"><a class="active" href="#idavuelta">Ida y vuelta</a></li>
	      </ul>
	    </div>
	<form action="<?php echo HTMLSPECIALCHARS($_SERVER['PHP_SELF'])?>" method="post" name="frm">
			<div id="idavuelta" class="col s12">
				<div class="row">
					<div class="col s12">
					    <div class="row">
					        <div class="input-field col s3">
					        	<select required name="origen">
					        		<option value="" disabled selected>Origen</option>
									<?php while($datos = mysqli_fetch_array($query1)){
									?>
									     <option value="<?php echo $datos['origen']?>"> <?php echo $datos['origen']?> </option>
									<?php
										}
									?>
    							</select>
					          <!-- <input type="text" name="origen" id="origen" class="autocomplete">
					          <label for="origen">Origen</label> -->
					        </div>
					        <div class="input-field col s3">
					        	<select required name="destino">
					        		<option value="" disabled selected>Destino</option>
									<?php while($datos2 = mysqli_fetch_array($query2)){
									?>
									     <option value="<?php echo $datos2['destino']?>"> <?php echo $datos2['destino']?> </option>
									<?php
										}
									?>
					        	</select>

					          <!-- <input type="text" id="destino" name="destino" class="autocomplete">
					          <label for="destino">Destino</label> -->
					        </div>
					        <div class="input-field col s2">
					          <input type="text" id="ida" required name="ida" class="datepicker">
					          <label for="ida">Ida</label>
					        </div>
					        <div class="input-field col s2">
					          <input type="text" id="vuelta" required name="vuelta" class="datepicker">
					          <label for="vuelta">Vuelta</label>
					        </div>
					        <div class="input-field col s2">
					          <input type="text" id="pasajeros" required name="pasajeros" class="autocomplete">
					          <label for="pasajeros">Número de pasajeros</label>
					        </div>
					    </div>
					</div>
				</div>
			</div>
		</div>

<?php
$origen = isset($_POST['origen']) ? $_POST['origen'] : null ;
$destino = isset($_POST['destino']) ? $_POST['destino'] : null ;
$ida = isset($_POST['ida']) ? $_POST['ida'] : null ;
$vuelta = isset($_POST['vuelta']) ? $_POST['vuelta'] : null ;
$pasajeros = isset($_POST['pasajeros']) ? $_POST['pasajeros'] : null ;


	$_SESSION['origen'] = $origen;
	$_SESSION['destino'] = $destino;
	$_SESSION['ida'] = $ida;
	$_SESSION['vuelta'] = $vuelta;
	$_SESSION['pasajeros'] = $pasajeros;

?>

			<button class="btn waves-effect waves-light col s2" type="submit" name="submit">Buscar
		    <i class="material-icons right">search</i>
			</button>
		    <button class="btn waves-effect waves-light col s3 offset-s1" type="reset" name="action">Refrescar valores
		    <i class="material-icons right">refresh</i>
		  	</button>
		</div>
	</form>
<br><br>

<form action="compra.php" method="POST">
<div class="container">
<?php



if (isset($_POST['submit'])) {
		if(strtotime($ida)<strtotime($vuelta)){
		echo "<h1>IDA</h1> <br>";
		$ida2=0;

?>

<table class="centered highlight bordered">
	<thead class="row">
		<tr>
			<th class="col s2">Origen</th>
			<th class="col s2">Destino</th>
			<th class="col s2">Salida</th>
			<th class="col s2">Llegada</th>
			<th class="col s2">Aerolínea</th>
			<th class="col s1">Precio</th>
			<th class="col s1">Elegir vuelo</th>
		</tr>
	</thead>
<!-- IDA BINTER -->
<?php

	include("conexion.php");

	mysqli_select_db($con,$db) or die ("problemas al conectar base de datos");

		$origen=$_POST["origen"];
		$destino=$_POST["destino"];
		$ida=$_POST["ida"];
		$SQL1 = "SELECT * FROM binter WHERE origen= '$origen' AND destino='$destino'";
		$registro1 = mysqli_query($con,$SQL1) or die ("problemas en consulta: ". mysqli_error());

		while ($reg = mysqli_fetch_array($registro1)) {
?>
	<tbody class="row">
		<tr>
			<td class="col s2"><?php echo $reg['origen']?></td>
			<td class="col s2"><?php echo $reg['destino']?></td>
			<td class="col s2"><?php echo $reg['salida']?></td>
			<td class="col s2"><?php echo $reg['llegada']?></td>
			<td class="col s2"><?php echo $reg['aerolinea']?></td>
			<td class="col s1"><?php echo $reg['precio']?>€</td>
			<td class="col s1"><input type="radio" required value="<?php echo $reg['id']?>" name="grupo1" id="<?php echo $reg['id']?>"><label for="<?php echo $reg['id'] ?>"></label></td>
		</tr>
		</tbody>
<?php
	$ida2=$ida2+1;
		}
		
		if($ida2==0)
			echo "<p class=estiloError>Está intentando sacar un vuelo que requiere escalas, saque primero uno que pase por Tenerife o Gran Canaria.</p>";


?>

</table>
</div>

<div class="container">

<?php
// if (isset($_POST['submit'])) {
echo "<h1>VUELTA</h1> <br>";
$vuelta2=0;
?>

<table class="centered highlight bordered">
	<thead class="row">
		<tr>
			<th class="col s2">Origen</th>
			<th class="col s2">Destino</th>
			<th class="col s2">Salida</th>
			<th class="col s2">Llegada</th>
			<th class="col s2">Aerolínea</th>
			<th class="col s1">Precio</th>
			<th class="col s1"><?php echo "Elegir vuelo"?></th>
		</tr>
	</thead>
<!-- VUELTA BINTER -->
<?php
	include("conexion.php");

	mysqli_select_db($con,$db) or die ("problemas al conectar base de datos");

		$SQL3 = "SELECT * FROM binter WHERE origen= '$destino' AND destino='$origen'";
		$registro3 = mysqli_query($con,$SQL3) or die ("problemas en consulta: ". mysqli_error());

		while ($reg3 = mysqli_fetch_array($registro3)) {
?>
	<tbody class="row">
		<tr>
			<td class="col s2"><?php echo $reg3['origen']?></td>
			<td class="col s2"><?php echo $reg3['destino']?></td>
			<td class="col s2"><?php echo $reg3['salida']?></td>
			<td class="col s2"><?php echo $reg3['llegada']?></td>
			<td class="col s2"><?php echo $reg3['aerolinea']?></td>
			<td class="col s1"><?php echo $reg3['precio']?>€</td>
			<td class="col s1"><input type="radio" required value="<?php echo $reg3['id']?>" name="grupo2" id="<?php echo $reg3['id']?>"><label for="<?php echo $reg3['id']?>"></label></td>
		</tr>
	</tbody>
<?php
	$vuelta2=$vuelta2+1;
		}
		if($vuelta2==0)
			echo "<p class=estiloError>Está intentando sacar un vuelo que requiere escalas, saque primero uno que pase por Tenerife o Gran Canaria.</p>";
?>
</table>
<br><br>

<?php

if($ida2!=0 && $vuelta2!=0){
?>
	<div class="row">
		<button class="btn waves-effect waves-light col s2" type="submit" name="submit">Continuar
	    <i class="material-icons right">arrow_forward</i>
		</button>
	</div>
<?php
	}
?>
	</form>
</div>

<?php

		}else{
?>
	<span class=estiloError> LA FECHA DE VUELTA DEBE SER MAYOR QUE LA DE IDA</span>
	<br><br>
<?php
}	
	} 
?>

<br>

</div>




<footer class="page-footer foo">


	<div class="volverarriba">
		<a href="#" id="volverarriba" title="Volver hacia arriba"></a>
	</div>


	<div class="container">
		<div class="row col s10">
				<h1 class="contactanos">Contáctanos</h1>
			
		</div>
			
		<div class="row">
				<p class="col s12">Si tienes cualquier duda sobre tu compra, reserva o la web, puedes contactar con nosotros como prefieras:</p>
		</div>
			
		<div class="row">
			<ul><img class="col s1 info" src="./multimedia/contacto.png" alt="telefono"> <p class="col s6">Teléfono: +34 922 1658 7235</p> </ul>
			</div>
			
		<div class="row">
			<ul> <img class="col s1 info" src="./multimedia/chat.png" alt="chat"> <p class="col s6">Chat</p></ul>
		</div>
		
		<div class="row">
			<ul><img class="col s1 info" src="./multimedia/facebook.png" alt="facebook"> <p class="col s6">Facebook: <a class="color" href=" www.facebook.com/VuelosTop.ES">  facebook.com/VuelosTop.ES </a></p> </ul>
		</div>

		<div class="">
			<a href="vuelos.php">
			<img src="multimedia/español.jpg" title="Español" class="bandera" alt="español"></a>
			<a href="english/vuelos.php">
			<img src="multimedia/ingles.png" title="Inglés" class="bandera" alt="inglés"></a>
		</div>
	</div>


    <!-- POLITICAS -->
    <div class="footer-copyright">
    	<div class="container right-align">
		 Política de privacidad &nbsp; © 2018 TripFinder Inc
		</div>
	</div>
</footer>

<script>
$(function(){
	$('.datepicker').pickadate({
		monthsFull: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
		monthsShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
		weekdaysFull: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
		weekdaysShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'],
		selectMonths: true,
		selectYears: 100, // Puedes cambiarlo para mostrar más o menos años
		today: 'Hoy',
		clear: 'Limpiar',
		close: 'Ok',
		labelMonthNext: 'Siguiente mes',
		labelMonthPrev: 'Mes anterior',
		labelMonthSelect: 'Selecciona un mes',
		labelYearSelect: 'Selecciona un año',
		format:'yyyy/mm/dd'
		
	});
});
</script>

<script type="text/javascript">
	$(document).ready(function(){
		$('select').material_select();
	});
</script>

</body>
</html>