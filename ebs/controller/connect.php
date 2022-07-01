<?php  
	ini_set("display_errors", 1);

	# Database Data
	$host = "localhost";
	$user = "root";
	$pass = "";
	$db_name = "ebs";

	# Criando a função de conexão
	$conn = mysqli_connect($host, $user, $pass,$db_name) or die(mysqli_connect_errno());

	# Função de Fechamento da Conexão
	function close_conn (){
		mysqli_close($conn);
	}	

	
?>