<?php
	session_start();
	include 'conexion.php';
	$query1 = mysqli_query($con,"SELECT id, origen FROM binter GROUP BY origen ORDER BY origen ASC");
	$query2 = mysqli_query($con,"SELECT id, destino FROM binter GROUP BY destino ORDER BY destino ASC");
	$query3 = mysqli_query($con,"SELECT id, origen FROM binter GROUP BY origen");
	$query4 = mysqli_query($con,"SELECT id, destino FROM binter GROUP BY destino");


	// validando radios
	$grupo1 = 0;
	if(isset($_POST['grupo1'])){
		$grupo1 = $_POST['grupo1'];
	}

	$grupo2 = 0;
	if(isset($_POST['grupo2'])){
		$grupo2 = $_POST['grupo2'];
	}

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
        <a href="#!" class="breadcrumb">Solo ida</a>
      </div>
    </div>
</nav>


<div class="container">
	<div class="row margentabs">
	    <div class="col s12">
	      <ul class="tabs">
	        <li class="tab col s3"><a href="#ida3">Solo ida</a></li>
	      </ul>
	    </div>
	<form action="<?php echo HTMLSPECIALCHARS($_SERVER['PHP_SELF'])?>" method="post" name="frm">

			<div id="ida3" class="col s12">
				<div class="row">
					<div class="col s12">
					    <div class="row">
					        <div class="input-field col s3">
					        	<select required name="origen">
					        		<option value="" disabled selected>Origen</option>
									<?php while($datos = mysqli_fetch_array($query3)){
									?>
									     <option value="<?php echo $datos['origen']?>"> <?php echo $datos['origen']?> </option>
									<?php
										}
									?>
    							</select>
					        </div>
					        <div class="input-field col s3">
					        	<select required name="destino">
					        		<option value="" disabled selected>Destino</option>
									<?php while($datos2 = mysqli_fetch_array($query4)){
									?>
									     <option value="<?php echo $datos2['destino']?>"> <?php echo $datos2['destino']?> </option>
									<?php
										}
									?>
					        	</select>
					        </div>
					        <div class="input-field col s2">
					          <input type="text" id="ida" required class="datepicker" name="ida">
					          <label for="ida">Ida</label>
					        </div>
					        <div class="input-field col s2">
					          <input disabled type="text" id="disabled" class="validate">
					          <label for="disabled">Vuelta</label>
					        </div>
					        <div class="input-field col s2">
					          <input type="text" id="pasajeros2" class="autocomplete" required name="pasajeros">
					          <label for="pasajeros2">Número de pasajeros</label>
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
$pasajeros = isset($_POST['pasajeros']) ? $_POST['pasajeros'] : null ;


	$_SESSION['origen'] = $origen;
	$_SESSION['destino'] = $destino;
	$_SESSION['ida'] = $ida;
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

<form action="compra2.php" method="POST">
<div class="container">
<?php
if (isset($_POST['submit'])) {
echo "<h1>IDA</h1> <br>";

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
$ida2=0;
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
<br><br>
<?php

if($ida2!=0){
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
	}
?>
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