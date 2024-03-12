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
				$pegaUsuarioRandom = \MySql::conectar()->prepare("SELECT * FROM `usuarios` WHERE genero != 'feminino' ORDER BY RAND() LIMIT 1");
				$pegaUsuarioRandom->execute();
				$info = $pegaUsuarioRandom->fetch();

				return $info;
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

		public static function buscaContatos(){
			
			$contatos = [];
			$gostei = \MySql::conectar()->prepare("SELECT * FROM `likes` WHERE user_from = ? AND acao = 1");
			$gostei->execute(array($_SESSION['id']));
			$gostei = $gostei->fetchAll();
			foreach ($gostei as $key => $value) {
				/*teste
				echo $value['user_to'];
				echo '<br/>';
				*/
				$virouContato = \MySql::conectar()->prepare("SELECT * FROM `likes` WHERE user_to = ? AND user_from = ? AND acao = 1");
				$virouContato->execute(array($_SESSION['id'],$value['user_to']));
				if($virouContato->rowCount() == 1){
					$infoContato = \MySql::conectar()->prepare("SELECT * FROM `usuarios` WHERE id = ?");
					$infoContato->execute([$value['user_to']]);
					$contatos[] = $infoContato->fetch();
				}

				return $contatos;
			}
		}
	}
?>