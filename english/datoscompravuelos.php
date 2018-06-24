<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
    <html lang="es">
	<meta charset="UTF-8">
	<title>Purchase details</title>
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
	        <a href="#!" class="breadcrumb ">Round trip</a>
			<a href="#!" class="breadcrumb ">Summary</a>
			<a href="#!" class="breadcrumb ">Purchase</a>
	      </div>
	    </div>
	</nav>


<?php 

  //Function -> Salida de datos.
function dataForm($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

$nombreValido = $apellidoValido = $emailValido = $telefonoValido = $dniValido = $errorsapellido = $errorsNombre = $errorsEmail = $errorsTel = $errorsdni = $nombre = $email = $telefono = $dni = $apellido = NULL;   

if(isset($_POST['submit']) && $_SERVER["REQUEST_METHOD"] == "POST") {
	$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null ;
	$apellido = isset($_POST['apellidos']) ? $_POST['apellidos'] : null ;
	$nombreValido = dataForm($nombre);
    $apellidoValido = dataForm($apellido);
	$emailValido = dataForm($_POST['correo']);
    $telefonoValido = dataForm($_POST['telefono']);
    $dniValido = dataForm($_POST['dni']);

 //Regla nombre
  if (empty($_POST['nombre'])) {
    $errorsNombre = "\n Please insert your name."; 
  } elseif (!preg_match("/^[a-zA-Z ]*$/",$nombreValido)) {
    $errorsNombre = "\n Only letters and blanks allowed"; 
  } else {  //Caso verdadero obtenemos datos.  
    $nombre = dataForm($_POST['nombre']);
  }

   //Regla apellido
  if (empty($_POST['apellidos'])) {
    $errorsapellido = "\n Please insert your surname."; 
  } elseif (!preg_match("/^[a-zA-Z ]*$/",$apellidoValido)) {
    $errorsapellido = "\n Only letters and blanks allowed"; 
  } else {  //Caso verdadero obtenemos datos.  
    $apellido = dataForm($_POST['apellidos']);
  }

  //Regla email
  if (empty($_POST['correo'])) {
    $errorsEmail = "\n Please insert your email. "; 
  } elseif (!filter_var($emailValido, FILTER_VALIDATE_EMAIL)) {
    $errorsEmail = "\n Email format must be: text@text.text";
  } else { //Caso verdadero obtenemos datos.  
    $email = dataForm($_POST['correo']);
  }

  //Regla telefono.
  if (empty($_POST['telefono'])) {
    $errorsTel = "\n Please insert your phone number. "; 
  } elseif (!preg_match("/^[0-9]{9}$/", $telefonoValido)) {
    $errorsTel = "\n Invalid number, must be 9 digits long";
  } else { //Caso verdadero obtenemos datos.  
    $telefono = dataForm($_POST['telefono']);
  }

    //Regla DNI.
  if (empty($_POST['dni'])) {
    $errorsdni = "\n Please insert your ID number. "; 
  } elseif (!preg_match("/^\d{8}[a-zA-Z]$/", $dniValido)) {
    $errorsdni = "\n The ID format must be: 99999999A";
  } else { //Caso verdadero obtenemos datos.  
    $dni = dataForm($_POST['dni']);
  }

 //Comprobamos si todos los datos son verdadero.
if ($nombre && $apellido && $email && $telefono && $dni){
 
 
if (isset($_POST['submit'])) {


	include 'conexion.php';

	$nombre = $_POST["nombre"];
	$apellidos = $_POST["apellidos"];
	$dni = $_POST["dni"];
	$telefono = $_POST["telefono"];
	$correo = $_POST["correo"];
	$pasajeros = $_SESSION['pasajeros'];
	$ida = $_SESSION['ida'];
    $vuelta = $_SESSION['vuelta'];
	$id_ida = $_SESSION['id_ida'];
	$id_vuelta = $_SESSION['id_vuelta'];
	$insertar_ida = "INSERT INTO reservas_vuelos VALUES('$nombre','$apellidos','$dni','$telefono','$correo','$pasajeros','$ida','$id_ida')";
	$insertar_vuelta = "INSERT INTO reservas_vuelos VALUES('$nombre','$apellidos','$dni','$telefono','$correo','$pasajeros','$vuelta','$id_vuelta')";

	$resultado = mysqli_query($con,$insertar_ida);
	$resultado2 = mysqli_query($con,$insertar_vuelta);


	if((!$resultado)&&(!$resultado2)){
?>
		 <h1 align="center">An error occured</h1>

	<?php }else{ ?>

		<h1 align="center">Purchase successfully done</h1>
		<?php
	} } } }
		?>


<div class="error">

<?php 
//Caso enviar, mensaje OK, invisible formulario.   
if(isset($msg)){
  echo "<p class='err'>".$msg."</p>";
} else { //Caso falso mostramos formulario.
?>

</div>



<br><br>
	<h1 align="center">Purchase details</h1>
<div class="container">
	<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST" autocomplete="off" enctype="multipart/form-data">
		<div class="row">
			<div class="input-field col s2 nombre">
				<label for="nombre">Name</label>
				<input  type="text" name="nombre" id="nombre" required class="autocomplete">
				      
      <?php if (!empty($errorsNombre)) {  echo "<span class=estiloError>$errorsNombre</span>";  }  ?>
			</div>

			<div class="input-field col s4 offset-s2">
				<label for="apellidos">Surname</label>
				<input type="text" name="apellidos" id="apellidos" required class="autocomplete">
				      
      <?php if (!empty($errorsapellido)) {  echo "<span class=estiloError>$errorsapellido</span>";  }  ?>
			</div>

				<div class="input-field col s2 offset-s2">
				<label for="dni">ID</label>
				<input type="text" id="dni" name="dni" required class="autocomplete">
				      
      <?php if (!empty($errorsdni)) {  echo "<span class=estiloError>$errorsdni</span>";  }  ?>
			</div>

		</div>

		<div class="row">
			<div class="input-field col s2">
				<label for="telefono">Phone number</label>
				<input type="tel" id="telefono" name="telefono" required class="autocomplete">
				           
       <?php if (!empty($errorsTel)) {  echo "<span class=estiloError>$errorsTel</span>";  }  ?>
			</div>

			<div class="input-field col s4 offset-s2">
				<label for="correo">Email</label>
				<input type="text" id="correo" name="correo" required class="autocomplete">
			     
      	<?php if (!empty($errorsEmail)) {  echo "<span class=estiloError>$errorsEmail</span>";  }  ?>
			</div>
		</div>

		<div class="row">
			<button class="btn waves-effect waves-light col s2" type="submit" name="submit">Pay
		    <i class="material-icons right">attach_money</i>
			</button>
		</div>


 <br><br>
	</form>
<?php } ?>
</div>
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