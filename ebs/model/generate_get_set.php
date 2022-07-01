<?php  

	ini_set("display_errors", 1);
	
	function generate($class,$fields,$cons=NULL){

		# Criando a classe Inicial
		echo 'class '.$class."{ <br>";
		echo "<br>";
		foreach ($fields as $value) {
			echo 'private $'.$value.";<br>";
		}
		echo "<br>";
		echo "<br>";

		if($cons != NULL){
			echo "# Construct Method <br>";
			echo 'public function __construct(';
				$c = "";	
				foreach ($cons as $value) {
					$c .= "$".$value. ", ";
				}
				$c = substr($c, 0,-2);
				echo $c."){ <br>";

				foreach ($cons as $value) {
					echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
					echo '$this->'.$value." = $".$value."; <br>";
				}

			echo "}";	
		}
		echo "<br><br>";

		foreach ($fields as $value) {
			echo '# Set '.$value."<br>";
			echo 'public function set_'.$value.'($'.$value.'){'."<br>";
			for ($i=0; $i <=5 ; $i++) { 
				echo "&nbsp";
			}
			echo '$this->'.$value." = $".$value.";<br>";
			echo "}";

			echo "<br><br>";

			echo '# GET '.$value."<br>";
			echo 'public function get_'.$value.'(){'."<br>";
			for ($j=0; $j <=5 ; $j++) { 
				echo "&nbsp";
			}
			echo 'return $this->'.$value.";<br>";
			echo "}";

			echo "<br><br>";
		}
		echo "}//End Class";

	}

	$fields[] = "service_name";
	$fields[] = "service_desc";
	$fields[] = "service_price";
	
	$cons[] = "service_name";

	generate("Service",$fields,$cons);


?>