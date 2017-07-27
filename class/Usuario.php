<?php 

	class Usuario {

		private $idusuario;
		private $deslogin;
		private $dessenha;
		private $dtcadastro;

		public function getIdusuario(){
			return $this -> idusuario;
		}

		public function setIdusuario($value){
			$this -> idusuario = $value;
		}

		public function getDeslogin(){
			return $this -> deslogin;
		}

		public function setDeslogin($value){
			$this -> deslogin = $value;
		}

		public function getDessenha(){
			return $this -> dessenha;
		}

		public function setDessenha($value){
			$this -> dessenha = $value;
		}

		public function getDtcadastro(){
			return $this -> dtcadastro;
		}

		public function setDtcadastro($value){
			$this -> dtcadastro = $value;
		}

		public function loadByid($id){

			$sql = new Sql();

			// lista apenas um usuário específico
			$results = $sql -> select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
				":ID" => $id
			));

			if (isset($results[0])) {

				$this -> setData($results[0]);

			}
		}

		// lista todo mundo que está na tabela
		public static function getList(){
			$sql = new Sql();

			return $sql -> select("SELECT * FROM tb_usuarios ORDER BY deslogin;");

		}

		public static function search($login){

			$sql = new Sql();

			return $sql -> select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(

				':SEARCH' => "%" . $login . "%"
			));
		}

		public function login($login, $password){

			$sql = new Sql();

			// lista apenas um usuário específico
			$results = $sql -> select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :PASSWORD", array(
				":LOGIN" => $login,
				":PASSWORD" => $password
			));

			if (isset($results[0])) {

				$this -> setData($results[0]);				

			} else {

				throw new Exception("Login e/ou senha inválidos", 1);

			}
		}

		public function insert(){
	
			$sql = new Sql();

			$results = $sql -> select("CALL sp_usuarios_insert(:LOGIN,:PASSWORD)", array(
				":LOGIN" => $this -> getDeslogin(),
				":PASSWORD" => $this -> getDessenha()
			));		

			if (isset($results[0])){

				$this -> setData($results[0]);

			}	
		}

		public function update($login, $password){

			$this -> setDeslogin($login);
			$this -> setDessenha($password);

			$sql = new Sql();

			$sql -> query("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :PASSWORD WHERE idusuario = :ID", array(

				":LOGIN" =>$this -> getDeslogin(),
				":PASSWORD" => $this -> getDessenha(),
				":ID" => $this -> getIdusuario()
			));

		}

		public function __construct($login = "", $senha = ""){

			$this -> setDeslogin($login);
			$this -> setDessenha($senha);

		}

		public function setData($data){

			$this -> setIdusuario($data['idusuario']);
			$this -> setDeslogin($data['deslogin']);
			$this -> setDessenha($data['dessenha']);
			$this -> setDtcadastro(new DateTime($data['dtcadastro']));

		}

		// converte para string os valores que estão dentro das arrays
		public function __toString(){

			return json_encode(array(

				"idusuario" => $this -> getIdusuario(),
				"deslogin" => $this -> getDeslogin(),
				"dessenha" => $this -> getDessenha(),
				"dtcadastro" => $this -> getDtcadastro() -> format("d/m/Y H:i:s")
			
			));
		}

	}

 ?>