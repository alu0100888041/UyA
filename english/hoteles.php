<?php
session_start();
	include 'conexion.php';
	$query1 = mysqli_query($con,"SELECT id, isla FROM hoteles GROUP BY isla ORDER BY isla ASC");
?>


<!DOCTYPE html>
<html>
<head>
    <html lang="en">
	<meta charset="UTF-8">
	<title>Hotels</title>
	<link rel="stylesheet" type="text/css" href="css/hoteles.css">
	<link rel="stylesheet" type="text/css" href="css/materialize.min.css">
	<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/css/materialize.min.css">-->
	<script type = "text/javascript" src = "https://code.jquery.com/jquery-3.3.1.min.js"></script>           
    <script src = "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js"></script> 
	<script src="js/irarriba.js"></script>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/nouislider.min.css">
	<script type="text/javascript" href="js/nouislider.min.js"></script>
</head>
<body>

<div class="navbar-fixed">
	<nav>
	    <div class="nav-wrapper">
	      <a href="index.php" class="brand-logo">TripFinder</a>
	      <ul id="nav-mobile" class="right hide-on-med-and-down margencabeceras">
	        <li><a href="index.php">Home</a></li>
	        <li><a href="vuelos.php">Flights</a></li>
	        <li class="active"><a href="hoteles.php">Hotels</a></li>
	        <li><a href="contacto.php">Contact</a></li>
	      </ul>
	    </div>
	</nav>
</div>

<nav>
    <div class="nav-wrapper margenbread">
      <div class="col s12">
        <a href="#!" class="breadcrumb margenbreadtext">Hotels</a>
      </div>
    </div>
</nav>

<div class="container">
	<form action="<?php echo HTMLSPECIALCHARS($_SERVER['PHP_SELF'])?>" method="post" name="frm" class="margenform">
				<div class="row">
			        <div class="input-field col s3">
			        	<select name="isla" required id="isla">
			        		<option value="" disabled selected>Island</option>
			        		<?php while($datos = mysqli_fetch_array($query1)){
							?>
						     <option value="<?php echo $datos['isla']?>"> <?php echo $datos['isla']?> </option>
							<?php
								}
							?>
						</select>
			        </div>
			        <div class="input-field col s3">
			          <input type="text" name="entrada" required id="entrada" class="datepicker">
			          <label for="entrada">Check-in</label>
			        </div>
			        <div class="input-field col s3">
			          <input type="text" id="salida" name="salida" required class="datepicker">
			          <label for="salida">Check-out</label>
			        </div>
			        <div class="input-field col s3">
			          <input type="number" id="huespedes" name="huespedes" required class="autocomplete">
			          <label for="huespedes">Number of people</label>
			        </div>
				</div>
				<div class="row">
					<div class="input-field col s4">
					    <select id="habitaciones" required name="habitaciones">
					      <option value="1">1 room</option>
					      <option value="2">2 rooms</option>
					      <option value="3">3 rooms</option>
					      <option value="4">4 rooms</option>
					      <option value="5">5 rooms</option>
					      <option value="6">6 rooms</option>
					      <option value="7">7 rooms</option>
					      <option value="8">8 rooms</option>
					      <option value="9">9 rooms</option>
					      <option value="10">10 rooms</option>
					    </select>
					    <label for="habitaciones">Number of rooms</label>
					</div>
				</div>

<?php
$isla = isset($_POST['isla']) ? $_POST['isla'] : null ;
$entrada = isset($_POST['entrada']) ? $_POST['entrada'] : null ;
$salida = isset($_POST['salida']) ? $_POST['salida'] : null ;
$huespedes = isset($_POST['huespedes']) ? $_POST['huespedes'] : null ;
$habitaciones = isset($_POST['habitaciones']) ? $_POST['habitaciones'] : null ;


	$_SESSION['isla'] = $isla;
	$_SESSION['entrada'] = $entrada;
	$_SESSION['salida'] = $salida;
	$_SESSION['huespedes'] = $huespedes;
	$_SESSION['habitaciones'] = $habitaciones;
?>
		<div class="row">
			<button class="btn waves-effect waves-light col s2" type="submit" name="submit">Search
		    <i class="material-icons right">search</i>
			</button>
		    <button class="btn waves-effect waves-light col s3 offset-s1" type="reset" name="action">Reset
		    <i class="material-icons right">refresh</i>
		  	</button>
		</div>
	</form>
</div>

<br><br><br>
<form action="pagarhoteles.php" method="POST">
<div class="container">
<?php
if (isset($_POST['submit'])) {
	if(strtotime($entrada)<strtotime($salida)){
echo "<h1>HOTELS</h1> <br>";

?>

<table class="centered highlight bordered">
	<thead >
		<tr>
			<th >Hotel</th>
			<th >Stars</th>
			<th >Price/night/person</th>
			<th >Pick hotel</th>
		</tr>
	</thead>
<!-- IDA BINTER -->
<?php
$ida=0;
	include("conexion.php");

	mysqli_select_db($con,$db) or die ("problemas al conectar base de datos");

		$isla=$_POST["isla"];
		$SQL1 = "SELECT * FROM hoteles WHERE isla= '$isla'";
		$registro1 = mysqli_query($con,$SQL1) or die ("problemas en consulta: ". mysqli_error());

		while ($reg = mysqli_fetch_array($registro1)) {
?>
	<tbody class="row">
		<tr>
			<td><?php echo $reg['hotel']?></td>
			<td><?php echo $reg['estrellas']?></td>
			<td><?php echo $reg['precio'] . "€" ?></td>
			<td><input type="radio" required value="<?php echo $reg['id']?>" name="grupo1" id="<?php echo $reg['id']?>"><label for="<?php echo $reg['id'] ?>"></label></td>
		</tr>
	</tbody>
<?php
	$ida=$ida+1;
		}
		if($ida==0)
			echo "No hotels available on this island.";
?>
</table>
<br><br>
<div class="row">
		<button class="btn waves-effect waves-light col s2" type="submit" name="submit">Continue
	    <i class="material-icons right">arrow_forward</i>
		</button>
	</div>
</div>

</form>


<?php

		}else{
?>
	<span class="estiloError"> You can't return before going, can you?, change your return date.</span>
	<br><br>
<?php
}	
	} 
?>


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
			<a href="../hoteles.php">
			<img src="multimedia/español.jpg" title="Español" class="bandera" alt="español"></a>
			<a href="hoteles.php">
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
 <script>
function fetch(){
	var get = document.getElementById("get").value;
	document.getElementById("put").value = get;
}
 </script>

<script type="text/javascript">
	$(document).ready(function(){
		$('select').material_select();
	});
</script>
</body>
</html>