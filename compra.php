<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
    <html lang="es">
	<meta charset="UTF-8">
	<title>Compra</title>
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
	        <a href="#!" class="breadcrumb ">Ida y Vuelta</a>
			<a href="#!" class="breadcrumb ">Compra</a>
	      </div>
	    </div>
	</nav>

	<h1 align="center">Resumen de vuelos</h1>
	<br><br>
<div class="container">
	<table class="centered responsive-table highlight bordered">
		<thead class="row">
			<tr>
				<th>Trayecto</th>
				<th>Origen</th>
				<th>Destino</th>
				<th>Fecha ida</th>
				<th>Hora salida</th>
				<th>Hora llegada</th>
				<th>Pasajeros</th>
				<th>Aerolínea</th>
				<th>Precio</th>
			</tr>
		</thead>
		
<?php
include("conexion.php");
mysqli_select_db($con,$db) or die ("problemas al conectar base de datos");
	$ida = $_POST['grupo1'];
	$vuelta = $_POST['grupo2'];
	
	$_SESSION['id_ida'] = $ida;
	$_SESSION['id_vuelta'] = $vuelta;
	
	$consulta_ida = "SELECT * FROM binter WHERE id= '$ida'";
	$registro = mysqli_query($con,$consulta_ida) or die ("problemas en consulta: ". mysqli_error());
	$reg = mysqli_fetch_array($registro);


	$consulta_ida2 = "SELECT * FROM binter WHERE id= '$vuelta'";
	$registro2 = mysqli_query($con,$consulta_ida2) or die ("problemas en consulta: ". mysqli_error());
	$reg2 = mysqli_fetch_array($registro2);

?>


		<tbody class="row">
			<tr>
				<td>Ida</td>
				<td><?php echo $reg['origen']?></td>
				<td><?php echo $reg['destino']?></td>
				<td><?php echo $_SESSION['ida']?></td>
				<td><?php echo $reg['salida']?></td>
				<td><?php echo $reg['llegada']?></td>
				<td><?php echo $_SESSION['pasajeros']?></td>
				<td><?php echo $reg['aerolinea']?></td>
				<td><?php echo $reg['precio']?>€</td>
			</tr>
			<tr>
				<td>Vuelta</td>
				<td><?php echo $reg2['origen']?></td>
				<td><?php echo $reg2['destino']?></td>
				<td><?php echo $_SESSION['vuelta']?></td>
				<td><?php echo $reg2['salida']?></td>
				<td><?php echo $reg2['llegada']?></td>
				<td><?php echo $_SESSION['pasajeros']?></td>
				<td><?php echo $reg2['aerolinea']?></td>
				<td><?php echo $reg2['precio']?>€</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td><b>Total a pagar:<?php echo " ".(($reg2['precio']*$_SESSION['pasajeros'])+($reg['precio'])*$_SESSION['pasajeros'])?>€</b></td>
			</tr>
		</tbody>

	</table>
<br><br>
	<form action="datoscompravuelos.php">
		<div class="row">
			<button class="btn waves-effect waves-light col s2" type="submit" name="submit">Continuar
		    <i class="material-icons right">arrow_forward</i>
			</button>
	</form>
	<form action="vuelos.php">
			<button class="btn waves-effect waves-light col s2 offset-s1" type="submit" name="submit">Cancelar
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

		<div>
			<a href="compra.php">
			<img src="multimedia/español.jpg" title="Español" class="bandera" alt="español"></a>
			<a href="english/compra.php">
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

</body>
</html>