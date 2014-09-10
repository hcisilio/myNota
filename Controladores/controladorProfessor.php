<?php
session_start("mynota");
include ("../ClassesSQL/classeProfessorSQL.php");


class ControladorProfessor {
	
	function inserir(){
		$professor = new professor();
		$professor->setNome($_REQUEST["nome"]);
		$professor->setId($_REQUEST["id"]);
		$professor->setComentario($_REQUEST["obs"]);
		$professor->setSenha(md5($_REQUEST["senha"]));
		$professor->setAcesso($_REQUEST["acesso"]);
		$persistir = new ProfessorSQL();
		$ok = $persistir->inserir($professor);
		if ($ok == true){
			$resultado = "
				<div class='alert alert-success' role='alert'>
					Professor registrado no sistema!
				</div>
			";
		}
		else{
			$resultado = "
				<div class='alert alert-danger' role='alert'>
					Ops! Cadastro de professor não efetuado. <BR />".mysql_error()."
				</div>
			";
		}
		echo $resultado;
	}
	
	function alterar(){
		$persistir = new ProfessorSQL();
		$professor = $persistir->listar($_REQUEST["id"]);
		$professor->setSenha(md5($_REQUEST["senha"]));
		if ($persistir->alterar($professor)){
			$resultado = "
				<div class='alert alert-success' role='alert'>
					Senha alterada com sucesso!
				</div>
			";
		}
		else {
			$resultado = "
				<div class='alert alert-danger' role='alert'>
					Ops! A alteração de senha falhou!. <BR />".mysql_error()."
				</div>
			";
		}
		echo $resultado;
	}
	
	function deletar(){
		
	}
	
	function listar(){
		
	}
	
	function listarTodos(){
		
	}
	
	function login(){
		$login = $_REQUEST["id"];
		$senha = md5($_REQUEST["senha"]);
		$persistir = new ProfessorSQL();
		$professor = $persistir->listar($login);
		if (!$professor) {
			$saida = false;
			echo $saida;
		}
		else {
			if ($senha != $professor->getSenha()){				
				$saida = false;
				echo $saida;
			} 
			else {
				$_SESSION["logado"] = "true";
				$_SESSION["id"] = $login;
				$_SESSION["senha"] = $senha;
				$_SESSION["nome"] = $professor->getNome();
				$_SESSION["acesso"] = $professor->getAcesso();
				echo "home.php";
			}
		}
	}
	
	function logout(){
		$_SESSION['logado'] = "false";
		session_destroy("mynota");
		header("Location: ../GUIs/login.php");
	}
}
?>