<?php
	// class conexion{
	// 	function recuperarDatos(){
			$host = "localhost";
			$user = "id5540751_rguezzdani1996";
			$pw = "fYbyEP3P";
			$db = "id5540751_tripfinder";
			$con = mysqli_connect($host, $user, $pw, $db) or die ("problemas al conectar server");

	// 		$con = mysql_connect($host, $user, $pw) or die ("No se pudo conectar a la base de datos");
	// 		mysql_select_db($db, $con) or die ("No se encontró la base de datos.");
	// 		$query = "SELECT * FROM vuelos";
	// 		$resultado = mysql_query($query);


	// 		while($fila = mysql_fetch_array($resultado)){
	// 			echo "$fila[origen] <br>";
	// 			echo "$fila[destino]<br>";
	// 			echo "$fila[ida]<br>";
	// 			echo "$fila[vuelta]<br>";
	// 			echo "$fila[pasajeros]<br>";
	// 		}
	// 	}
	// }

?>