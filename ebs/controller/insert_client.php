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

	# Recebendo os dados do Formulário
	$new_client = $_POST;
	
	# Mudando os dados da Data
	$date_model = explode("-", $new_client['client_birth']);
	$new_client['client_birth'] = $date_model[2]."-".$date_model[1]."-".$date_model[0];

	# Inserir os dados no banco
	$manager = new Manager();

	$manager->insert_common("tb_clients",$new_client,NULL);

	## Gravando os dados no arquivo de Auditoria
	# Criando o Diretório, caso não exista
	//$dir = mkdir($project_path."/view/audictor/");	

	# Criando o arquivo
	$archive = fopen($project_path."/view/audictor.txt", "a+");

	fwrite($archive, date("d-m-Y H:i:s "));
	fwrite($archive, $user->name." inseriu um Cliente");
	fwrite($archive, "\n");

	# Fecha o arquivo
	fclose($archive);

	# Redirecionamento
	header("location: $project_index".$user->profile_page.".php?option=list_clients&success=insert_ok");
?>