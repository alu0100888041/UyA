<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
    <html lang="es">
	<meta charset="UTF-8">
	<title>Booking</title>
	<link rel="stylesheet" type="text/css" href="css/compra.css">
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
	      <ul class="right hide-on-med-and-down margencabeceras">
	        <li><a href="index.php">Home</a></li>
	        <li class="active"><a href="vuelos.php">Flights</a></li>
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
         	<a href="#!" class="breadcrumb">One way</a>
			<a href="#!" class="breadcrumb">Purchase</a>
	      </div>
	    </div>
	</nav>

	<h1 align="center">Flights summary</h1>
	<br><br>
<div class="container">
	<table class="centered highlight bordered">
		<thead class="row">
			<tr>
				<th class="col s1">Journey</th>
				<th class="col s1">From</th>
				<th class="col s1">To</th>
				<th class="col s2">Departure date</th>
				<th class="col s2">Departure time</th>
				<th class="col s2">Arrival</th>
				<th class="col s1">Passengers</th>
				<th class="col s1">Airline</th>
				<th class="col s1">Price</th>
			</tr>
		</thead>
		
<?php
include("conexion.php");
mysqli_select_db($con,$db) or die ("problemas al conectar base de datos");
	$ida = $_POST['grupo1'];
	
	$_SESSION['id_ida'] = $ida;
	
	$consulta_ida = "SELECT * FROM binter WHERE id= '$ida'";
	$registro = mysqli_query($con,$consulta_ida) or die ("problemas en consulta: ". mysqli_error());
	$reg = mysqli_fetch_array($registro);

?>

		<tbody class="row">
			<tr>
				<td class="col s1">Journey</td>
				<td class="col s1"><?php echo $reg['origen']?></td>
				<td class="col s1"><?php echo $reg['destino']?></td>
				<td class="col s2"><?php echo $_SESSION['ida']?></td>
				<td class="col s2"><?php echo $reg['salida']?></td>
				<td class="col s2"><?php echo $reg['llegada']?></td>
				<td class="col s1"><?php echo $_SESSION['pasajeros']?></td>
				<td class="col s1"><?php echo $reg['aerolinea']?></td>
				<td class="col s1"><?php echo $reg['precio']?>€</td>
			</tr>
		</tbody>
	</table>
<br><br>
	

<form action="datoscompravuelos2.php">
		<div class="row">
			<button class="btn waves-effect waves-light col s2" type="submit" name="submit">Continue
		    <i class="material-icons right">arrow_forward</i>
			</button>
	</form>
	<form action="vuelos.php">
			<button class="btn waves-effect waves-light col s2 offset-s1" type="submit" name="submit">Cancel
		    <i class="material-icons right">close</i>
			</button>
		</div>
	</form>
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

		<div>
			<a href="../compra.php">
			<img src="multimedia/español.jpg" title="Español" class="bandera" alt="español"></a>
			<a href="compra.php">
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
</body>
</html>