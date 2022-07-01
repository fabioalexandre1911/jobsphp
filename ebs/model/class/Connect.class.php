<?php

	class Connect{
		
		public static $instance;

		public function __construct(){
 
		}


		public static function get_instance(){
			if(!isset(self::$instance)){
				self::$instance = new PDO('mysql:host=factodigital.com.br;dbname=factodigitalcom_ebs;', 'factodigitalcom_root', '4F_QEA;uY}eZ', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
				self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				self::$instance->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
			}

			return self::$instance;
		}
	}
?>