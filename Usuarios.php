<?php 
	/**
	 * 
	 */
	class Usuarios
	{
		
		public static function verificarLogin($login,$senha){			
			$verifica = \MySql::conectar()->prepare("SELECT * FROM `usuarios` WHERE email = ? AND senha = ?");
			$verifica->execute(array($login,$senha));

			if($verifica->rowCount() == 1){
				return true;
			}else{
				return false;
			}
		}

		public static function startSession($login,$id){
			$_SESSION['login'] = $login;
			$_SESSION['id'] = $id;
			//Pegar dados			
			$sql = \MySql::conectar()->prepare("SELECT * FROM `usuarios` WHERE id = ?");
			$sql->execute(array($id));
			$dados = $sql->fetch();
			$_SESSION['nome'] = $dados['nome'];
			$_SESSION['localizacao'] = $dados['localizacao'];
			$_SESSION['lat'] = $dados['lat'];
			$_SESSION['longi'] = $dados['longi'];
			$_SESSION['genero'] = $dados['genero'];
		}	

		public static function getUserId($login){
			$id = \MySql::conectar()->prepare("SELECT id FROM `usuarios` WHERE email = ?");
			$id->execute(array($login));
			$id = $id->fetch()['id'];

			return $id;
		}
		public static function deslogar(){
			unset($_SESSION['login']);
			unset($_SESSION['nome']);
			unset($_SESSION['id']);
			session_destroy();
		}

		public static function bdDados(){
			$genero = $_SESSION['genero'];
			if($genero == 'masculino'){
				$pegaUsuarioRandom = \MySql::conectar()->prepare("SELECT * FROM `usuarios` WHERE genero != 'masculino' ORDER BY RAND() LIMIT 1");
				$pegaUsuarioRandom->execute();
				$info = $pegaUsuarioRandom->fetch();

				return $info;
			}else{
				
			}
		}

		public static function executarAcao($acao, $id){
			$verifica = \MySql::conectar()->prepare("SELECT * FROM `likes` WHERE user_from = ? AND user_to = ?");
			$verifica->execute(array($_SESSION['id'], $id));
			if($verifica->rowCount() >= 1){
				return;
			}else{
				$inserirAcao = \MySql::conectar()->prepare("INSERT INTO `likes` VALUES (null,?,?,?)");
				$inserirAcao->execute(array($_SESSION['id'], $id, $acao));
			}
		}
	}
?>