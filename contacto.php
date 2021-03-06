<!DOCTYPE>
<html>
<head>
<meta charset="UTF-8">
<html lang="es">
	<title>Contacto</title>


	<link rel="stylesheet" type="text/css" href="css/compra.css">
	<link rel="stylesheet" type="text/css" href="css/contacto.css">
	<link rel="stylesheet" type="text/css" href="css/materialize.min.css">
	<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/css/materialize.min.css">-->
	<script type = "text/javascript" src = "https://code.jquery.com/jquery-3.3.1.min.js"></script>           
    <script src = "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js"></script> 
	<script src="js/irarriba.js"></script>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>
<body>

<div class="navbar-fixed">
	<nav>
	    <div class="nav-wrapper">
	      <a href="index.php" class="brand-logo">TripFinder</a>
	      <ul id="nav-mobile" class="right hide-on-med-and-down margencabeceras">
	        <li><a href="index.php">Inicio</a></li>
	        <li><a href="vuelos.php">Vuelos</a></li>
	        <li><a href="hoteles.php">Hoteles</a></li>
	        <li class="active"><a href="contacto.php">Contacto</a></li>
	      </ul>
	    </div>
	</nav>
</div>

<nav>
    <div class="nav-wrapper margenbread">
      <div class="col s12">
        <a href="#!" class="breadcrumb margenbreadtext">Contacto</a>
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

$nombreValido = $apellidoValido = $emailValido = $telefonoValido = $consultaValida = $errorsapellido = $errorsNombre = $errorsEmail = $errorsTel = $errorsConsulta = $nombre = $email = $telefono = $consulta = $apellido = NULL;   

