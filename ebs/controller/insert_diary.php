<?php  

	# Incluindo os arquivos necessários
	include_once dirname(__DIR__)."/model/config.php";
	include_once $project_path."/model/class/Connect.class.php";
	include_once $project_path."/model/class/Manager.class.php";
	include_once $project_path."/model/class/User.class.php";

	# Validando o Acesso
	session_start();

	if(!isset($_SESSION[md5("user_data")])){
		header("location: $project_index?error=access_denied");
	}else{
		$user = $_SESSION[md5("user_data")];
	}

	# Recebendo os dados do formulário
	$new_agend = $_POST;

	# Criando o objeto do tipo MAnager
	$manager = new Manager();

	# Cadastrando os dados no Banco
	$manager->insert_common("tb_agends",$new_agend,NULL); 

	# Criando o arquivo
	$archive = fopen($project_path."/view/audictor.txt", "a+");

	fwrite($archive, date("d-m-Y H:i:s "));
	fwrite($archive, $user->name." inseriu um Agendamento");
	fwrite($archive, "\n");

	# Fecha o arquivo
	fclose($archive);

	# Redirecionamento
	header("location: $project_index".$user->profile_page.".php?option=list_diaries&success=insert_ok");


 ?>