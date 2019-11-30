<?php
	if(empty($_POST) or (empty($_POST['usuario']) or empty($_POST['senha']))){
		header('Location: index.html');
		exit;
	}
	
	session_start();
	
	include("config.php");
	
	$usuario = $_POST['usuario'];
	$senha   = $_POST['senha'];
	
	$sql = "SELECT * FROM usuarios
		    WHERE usuario='".$usuario."'
			AND senha='".md5($senha)."'";	
			
	$res = $conn->query($sql) or die($conn->error);
	
	$row = $res->fetch_assoc();
		
	if($res->num_rows > 0){
		$_SESSION["usuario"] = $usuario;
		$_SESSION["nivel"]   = $row["nivel"];
		header('Location: index.html');
 	}else{
		unset($_SESSION["usuario"]);
		unset($_SESSION["nivel"]);
		header('Location: index.php?aut=err');
	}
	
?>




