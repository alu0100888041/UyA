<?php 
session_start(); 
?>

<!DOCTYPE html>
<html>
<head>
    <html lang="es">
	<meta charset="UTF-8">
	<title>Consulta hoteles</title>
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
	      <a href="consultareservas.php" class="brand-logo">TripFinder</a>
	      <ul id="nav-mobile" class="right hide-on-med-and-down margencabeceras">
	        <li><a href="consultavuelos.php">Reservas vuelos</a></li>
	        <li  class="active"><a href="consultareservas.php">Reservas hoteles</a></li>
	      </ul>
	    </div>
	</nav>
</div>
<br><br><br>
<form action="<?php echo HTMLSPECIALCHARS($_SERVER['PHP_SELF'])?>" method="POST">
	<div class="container">
		<div class="row">
			<div class="input-field col s3">
				<input data-length="40" id="dni" type="text" class="validate" required name="dni">
				<label for="dni">DNI</label>
			</div>
		</div>
		<div class="row">
			<button class="btn waves-effect waves-light col s2" type="submit" name="submit">Buscar
		    <i class="material-icons right">search</i>
			</button>
		</div>
	</div>
</form>

	<h1 align="center">Resumen de reservas de hoteles</h1>
	<br><br>
<div class="container">
<?php
if (isset($_POST['submit'])) {
?>
	
	<table class="centered responsive-table highlight bordered">
		<thead class="row">
			<tr>
				<th class="col s1">Isla</th>
				<th class="col s1">Hotel</th>
				<th class="col s1">Entrada</th>
				<th class="col s1">Salida</th>
				<th class="col s1">Huéspedes</th>
				<th class="col s1">Habitaciones</th>
				<th class="col s1">Precio</th>
				<th class="col s1">Nombre</th>
				<th class="col s1">Apellidos</th>
				<th class="col s1">DNI</th>
				<th class="col s1">Teléfono</th>
				<th class="col s1">Correo</th>
			</tr>
		</thead>
		
<?php
include("conexion.php");
mysqli_select_db($con,$db) or die ("problemas al conectar base de datos");
$dni=$_POST["dni"];
$query1 = mysqli_query($con,"SELECT * FROM reservas_hoteles WHERE dni='$dni'");
?>

		<?php while($datos = mysqli_fetch_array($query1)){
		?>
		<tbody class="row">
			<tr>
				<td class="col s1"><?php echo $datos['isla']?></td>
				<td class="col s1"><?php echo $datos['hotel']?></td>
				<td class="col s1"><?php echo $datos['entrada']?></td>
				<td class="col s1"><?php echo $datos['salida']?></td>
				<td class="col s1"><?php echo $datos['huespedes']?></td>
				<td class="col s1"><?php echo $datos['habitaciones']?></td>
				<td class="col s1"><?php echo $datos['preciopn']?></td>
				<td class="col s1"><?php echo $datos['nombre']?></td>
				<td class="col s1"><?php echo $datos['apellidos']?></td>
				<td class="col s1"><?php echo $datos['dni']?></td>
				<td class="col s1"><?php echo $datos['telefono']?></td>
				<td class="col s1"><?php echo $datos['correo']?></td>
			</tr>
		</tbody>
		<?php } ?>
	</table>
	<?php 
			}else{
	?>


	<table class="centered responsive-table highlight bordered">
		<thead class="row">
			<tr>
				<th class="col s1">Isla</th>
				<th class="col s1">Hotel</th>
				<th class="col s1">Entrada</th>
				<th class="col s1">Salida</th>
				<th class="col s1">Huéspedes</th>
				<th class="col s1">Habitaciones</th>
				<th class="col s1">Precio</th>
				<th class="col s1">Nombre</th>
				<th class="col s1">Apellidos</th>
				<th class="col s1">DNI</th>
				<th class="col s1">Teléfono</th>
				<th class="col s1">Correo</th>
			</tr>
		</thead>
		
<?php
include("conexion.php");
mysqli_select_db($con,$db) or die ("problemas al conectar base de datos");
$query2 = mysqli_query($con,"SELECT * FROM reservas_hoteles");
?>

		<?php while($datos2 = mysqli_fetch_array($query2)){
		?>
		<tbody class="row">
			<tr>
				<td class="col s1"><?php echo $datos2['isla']?></td>
				<td class="col s1"><?php echo $datos2['hotel']?></td>
				<td class="col s1"><?php echo $datos2['entrada']?></td>
				<td class="col s1"><?php echo $datos2['salida']?></td>
				<td class="col s1"><?php echo $datos2['huespedes']?></td>
				<td class="col s1"><?php echo $datos2['habitaciones']?></td>
				<td class="col s1"><?php echo $datos2['preciopn']?></td>
				<td class="col s1"><?php echo $datos2['nombre']?></td>
				<td class="col s1"><?php echo $datos2['apellidos']?></td>
				<td class="col s1"><?php echo $datos2['dni']?></td>
				<td class="col s1"><?php echo $datos2['telefono']?></td>
				<td class="col s1"><?php echo $datos2['correo']?></td>
			</tr>
		</tbody>
		<?php } ?>
	</table>
	<?php }
	?>
</div>
<br><br>
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
			<ul><img class="col s1 info" src="./multimedia/contacto.png" alt="contacto"> <p class="col s6">Teléfono: +34 922 1658 7235</p> </ul>
			</div>
			
		<div class="row">
			<ul> <img class="col s1 info" src="./multimedia/chat.png" alt="contacto"> <p class="col s6">Chat</p></ul>
		</div>
		
		<div class="row">
			<ul><img class="col s1 info" src="./multimedia/facebook.png" alt="contacto"> <p class="col s6">Facebook: <a class="color" href=" www.facebook.com/VuelosTop.ES">  facebook.com/VuelosTop.ES </a></p> </ul>
		</div>

		<div>
			<a href="consultareservas.php">
			<img src="multimedia/español.jpg" title="Español" class="bandera"></a>
			<a href="english/consultareservas.php">
			<img src="multimedia/ingles.png" title="Inglés" class="bandera"></a>
		</div>
	</div>


    <!-- POLITICAS -->
    <div class="footer-copyright">
    	<div class="container right-align">
		 Política de privacidad &nbsp; © 2018 TripFinder Inc
		</div>
	</div>
</footer>
</body>
</html>