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

		public static function startSession($login){
			$_SESSION['login'] = $login;
		}	
	}
?>