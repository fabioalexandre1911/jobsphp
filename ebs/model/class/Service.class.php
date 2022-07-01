<?php
	class Service{

		private $service_name;
		private $service_desc;
		private $service_price;


		# Construct Method
		public function __construct($service_name){
		     $this->service_name = $service_name;
		}

		# Set service_name
		public function set_service_name($service_name){
		      $this->service_name = $service_name;
		}

		# GET service_name
		public function get_service_name(){
		      return $this->service_name;
		}

		# Set service_desc
		public function set_service_desc($service_desc){
		      $this->service_desc = $service_desc;
		}

		# GET service_desc
		public function get_service_desc(){
		      return $this->service_desc;
		}

		# Set service_price
		public function set_service_price($service_price){
		      $this->service_price = $service_price;
		}

		# GET service_price
		public function get_service_price(){
		      return $this->service_price;
		}

	}//End Class