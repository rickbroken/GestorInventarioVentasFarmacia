<?php
session_start();
require("php/config.php");

if (!isset($_SESSION['usuario'])){
    header("Location: $ruta"."login.php");
	die("Acceso denegado");
	exit;
}

$sesion = $_SESSION['usuario'];

$conexion->set_charset("utf8");
$statement = $conexion->prepare("SELECT * FROM $tabla_db3 WHERE usuario = '$sesion'");
$statement->execute();
$resultados = $statement->get_result();
$resultados = $resultados->fetch_assoc();

?>




<!DOCTYPE html>
<html lang="es" class="html-caja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<title>Caja registradora</title>
	<script src="https://code.iconify.design/iconify-icon/1.0.1/iconify-icon.min.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
  	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,600" rel="stylesheet"> 
	<link rel="stylesheet" href="css/estilos-caja.css">
	<script src="jquery/jquery-3.4.1.min.js"></script>
</head>
<body class="body-caja">
	<div class="detec-menu" id="detec-menu"></div>

	<div class="menu-respon">
		<div class="cont-icon-menu-respon">
			<iconify-icon id="iconMenuRespon" icon="fontisto:nav-icon-a" style="color: white;" width="25"></iconify-icon>
		</div>
	</div>
	

	<div class="menu" id="menu">
		<div class="cont_1">
			<div class="sub_cont_1"><img src="<?php echo($resultados['img']); ?>" alt=""></div>
			<div><p class="nombre_empresa"><?php echo($resultados['nombreEmpresa']); ?></p></div>
			<div><p class="nit"><?php echo($resultados['nit']); ?></p></div>
			<div><p class="direccion"><?php echo($resultados['direccion']); ?></p></div>
			<div><p class="responsable"><?php echo($resultados['responsable']); ?></p></div>
		</div>
		<div class="cont_2">
			<div class="sub_cont_1"><iconify-icon class="icon-caja" width="15" icon="fa-solid:cash-register"></iconify-icon><a href="index.php" class="menuActivo">Caja Vender</a></div>
			<div class="sub_cont_2"><iconify-icon class="icon-inventario" width="20" icon="mdi:clipboard-list-outline"></iconify-icon><a href="inventario.php">Inventario</a></div>
			<div class="sub_cont_3"><iconify-icon class="icon-hitorial" width="20" icon="ic:round-history"></iconify-icon><a href="historial.php">Historial Ventas</a></div>
			<div class="exit"><iconify-icon icon="majesticons:door-exit" rotate="180deg" width="20"></iconify-icon><a href="php/exit.php">Cerrar sesion</a></div>
		</div>
	</div>

	<div class="contenedor">
		<div class="fondoDuplicado" id="fondoDuplicado"> 
			<div class="mensajeDuplicado">
				<div class="titleDuplicado">
				<iconify-icon icon="pepicons:duplicate-print" style="color: #006e6e;" width="60"></iconify-icon>
					<p>Ya existe el producto en la lista de venta</p>
				</div>
			</div>
		</div>

		<div class="fondoCodigo" id="fondoCodigo"> 
			<div class="mensajeCodigo">
				<div class="titleCodigo">
				<iconify-icon class="iconify" icon="material-symbols:barcode-reader-outline-rounded" style="color: #006e6e;" width="60"></iconify-icon>
					<p>Ingrese un codigo de barras</p>
				</div>
			</div>
		</div>

		<div class="fondoExito" id="fondoExito"> 
			<div class="mensajeExito">
				<div class="titleExito">
					<iconify-icon class="iconify"  icon="icon-park-outline:database-success" width="60" style="color: #006e6e;"></iconify-icon>
					<p>Venta Exitosa</p>
				</div>
			</div>
		</div>
		<div class="fondoVenta" id="fondoVenta"> 
			<div class="mensajeVenta">
				<div class="titleVenta">
					<p>¡Confirme su venta porfavor!</p>
				</div>
				<div class="cont_btn_sucess"><button  id="confirmarVenta" class="btn btn-success">Confirmar</button></div>
				<div class="cont_btn-danger"><button  id="cancelarVenta" class="btn btn-danger">Cancelar</button></div>
			</div>
		</div>
		<div class="sub_cont">
			<form  method="" class="cont_buscador" id="formulario">
				<input type="text" name="campo" id="campo" placeholder="Ingrese codigo de producto" class="codigo-barras">
				<button id="addProducto" class="btn btn-outline-success">Añadir Producto</button>
			</form>
			

			<table class="content-table tabla1" id="tabla"> 
				<tr> 
					<th class="eliminarSegunda">Codigo Barras</th> 
					<th>Nombre Producto</th>
					<th>Existencia</th> 
					<th class='eliminarPrimera'>Concentracion</th> 
					<th class='eliminarPrimera'>Vencimiento</th>
					<th>Precio U</th> 
					<th>Cantidad</th>
					<th>Precio venta</th> 
					<th>Eliminar</th> 
				</tr>
			</table>
		</div>

		<table class="content-table contador" id="table-total"> 
			<tbody> 
				<tr> 
					<th class="sub-total eliminarThContador">Nombre Empresa</th>
					<th class="sub-total-number eliminarThContador" >Nit 2012.123.11</th> 
					<th class="total">Total:</th>
					<th class="total-number" id="totalFactura">$ 0</th>
					<th class="th-vender">
						<button name="vender" id="vender" class="btn btn-success btn-vender">Vender</button>
					</th>
				</tr> 
			</tbody>
			
		</table>
	</div>
	<script src="https://momentjs.com/downloads/moment-with-locales.min.js"></script>
	<script src="js/config.js"></script>
	<script src="js/vencimiento.js"></script>
	<script src="js/main-caja.js"></script>
</body>
</html>

