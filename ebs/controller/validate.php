<?php

	# Validação de mensagens na tela.
	function validate_message(){
		//caso haja mensagem a ser mostrada, mostre-as.
		if(isset($_GET['error'])){
			@$alert_msg = $GLOBALS['dictionary'][$_GET['error']];
			$alert_icon = "fa fa-exclamation-triangle";
			$alert_class = "danger";
		}elseif(isset($_GET['success'])){
			@$alert_msg = $GLOBALS['dictionary'][$_GET['success']];
			$alert_icon = "fa fa-check-square";
			$alert_class = "success";
		}else{
			return false;
		}

		//renderizando alert
		include_once $GLOBALS['project_path'].'/view/alert.html';
	}

	function validate_options(){

		# Testa se existe o get option
		if(!isset($_GET["option"])){
			return false;
		}

		# Globalizando o objeto user
		global $user;

		# Incluindo as classes necessárias
		include_once $GLOBALS['project_path']."/model/class/Connect.class.php";
		include_once $GLOBALS['project_path']."/model/class/Manager.class.php";

		# Testando as opções 
		switch($_GET['option']){

			# Lista de Clientes
			case "list_clients":

				# Objeto do tipo Manager (Para a busca)
				$manager = new Manager();

				# Método de Busca 
				$table_content = $manager->select_common("tb_clients",null,null,null);

				# Títulos da Tabela
				$table_titles["client_name"] = "Nome";
				$table_titles["client_email"] = "Email";
				$table_titles["client_cellphone"] = "Telefone/Celular";
				$table_titles["client_birth"] = "Data de Nascimento";
				$table_titles["client_created_in"] = "Cliente Desde: ";
				$table_titles["client_name"] = "Nome";

				# Caminhos de Ações;
				$delete_destiny = "controller/delete_client.php";
				$update_destiny = "?option=update_client";

				# Ações
				$delete = true;
				$update = true;
				$print = true;

				# Filtro - id do cliente
				$filter = "id_client";

				# Botão de Inserção de Clientes
				echo '<p><a href="?option=insert_client" class="btn btn-primary"><i class="fa fa-plus"></i> Adicionar Cliente </a></p>';




				# Incluindo a tabela com os dados
				include_once $GLOBALS['project_path']."/view/list_common.html";

				

			break;

			case "insert_client":
				include_once $GLOBALS['project_path']."/view/forms/insert_client.html";
			break;

			case "update_client":
				$manager = new Manager();

				# Recebendo o Filtro
				$filter['id_client'] = $_GET['filter'];

				# Realizar a busca dos dados do cliente
				$client = $manager->select_common("tb_clients",NULL,$filter," LIMIT 1");

				# Retirando uma camada do array da busca
				$client = $client[0];

				# Incluindo o formulário de Atualização
				include_once $GLOBALS['project_path']."/view/forms/update_client.html";

			break;

			# Lista de Funcionários
			case "list_functionaries":

				# Objeto do tipo Manager (Para a busca)
				$manager = new Manager();

				# Busca Relacionada
				$tb['tb_users'] = array();
				$tb['tb_profiles'] = array();

				$rel['tb_users.profile_id'] = "tb_profiles.id_profile";
				$filter['id_profile'] = 2;

				$table_content = $manager->select_special($tb,$rel,$filter,NULL);

				# Títulos da Tabela
				$table_titles["user_name"] = "Nome";
				$table_titles["user_email"] = "Email";
				$table_titles["user_phone"] = "Telefone";
				$table_titles["profile_name"] = "Perfil";
				$table_titles["user_created_in"] = "Criado Em:";

				# Caminhos de Ações;
				$delete_destiny = "controller/delete_user.php";
				$update_destiny = "?option=update_user";

				# Ações
				$delete = true;
				$update = true;
				$print = true;

				# Filtro - id do cliente
				$filter = "id_user";

				# Botão de Inserção de Clientes
				echo '<p><a href="?option=insert_user" class="btn btn-primary"><i class="fa fa-plus"></i> Adicionar Funcionario </a></p>';

				# Incluindo a tabela com os dados
				include_once $GLOBALS['project_path']."/view/list_common.html";

				

			break;

			case "insert_user":
				if(!isset($user) or $user->profile_page != "admin"){
					header("location: ".$GLOBALS['project_index']);
				}

				include_once $GLOBALS['project_path']."/view/forms/insert_user.html";
			break;
			
			case "update_user":
				$manager = new Manager();

				# Recebendo o Filtro
				$filter['id_user'] = $_GET['filter'];

				# Realizar a busca dos dados do user
				$user_data = $manager->select_common("tb_users",NULL,$filter," LIMIT 1");

				# Retirando uma camada do array da busca
				$user_data = $user_data[0];

				# Incluindo o formulário de Atualização
				include_once $GLOBALS['project_path']."/view/forms/update_user.html";

			break;


			#################################################
			###################Services######################
			#################################################

			# Lista de Clientes
			case "list_services":

				# Objeto do tipo Manager (Para a busca)
				$manager = new Manager();

				# Método de Busca 
				$table_content = $manager->select_common("tb_services",null,null,null);

				# Títulos da Tabela
				$table_titles["service_name"] = "Nome do Serviço";
				$table_titles["service_desc"] = "Descrição do Serviço";
				$table_titles["service_price"] = "Preço do Serviço";

				# Caminhos de Ações;
				$delete_destiny = "controller/delete_service.php";
				$update_destiny = "?option=update_service";

				# Ações
				$delete = true;
				$update = true;
				$print = true;

				# Filtro - id do cliente
				$filter = "id_service";

				# Botão de Inserção de Serviços
				echo '<p><a href="?option=insert_service" class="btn btn-primary"><i class="fa fa-plus"></i> Adicionar Serviço </a></p>';

				# Incluindo a tabela com os dados
				include_once $GLOBALS['project_path']."/view/list_common.html";

				

			break;

			case "insert_service":
				include_once $GLOBALS['project_path']."/view/forms/insert_service.html";
			break;

			case "update_service":
				$manager = new Manager();

				# Recebendo o Filtro
				$filter['id_service'] = $_GET['filter'];

				# Realizar a busca dos dados do cliente
				$service = $manager->select_common("tb_services",NULL,$filter," LIMIT 1");

				# Retirando uma camada do array da busca
				$service = $service[0];

				# Incluindo o formulário de Atualização
				include_once $GLOBALS['project_path']."/view/forms/update_service.html";

			break;

			########################################################
			####################AGENDAMENTOS########################
			########################################################

			case "list_diaries":

				# Objeto do tipo Manager (Para a busca)
				$manager = new Manager();

				$tb['tb_agends'] = array();
				$tb['tb_users'] = array();
				$tb['tb_clients'] = array();
				$tb['tb_services'] = array();

				$rel['tb_agends.user_id'] = "tb_users.id_user";
				$rel['tb_agends.client_id'] = "tb_clients.id_client";
				$rel['tb_agends.service_id'] = "tb_services.id_service";

				if ($user->profile_page == "func") {
					$filter['tb_agends.user_id'] = $user->id_user;
					$table_content = $manager->select_special($tb,$rel,$filter,NULL);
				}else{

				# Método de Busca 
				$table_content = $manager->select_special($tb,$rel,NULL,NULL);

				}

				# Títulos da Tabela
				$table_titles["agend_date"] = "Data";
				$table_titles["agend_hour"] = "Hora";
				$table_titles["agend_local"] = "Local";
				$table_titles["client_name"] = "Cliente";
				$table_titles["service_name"] = "Serviço";
				$table_titles["service_price"] = "Preço";
				$table_titles["user_name"] = "Atendente";
				

				# Caminhos de Ações;
				$delete_destiny = "controller/delete_diary.php";
				$update_destiny = "?option=update_diary";

				# Ações
				$delete = true;
				$update = true;
				$print = true;
				//$block = true;
				$status = true;

				# Filtro - id do cliente
				$filter = "id_agend";



				# Botão de Inserção de Clientes
				echo '<p><a href="?option=insert_diary" class="btn btn-primary"><i class="fa fa-plus"></i> Novo Agendamento</a></p>';



				# Incluindo a tabela com os dados
				include_once $GLOBALS['project_path']."/view/list_common.html";

				

			break;


			break;

			case "insert_diary":

				# Objeto do Tipo Manager
				$manager = new Manager();

				# Buscar os Clientes
				$clients = $manager->select_common("tb_clients",NULL,NULL," ORDER BY client_name ASC");

				# Buscando os Serviços
				$services = $manager->select_common("tb_services",NULL,NULL," ORDER BY service_name ASC");

				# Buscando os Funcionários
				$functionaries = $manager->select_common("tb_users",NULL,array("profile_id"=>2)," ORDER BY user_name ASC");
				
				# Incluindo o Formulário
				include_once $GLOBALS['project_path']."/view/forms/insert_diary.html";

				
			break;

			case "update_diary":

				
			break;

			case 'painel_admin':
			$manager = new Manager();

				# Contagem dos Usuários
				$clients = $manager->select_common("tb_clients",null,null,null);
				$clients = count($clients);

				# Contagem de Agendamento
				$agends = $manager->select_common("tb_agends",null,null,null);
				$agends = count($agends);

				# Contagem de Aniversariante
				$client_birth = $manager->select_common("tb_clients",null,null,null);
				$client_birth = count($client_birth);

				include_once $GLOBALS['project_path']."/view/painel_admin.html";
				break;

				case 'welcome':
				
				include_once $GLOBALS['project_path']."/view/welcome.html";
				break;
			
		}//end switch

	}//End Function