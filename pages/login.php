<?php 
	if(isset($_SESSION['login'])){
		echo '<script>location.href="'.INCLUDE_PATH.'home";</script>';
		die();	
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Página de login</title>
	<style>
		*{
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}
		html,body{
			height: 100%;
		}
		.center{
			max-width: 980px;
			padding: 2px 2%;
			margin: 0 auto;
		}
		.center h1{
			text-align: center;
		}
		.center form{
			padding: 20px 0;
			width: 600px;
			height: 200px;
			margin: 9px auto;
			text-align: center;
			border: 1px dotted #ccc;
		}
		.center form input{
			width: 80%;
			height: 29px;
			margin: 8px 0;
			padding-left: 8px;
		}
		.center form button{
			display: block;
			margin: 0 auto;
			padding: 6px 16px;
			cursor: pointer;
			font-size: 18px;
		}
	</style>
</head>
<body>
	<div class="center">
	<h1>Login</h1>
	<?php 
		if(isset($_POST['acao'])){
			$login = $_POST['login'];
			$senha = $_POST['senha'];
			if(\Usuarios::verificarLogin($login,$senha)){
				$getId = \Usuarios::getUserId($login);
				\Usuarios::startSession($login,$getId);
				echo '<script>alert("Bem vindo!");location.href="'.INCLUDE_PATH.'home";</script>';
				die();
			}else{
				echo '<script>alert("Usuario não encontrado!");location.href="'.INCLUDE_PATH.'login";</script>';
				die();
			}
		}
	?>
	<form method="post">
		<input type="text" name="login" placeholder="Email">
		<input type="password" name="senha" placeholder="Senha">
		<button type="submit" name="acao">Login</button>
	</form>
	</div><!--center-->
</body>
</html>