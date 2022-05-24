<?php 
	session_start();
	if($_SESSION['rol'] != 1)
	{
		header("location: ./");
	}
	
	include "../conexion.php";

	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['proveedor']) || empty($_POST['contacto']) || empty($_POST['telefono']) || empty($_POST['direccion']))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
		}else{

			$proveedor = $_POST['proveedor'];
			$contacto  = $_POST['contacto'];
			$telefono   = $_POST['telefono'];
			$direccion = $_POST['direccion'];
	    $usuario_id = $_SESSION['idUser'];



				$query_insert = mysqli_query($conection,"INSERT INTO proveedor(proveedor, contacto, telefono, direccion, usuario_id) VALUES('$proveedor','$contacto','$telefono','$direccion','$usuario_id')");
				if($query_insert){
					$alert='<p class="msg_save">Proveedor creado correctamente.</p>';
				}else{
					$alert='<p class="msg_error">Error al crear el Proveedor.</p>';
				}
		}
        mysqli_close($conection);
	}



 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Registro Proveedor</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		
		<div class="form_register">
			<h1>Registro Proveedor</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

			<form action="" method="post">
				<label for="proveedor">Nombre</label>
				<input type="text" name="proveedor" id="proveedor" placeholder="Nombre del Proveedor">
				<label for="contacto">Nombre del Contacto</label>
				<input type="text" name="contacto" id="contacto" placeholder="Nombre Completo del Contacto">
				<label for="telefono">Telefono</label>
				<input type="number" name="telefono" id="telefono" placeholder="Telefono">
			<label for="direccion">Direccion</label>
				<input type="text" name="direccion" id="direccion" placeholder="Direccion">
		
				<input type="submit" value="Crear Proveedor" class="btn_save">

			</form>


		</div>


	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>