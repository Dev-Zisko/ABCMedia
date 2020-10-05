<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
</head>
<body>
	<h1>Usted ha pagado un producto de ABCMedia.</h1>
	<h3>En caso de ocurrir algún problema con el comprador mandenos un correo con su número de factura o pago.</h3>
	<br>
	<h3>El pago proviene de la publicación:</h3>
	<p><?= $producto ?></p>
	<h3>Id del pago o factura:</h3>
	<p><?= $id ?></p>
	<h3>Método del pago:</h3>
	<p><?= $metodo ?></p>
	<h3>Estado del pago:</h3>
	<p><?= $estado ?></p>
	<h3>Fecha del pago:</h3>
	<p><?= $fecha ?></p>
	<h3>Monto del pago:</h3>
	<p><?= $monto ?></p>
</body>
</html>