<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Welcome</title>
	<link rel="icon" href="data:,">
	<style type="text/css">
		*{
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}
		html,body{
			height: 100%;
		}
		.sidebar{
			width: 300px;
			height: 100%;
			background-color: #ccc;
			color: white;
			border-right: 1px dotted black;
			text-align: center;
			padding: 12px 1%;
		}
		.topo{
			background-color: rgb(225,225,225);
			padding: 20px 0;
			color: black;
		}
		.topo a{
			text-decoration: none;
			color: black;
			cursor: pointer;
			margin: 8px 0;
			display: block;
		}
		.btn-coord{
			margin-top: 20px;
		}
		.btn-coord a{
			background-color: #e82975;
			color: white;
			text-decoration: none;
			padding: 8px 1%;
		}
		.info-localizacao{
			margin-top: 20px;
			text-align: left;
			color: black;
		}
	</style>
</head>
<body>
	<?php 
		if(isset($_GET['sair'])){
			session_destroy();
			echo '<script>location.href="'.INCLUDE_PATH.'home";</script>';
			die();
		}
	?>
	<div class="sidebar">
		<div class="topo">
			<h3>Bem vindo(a) <?php echo $_SESSION['nome']; ?></h3>
			<a href="?sair">fechar</a>
		</div>
		<div class="btn-coord">
			<a href="">Atualizar localização</a>
		</div>
		<div class="info-localizacao">
			<p>Latitude: 0</p>
			<p>Longitude: 0</p>
			<p>Localização: <?php echo $_SESSION['localizacao']; ?></p>
		</div>
	</div>
	
</body>
</html>