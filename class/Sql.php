<?php 

	class Sql extends PDO {

		private $conn;

		public function __construct(){

			$this -> conn = new PDO("mysql:host=localhost;dbname=dbphp7","root","");
		}

		private function setParams($statment, $parameters = array()){

			foreach ($parameters as $key => $value) {
				# code...
				$this -> bindParam($key, $value);

			}

		}

		private function setParam($statement, $key, $value){

			$statement -> bindParam($key, $value);
		}

		public function query($rawQuery, $params = array()){ //$params é onde vai receber os nossos dados, por isso é do tipo array

			$stmt = $this -> conn -> prepare($rawQuery);

			$this -> setParams($stmt, $params);

			$stmt -> execute();

			return $stmt;

		}

		public function select($rawQuery, $params = array()):array {

			$stmt = $this -> query($rawQuery, $params);

			return $stmt -> fetchALL(PDO::FETCH_ASSOC); // FETCH_ASSOC é para ver os dados associativos, sem os indices

		}

	}	

 ?>