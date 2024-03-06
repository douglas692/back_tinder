<?php 
	
	session_start();

	define('INCLUDE_PATH','http://localhost/Index/Tinder/');

	$autoload = function($class){
		include($class.'.php');
	};

	spl_autoload_register($autoload);

	if(!isset($_SESSION['login']) && $_GET['url'] != 'login'){
		echo '<script>location.href="'.INCLUDE_PATH.'login";</script>';
		die();
	}

	$url = isset($_GET['url']) ? explode('/', $_GET['url'])[0] : 'home';

	$fileExiste = 'pages/'.$url.'.php';

	if(file_exists($fileExiste)){
		include($fileExiste);
	}else{
		die('Pagina não encontrada!');
	}

?>