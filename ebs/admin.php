<?php  

	# Incluindo os arquivos necessários
	include_once 'model/config.php';
	include_once 'model/class/User.class.php';
	include_once 'controller/validate.php';
	include_once 'model/dictionary.php';

	session_start();
	# Testando se existe sessão ativa
	if(!isset($_SESSION[md5("user_data")])){
		header("location: $project_index?error=access_denied");
	}else{
		$user = $_SESSION[md5("user_data")];

		if($user->profile_page != "admin"){
			header("location: $project_index?error=access_denied");
		}

	}

	function page_content(){
		echo "<hr class='primary'>";
		# Chamando a função que gera o alert com as mensagens
		validate_message();

		# Chamando a validação de opções e, caso a chamada seja falsa, inclui a mensagem de boas vindas
		if(validate_options() === false){
			include_once $GLOBALS['project_path'].'/view/welcome.html';
		}
	}

	# Incluindo o Layout do Sistema
	include_once 'view/template_obs_.html';

	


?>

