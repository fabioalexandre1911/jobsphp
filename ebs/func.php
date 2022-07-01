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

		if($user->profile_page != "func"){
			header("location: $project_index?error=access_denied");
		}

	}

	# Função de Gerenciamento de Conteúdo 
	function page_content(){
		validate_message();
		validate_options();
	}

	# Incluindo o Layout do Sistema
	include_once 'view/template.html';

?>