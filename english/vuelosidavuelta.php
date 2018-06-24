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
    <html lang="en">
	<meta charset="UTF-8">
	<title>Flights</title>
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
	        <li><a href="index.php">Home</a></li>
	        <li  class="active"><a href="vuelos.php">Flights</a></li>
	        <li><a href="hoteles.php">Hotels</a></li>
	        <li><a href="contacto.php">Contact</a></li>
	      </ul>
	    </div>
	</nav>
</div>

<nav>
    <div class="nav-wrapper margenbread">
      <div class="col s12">
        <a href="#!" class="breadcrumb margenbreadtext">Flights</a>
        <a href="#!" class="breadcrumb">Round trip</a>
      </div>
    </div>
</nav>


<div class="container">
	<div class="row margentabs">
	    <div class="col s12">
	      <ul class="tabs">
	      	<li class="tab col s3"><a class="active" href="#idavuelta">Round trip</a></li>
	      </ul>
	    </div>
	<form action="<?php echo HTMLSPECIALCHARS($_SERVER['PHP_SELF'])?>" method="post" name="frm">
			<div id="idavuelta" class="col s12">
				<div class="row">
					<div class="col s12">
					    <div class="row">
					        <div class="input-field col s3">
					        	<select required name="origen">
					        		<option value="" disabled selected>From</option>
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
					        		<option value="" disabled selected>To</option>
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
					          <label for="ida">Departure</label>
					        </div>
					        <div class="input-field col s2">
					          <input type="text" id="vuelta" required name="vuelta" class="datepicker">
					          <label for="vuelta">Return</label>
					        </div>
					        <div class="input-field col s2">
					          <input type="text" id="pasajeros" required name="pasajeros" class="autocomplete">
					          <label for="pasajeros">Number of passengers</label>
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

			<button class="btn waves-effect waves-light col s2" type="submit" name="submit">Search
		    <i class="material-icons right">search</i>
			</button>
		    <button class="btn waves-effect waves-light col s3 offset-s1" type="reset" name="action">Reset
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
		echo "<h1>Going</h1> <br>";
		$ida2=0;

?>

<table class="centered highlight bordered">
	<thead class="row">
		<tr>
			<th class="col s2">From</th>
			<th class="col s2">To</th>
			<th class="col s2">Departure</th>
			<th class="col s2">Arrival</th>
			<th class="col s2">Airline</th>
			<th class="col s1">Price</th>
			<th class="col s1">Pick a flight</th>
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
			echo "<p class=estiloError>The flight you are trying to get requires overlay, get a flight that goes either to Tenerife or Gran Canaria and then a flight from there to your destination.</p>";


?>

</table>
</div>

<div class="container">

<?php
// if (isset($_POST['submit'])) {
echo "<h1>Return</h1> <br>";
$vuelta2=0;
?>

<table class="centered highlight bordered">
	<thead class="row">
		<tr>
			<th class="col s2">From</th>
			<th class="col s2">To</th>
			<th class="col s2">Departure</th>
			<th class="col s2">Arrival</th>
			<th class="col s2">Airline</th>
			<th class="col s1">Price</th>
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
			echo "<p class=estiloError>The flight you are trying to get requires overlay, get a flight that goes either to Tenerife or Gran Canaria and then a flight from there to your destination.</p>";
?>
</table>
<br><br>

<?php

if($ida2!=0 && $vuelta2!=0){
?>
	<div class="row">
		<button class="btn waves-effect waves-light col s2" type="submit" name="submit">Continue
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
	<span class=estiloError> You must return after leaving right?, change your return date.</span>
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
				<h1 class="contactanos">Contact us</h1>
			
		</div>
			
		<div class="row">
				<p class="col s12">If you have any doubt regarding your purchase, booking or about the web, you can contact us via:</p>
		</div>
			
		<div class="row">
			<ul><img class="col s1 info" src="./multimedia/contacto.png" alt="telefono"> <p class="col s6">Phone: +34 922 1658 7235</p> </ul>
			</div>
			
		<div class="row">
			<ul> <img class="col s1 info" src="./multimedia/chat.png" alt="chat"> <p class="col s6">Chat</p></ul>
		</div>
		
		<div class="row">
			<ul><img class="col s1 info" src="./multimedia/facebook.png" alt="facebook"> <p class="col s6">Facebook: <a class="color" href=" www.facebook.com/VuelosTop.ES">  facebook.com/VuelosTop.ES </a></p> </ul>
		</div>

		<div class="">
			<a href="../vuelos.php">
			<img src="multimedia/español.jpg" title="Español" class="bandera" alt="español"></a>
			<a href="vuelos.php">
			<img src="multimedia/ingles.png" title="Inglés" class="bandera" alt="inglés"></a>
		</div>
	</div>


    <!-- POLITICAS -->
    <div class="footer-copyright">
    	<div class="container right-align">
		 Privacy policy &nbsp; © 2018 TripFinder Inc
		</div>
	</div>
</footer>

<script>
$(function(){
	$('.datepicker').pickadate({
		monthsFull: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
		monthsShort: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
		weekdaysFull: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
		weekdaysShort: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
		selectMonths: true,
		selectYears: 100, // Puedes cambiarlo para mostrar más o menos años
		today: 'Today',
		clear: 'Reset',
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