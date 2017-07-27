<?php 

	require_once("config.php");

	/* $sql = new Sql();

	$usuarios = $sql -> select("SELECT * FROM tb_usuarios");

	echo json_encode($usuarios); */

	// Carrega um usuário
	// $root = new Usuario();
	// $root -> loadByid(3);
	// echo $root;

	// Carrega uma lista de usuários
	// $lista = Usuario::getList();
	// echo json_encode($lista);

	// Carrega uma lista de usuários buscando pelo login
	// $busca = Usuario::search("ao");
	// echo json_encode($busca);

	// Carrega um usuário usando o login e a senha
	$usuario = new Usuario();
	$usuario -> login("Jose","1234");
	echo $usuario;

 ?>