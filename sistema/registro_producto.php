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
		if(empty($_POST['proveedor']) || empty($_POST['producto']) || empty($_POST['precio']) || empty($_POST['cantidad']))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
		}else{

			$proveedor = $_POST['proveedor'];
			$producto  = $_POST['producto'];
			$precio   = $_POST['precio'];
			$cantidad= $_POST['cantidad'];
	    $usuario_id = $_SESSION['idUser'];

        $foto=$_FILES['foto'];
          $nombre_foto=$foto['name'];
          $tipo_archivo=$foto['type'];
          $url_temp=$foto['tmp_name'];

          $img_producto='img_producto.png';

          if ($nombre_foto!='') {
            $destino='img/uploads/';
            $img_nombre='img_'.md5(date('d-m-Y H:m:s'));
            $img_producto=$img_nombre.'.jpg';
            $src=$destino.$img_producto;
          }


				$query_insert = mysqli_query($conection,"INSERT INTO producto(proveedor, descripcion, precio, existencia, usuario_id, foto) VALUES('$proveedor','$producto','$precio','$cantidad','$usuario_id','$img_producto')");

				if($query_insert){
            if ($nombre_foto!='') {
             move_uploaded_file($url_temp, $src);
            }
					$alert='<p class="msg_save">Producto Guardado correctamente.</p>';
				}else{
					$alert='<p class="msg_error">Error al Guardar el Producto.</p>';
				}
		}
        
	}



 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Registro de Producto</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		
		<div class="form_register">
			<h1>Registro de Producto</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

			<form action="" method="post" enctype="multipart/form-data">
				<label for="proveedor">Proveedor</label>

          <?php   
            $query_proveedor=mysqli_query($conection, "SELECT codproveedor, proveedor FROM proveedor WHERE estatus = 1 ORDER BY proveedor ASC");
            $result_proveedor=mysqli_num_rows($query_proveedor);
            mysqli_close($conection);
          ?>
          <select name="proveedor" id="proveedor">
            <?php
            if($result_proveedor>0){
              while ($proveedor=mysqli_fetch_array($query_proveedor)){

              ?>
             <option value="<?php echo $proveedor['codproveedor'];?>"><?php echo $proveedor['proveedor'];?></option>
            <?php
            }
            }
            ?>
           
          </select>


				<label for="producto">Nombre del Producto</label>
				<input type="text" name="producto" id="producto" placeholder="Nombre del Producto">
				<label for="precio">Precio del Producto</label>
				<input type="number" name="precio" id="precio" placeholder="Precio del Producto">
			<label for="cantidad">Cantidad del Producto</label>
				<input type="number" name="cantidad" id="direccion" placeholder="Cantidad del Producto">
		

<div class="photo">
	<label for="foto">Foto</label>
        <div class="prevPhoto">
        <span class="delPhoto notBlock">X</span>
        <label for="foto"></label>
        </div>
        <div class="upimg">
        <input type="file" name="foto" id="foto">
        </div>
        <div id="form_alert"></div>
</div>




				<input type="submit" value="Guardar Producto" class="btn_save">

			</form>


		</div>


	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>