<?php  

	# Incluir a Conexão
	include_once 'connect.php';

	global $conn;
	# Função de Inserção Automatizada
	function insert_common($table,$data,$query_extra){

		# Globalizando a conexão
		global $conn;

		# Campos do Banco como Chaves do Array
		$fields = array_keys($data);
		$fields = implode("`, `",$fields);

		# Recebendo os dados
		$values = implode("', '",$data);

		# Montagem da query
		$query = "INSERT INTO `$table`";
		$query .= "(`$fields`) VALUES ";
		$query .= "('$values')";

		# Debug da função - Padrão Comentado
		//echo $query;

		# Enviando a query para o banco
		$ins = mysqli_query($conn,$query);

		if($ins){
			echo "Inserido com sucesso";
		}else{
			echo "Erro!";
		}

	}// fecha insert_common


	function select_common($table, $fields,$filters,$query_extra){

		# Globalizando a Conexão
		global $conn;

		# 1° parte da query
		$query = "SELECT ";

		# Testa se existe o array de campos
		if($fields != NULL){
			$query.= implode(", ", $fields);
		}else{
			$query .= "* ";
		}	

		# 2° Parte da Query
		$query .= " FROM `$table` ";

		# 3° Parte da Query - FILTROS
		if($filters != NULL){
			$query .= " WHERE ";
			foreach($filters as $key=>$value){
				$query .= "`$key` = '$value' AND ";
			}

			# Retirando o and da query
			$query = substr($query, 0, -4);

		}

		# 4° Parte da Query - Query Extra
		if($query_extra != NULL){
			$query .= $query_extra;
		}

		//echo $query;

		# Enviando a query para o banco
		$result = mysqli_query($conn,$query) or die(mysqli_error($conn));

		
		# Testando o resultado
		//Se ele vier vazio ou falso
		if($result == false){
			//salva no array de dados FALSE
			$data = false;
		}else{
			//Senão ele salva todos os campos dentro do array data
			$data;
			while ($row = mysqli_fetch_assoc($result)) {
				$data[] = $row;
			}
		}

		# Retornar os dados em array
		return @$data;


	}//fecha select_common


	function delete_common($table, $filters, $query_extra){

		//Globalizando a conexão
		global $conn;

		# 1° Parte da Query - Inicio
		$query = " DELETE FROM `$table` ";

		# 2° Parte da Query - filtros
		if($filters != null){
			$query .= " WHERE ";
			foreach ($filters as $key => $value) {
				$query .= "`$key` = '$value' AND ";
			}

			// Retirando o ultimo AND da consulta(query)
			$query = substr($query, 0, -4);
				
		}

		# 3° Parte da Query - testar se existe query_extra
		if($query_extra != null){
			//se existir query extra, concatena
			$query .= $query_extra;
		}

		# Enviando a query pro banco
		$result = mysqli_query($conn,$query) or die(mysqli_error($conn));			

		return $result;


	}//fecha delete_common

	function update_common($table, $new_data,$filters, $query_extra){
		//Globalizando a conexão
		global $conn;
		

		# 1° Parte da Query - Inicio
		$query = "UPDATE `$table` SET ";

		# 2° Parte da Query - Dados
		foreach ($new_data as $field=>$new_value) {
			$query .= " `$field` = '$new_value', ";	 
		}

		# Retirando a ultima virgula da query
		$query = substr($query, 0, -2);

		# 3° Parte da query - Filtros
		if($filters != NULL){
			$query .= " WHERE ";
			foreach ($filters as $key => $value) {
				$query .= "`$key` = '$value' AND ";
			}
		}

		# Retirando o AND da query
		$query = substr($query, 0, -4);

		# 4° Parte da Query - Extras
		if($query_extra != NULL){
			$query .= $query_extra;
		}

		$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

		return $result;

	}//fecha update_common

	function select_special($tables, $filters, $query_extra){

			// Globalizando a Conexão
			global $conn;

			# Iniciando a Query
			$query = "SELECT ";

			//informando colunas a serem selecionadas
			foreach ($tables as $table=>$fields){
				if(!empty($fields)){
					foreach ($fields as $each_field){
						$query .= "$table.$each_field, ";
					}
				}else{
					$query .= "$table.*, "; //quando as colunas nao forem informadas
				}
			}
			
			//removendo ultima "," 
			$query = substr($query, 0, -2);
			
			//inner join's
			$tables_names = array_keys($tables);

			# Continuando a query, e informando com o INNER JOIN as tabelas a serem relacionadas
			$query .= " FROM ".implode(", ", $tables_names);
			
			# Colocando os relacionamentos na query
			$query .= " WHERE ";
			foreach($filters as $foreign=>$primary){
				$query .= "$foreign=$primary AND "; 
			}

			//removendo ultimo "AND" dos RELACIONAMENTOS
			$query = substr($query, 0, -4);

			
			//se a consulta precisar de algo mais..
			if($query_extra != ""){
				$query .= $query_extra;
			}

			# apenas para testar a query (descomente o echo) - PADRÃO - COMENTADO
			echo $query;

	}		
?>