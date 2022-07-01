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
	$new_data = $_POST;

	# Mudando os dados da Data
	$date_model = explode("-", $new_data['user_birth']);
	$new_data['user_birth'] = $date_model[2]."-".$date_model[1]."-".$date_model[0];

	# Verificando se existe a troca de senha
	if($new_data['user_password'] != ""){
		$new_data['user_password'] = sha1($new_data['user_password']);
	}else{
		unset($new_data['user_password']);
	}

	# Modificando os dados no banco
	$manager = new Manager();

	$filter['id_user'] = $new_data['id_user'];

	$manager->update_common("tb_users",$new_data,$filter,NULL);

	## Gravando os dados no arquivo de Auditoria
	# Criando o Diretório, caso não exista
	//$dir = mkdir($project_path."/view/audictor/");	

	# Criando o arquivo
	$archive = fopen($project_path."/view/audictor.txt", "a+");

	fwrite($archive, date("d-m-Y H:i:s "));
	fwrite($archive, $user->name." Atualizou os dados de um Cliente");
	fwrite($archive, "\n");

	# Fecha o arquivo
	fclose($archive);

	# Redirecionamento
	header("location: $project_index".$user->profile_page.".php?option=list_functionaries&success=update_ok");
?>