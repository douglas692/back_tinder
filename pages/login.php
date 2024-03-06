<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Página de login</title>
</head>
<body>
	<h1>Login</h1>
	<?php 
		$pdo = \MySql::conectar();
		$usuarios = $pdo->prepare("SELECT * FROM usuarios");
		$usuarios->execute();
		$user = $usuarios->fetchAll();

		print_r($user);
	?>
</body>
</html>