if(isset($_POST['submit']) && $_SERVER["REQUEST_METHOD"] == "POST") {
	$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null ;
	$apellido = isset($_POST['tema']) ? $_POST['tema'] : null ;
	$consulta = isset($_POST['mensaje']) ? $_POST['mensaje'] : null ;
	$nombreValido = dataForm($nombre);
    $apellidoValido = dataForm($apellido);
    $consultaValida = dataForm($consulta);
	$emailValido = dataForm($_POST['correo']);
    $telefonoValido = dataForm($_POST['telefono']);

 //Regla nombre
  if (empty($_POST['nombre'])) {
    $errorsNombre = "\n Por favor ingrese su nombre."; 
  } elseif (!preg_match("/^[a-zA-Z ]*$/",$nombreValido)) {
    $errorsNombre = "\n Sólo se permiten letras y espacios en blanco"; 
  } else {  //Caso verdadero obtenemos datos.  
    $nombre = dataForm($_POST['nombre']);
  }


  //Regla email
  if (empty($_POST['correo'])) {
    $errorsEmail = "\n Por favor ingrese su email. "; 
  } elseif (!filter_var($emailValido, FILTER_VALIDATE_EMAIL)) {
    $errorsEmail = "\n Ingrese un email con formato: texto@texto.texto";
  } else { //Caso verdadero obtenemos datos.  
    $email = dataForm($_POST['correo']);
  }



   //Regla tema de contacto
  if (empty($_POST['tema'])) {
    $errorsapellido = "\n Por favor ingrese sus apellidos."; 
  } elseif (!preg_match("/^[a-zA-Z ]*$/",$apellidoValido)) {
    $errorsapellido = "\n Sólo se permiten letras y espacios en blanco"; 
  } else {  //Caso verdadero obtenemos datos.  
    $apellido = dataForm($_POST['tema']);
  }



  //Regla telefono.
  if (empty($_POST['telefono'])) {
    $errorsTel = "\n Por favor ingrese su número telefono. "; 
  } elseif (!preg_match("/^[0-9]{9}$/", $telefonoValido)) {
    $errorsTel = "\n Número no valido, ingrese un número de 9 cifras";
  } else { //Caso verdadero obtenemos datos.  
    $telefono = dataForm($_POST['telefono']);
  }

    //Regla mensaje.
  if (empty($_POST['mensaje'])) {
    $errorsConsulta = "\n Por favor ingrese su consulta. "; 
  } elseif (!preg_match("/^[a-zA-Z ]*$/",$consultaValida)) {
    $errorsConsulta = "\n Sólo se permiten letras y espacios en blanco";
  } else { //Caso verdadero obtenemos datos.  
    $consulta = dataForm($_POST['mensaje']);
  }

 //Comprobamos si todos los datos son verdadero.
if ($nombre && $apellido && $email && $telefono && $consulta){
 
 
if (isset($_POST['submit'])) {


	include 'conexion.php';

	$nombre = $_POST["nombre"];
	$correo = $_POST["correo"];
	$tema = $_POST["tema"];
	$telefono = $_POST["telefono"];
	$mensaje = $_POST["mensaje"];
	$insertar_contacto = "INSERT INTO contacto VALUES('$nombre','$correo','$tema','$telefono','$mensaje')";
	$resultado = mysqli_query($con,$insertar_contacto);


	if(!$resultado){
?>
		 <h1 align="center">Error al realizar la consulta</h1>

	<?php }else{ ?>

		<h1 align="center">Consulta realizada con éxito</h1>
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









<div class="bajarcuadro">
	<div class="container">
		<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST" autocomplete="off" enctype="multipart/form-data">	
				<div class="row">
						<div class="input-field col s3">
							<input data-length="40" id="nombre" type="text" name="nombre" required>
							<label for="nombre">Nombre</label>
							      <?php if (!empty($errorsNombre)) {  echo "<span class=estiloError>$errorsNombre</span>";  }  ?>
						</div>
						<div class="input-field col s3 offset-s1">
							<input data-length="40" id="correo" type="text" name="correo" required>
							<label for="correo">Correo electrónico</label>
							<?php if (!empty($errorsEmail)) {  echo "<span class=estiloError>$errorsEmail</span>";  }  ?>
						</div>
						<div class="input-field col s3 offset-s1">
							<input data-length="40" id="tema" type="text" name="tema">
							<label for="tema">Tema de contacto</label>
							<?php if (!empty($errorsapellido)) {  echo "<span class=estiloError>$errorsapellido</span>";  }  ?>
						</div>
				</div>
				<div class="row">
					<div class="input-field col s4">
						<input data-length="40" size="28" maxlenght="10" id="telefono" type="tel" required name="telefono">
						<label for="telefono">Teléfono</label>
						<?php if (!empty($errorsTel)) {  echo "<span class=estiloError>$errorsTel</span>";  }  ?>
					</div>
					<div class="input-field col s4 offset-s1">
						<textarea id="mensaje" maxlenght="200" class="materialize-textarea" required name="mensaje"></textarea>
						<label for="mensaje">Mensaje o consulta</label>
						<?php if (!empty($errorsConsulta)) {  echo "<span class=estiloError>$errorsConsulta</span>";  }  ?>
					</div>
				</div>
				<div class="row">
					<input class="btn btn-primary" type="reset" value="Cancelar">
					<input class="btn btn-primary" type="submit" value="Enviar" name="submit">
				</div>
		</form>
<?php } ?>
	</div>
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
			<ul><img class="col s1 info" src="./multimedia/contacto.png" alt="telefono"> <p class="col s6">Teléfono: +34 922 1658 7235</p> </ul>
			</div>
			
		<div class="row">
			<ul> <img class="col s1 info" src="./multimedia/chat.png" alt="chat"> <p class="col s6">Chat</p></ul>
		</div>
		
		<div class="row">
			<ul><img class="col s1 info" src="./multimedia/facebook.png" alt="facebook"> <p class="col s6">Facebook: <a class="color" href=" www.facebook.com/VuelosTop.ES">  facebook.com/VuelosTop.ES </a></p> </ul>
		</div>

		<div>
			<a href="contacto.php">
			<img src="multimedia/español.jpg" title="Español" class="bandera" alt="español"></a>
			<a href="english/contacto.php">
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

</script>
</body>
</html>