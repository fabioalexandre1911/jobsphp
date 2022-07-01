<?php  

	# Incluindo os arquivos necessários
	include_once dirname(__DIR__)."/model/config.php";
	include_once $project_path."/model/class/Connect.class.php";
	include_once $project_path."/model/class/Manager.class.php";
	include_once $project_path."/model/class/User.class.php";

	# Recebendo os dados do Formulário
	$email = $_POST['email'];
	$password = sha1($_POST['password']);

	# Criar o objeto do tipo Manager
	$manager = new Manager();

	# Realizando a busca
	//Tabelas
	$tb['tb_users'] = array();
	$tb['tb_profiles'] = array();

	//Relacionamento
	$rel['tb_users.profile_id'] = "tb_profiles.id_profile";

	//Filtro
	$filter['tb_users.user_email'] = $email;

	# Busca do Usuário no Banco de Dados
	$log = $manager->select_special($tb,$rel,$filter," LIMIT 1");

	
	# Testes de Login
	if($log === false){
		header("location: $project_index?error=user_not_found");
	}elseif($log[0]['user_password'] != $password){
		header("location: $project_index?error=password_incorrect");
	}else{
		# Se chegou aqui, os dados do form estão corretos

		# Excluindo a senha do array, para que a mesma não fique salva na sessão
		unset($log[0]['user_password']);

		# Criando o objeto do tipo User
		$user = new User($log[0]['user_name'], $log[0]['user_email']);

		# Colocando os restante dos dados no objeto $user usando o foreach. Esse método só é possivel graças ao método mágico __set, da classe User.
		foreach ($log[0] as $key => $value) {
			$user->$key = $value;
		}

		# Startando o serviço de sessão
		session_start();

		# Colocando os dados do objeto $user na sessão
		$_SESSION[md5("user_data")] = $user;

		# Redirecionamento para o index
		header("location: $project_index");

	}


?>