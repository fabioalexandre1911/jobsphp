<?php  

	# Mostrando os erros do PHP
	ini_set("display_errors", 1);
	error_reporting(E_ALL | E_PARSE | E_WARNING);			
	# Configuração de Rotas
	$project_name = "ebs/";

	$project_index = "http://".$_SERVER['SERVER_NAME']."/$project_name";

	$project_path = $_SERVER['DOCUMENT_ROOT']."/_bkp/$project_name";

	# Variáveis de ROTA Globalizadas
	$GLOBALS["project_index"] = $project_index; 
	$GLOBALS["project_path"] = $project_path; 

	