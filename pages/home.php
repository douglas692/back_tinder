<?php 
	
	if(isset($_GET['action'])){
			$action = $_GET['action'];
		if($action == ACTION_DISLIKE){
			\Usuarios::executarAcao(ACTION_DISLIKE, $_GET['id']);
		}else if($action == ACTION_LIKE){
			\Usuarios::executarAcao(ACTION_LIKE, $_GET['id']);
		}
	}
?>
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
			float: left;
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
		.btn-coord button{
			background-color: #e82975;
			color: white;
			text-decoration: none;
			padding: 8px 1%;
			border: 0;
			cursor: pointer;
		}
		.info-localizacao{
			margin-top: 20px;
			text-align: left;
			color: black;
		}
		.box-usuario-like{
			position: absolute;
			left: 50%;
			top: 50%;
			transform: translate(-50%, -50%);
			width: 400px;
			height: 400px;
			background-color: rgb(225,225,225);
			line-height: 400px;
			text-align: center;
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
			<button onClick="getLocation()">Atualizar localização</button>
		</div>
		<div id="localizacao" class="info-localizacao">
			<p style="display:none;" class="lat-txt"><?php echo $_SESSION['lat']; ?></p>
			<p style="display:none;" class="lon-txt"><?php echo $_SESSION['longi']; ?></p>
			<p class="cidade-txt">Moro em: <?php echo $_SESSION['localizacao']; ?></p>
			<br />
			<h3>Contatos:</h3>
			<ul>
				<?php 
					$contatos = \Usuarios::buscaContatos();
					foreach ($contatos as $key => $value) {
				?>	
					<li><?php echo $value['nome']; ?>| Distância: <span class="user-distancia"></span>
					<span style="display:none;" class="lat-user"><?php echo $value['lat']; ?></span>
					<span style="display:none;" class="long-user"><?php echo $value['longi']; ?></span></li>
				<?php } ?>
			</ul>
		</div>
	</div>

	<div class="box-usuario-like">
		<div class="box-usuario-nome">
			<?php 
				$usuario = \Usuarios::bdDados();
			?>
			<h2><?php echo $usuario['nome']; ?>
				<a href="?action=1&id=<?php echo $usuario['id']; ?>">Gostei</a>
			<a href="?action=0&id=<?php echo $usuario['id']; ?>">Pula</a>
			</h2>
		</div>		
					
	</div>

	<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
	<script src="<?php echo INCLUDE_PATH ?>script/script.js"></script>
	
</body>
</html>