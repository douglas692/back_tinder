<?php 
	session_start();
	include('MySql.php');
	if(!isset($_SESSION['id'])){
		die('Faça o login!');
	}
	$idUsuario = $_SESSION['id'];
	$lat = $_POST['latitude'];
	$long = $_POST['longitude'];

	$atualizar = \MySql::conectar()->prepare("UPDATE `usuarios` SET lat = ?, longi = ? WHERE id = $idUsuario");
	$atualizar->execute(array($lat,$long));
?>