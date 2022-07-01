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
	$new_user = $_POST;
	
	# Mudando os dados da Data
	$date_model = explode("-", $new_user['user_birth']);
	$new_user['user_birth'] = $date_model[2]."-".$date_model[1]."-".$date_model[0];

	# Criptografando a senha
	$new_user['user_password'] = sha1($new_user['user_password']);


	# Inserir os dados no banco
	$manager = new Manager();

	$manager->insert_common("tb_users",$new_user,NULL);

	## Gravando os dados no arquivo de Auditoria
	# Criando o Diretório, caso não exista
	//$dir = mkdir($project_path."/view/audictor/");	

	# Criando o arquivo
	$archive = fopen($project_path."/view/audictor.txt", "a+");

	fwrite($archive, date("d-m-Y H:i:s "));
	fwrite($archive, $user->name." inseriu um Funcionario");
	fwrite($archive, "\n");

	# Fecha o arquivo
	fclose($archive);

	# Redirecionamento
	header("location: $project_index".$user->profile_page.".php?option=list_functionaries&success=insert_ok");
?>