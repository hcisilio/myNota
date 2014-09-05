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
			$_SESSION["msg"] = "professor registrado no sistema!";
			header ("location: ../GUIs/sucesso.php");
		}
		else{
			$_SESSION["msg"] = "Ops! Cadastro de professor não efetuado.";
			$_SESSION["erro"] = mysql_error();
			header ("location: ../GUIs/erro.php");
		}
	}
	
	function alterar(){
		$persistir = new ProfessorSQL();
		$professor = $persistir->listar($_REQUEST["id"]);
		$professor->setSenha(md5($_REQUEST["senha"]));
		if ($persistir->alterar($professor)){
			//$_SESSION["msg"] = "Senha alterada com sucesso!";
			//header ("location: ../GUIs/saidas/sucesso.php");
			$txt = "Senha alterada";
			echo $txt;
		}
		else {
			//$_SESSION["msg"] = "Ops! Senha não foi alterada!";
			//$_SESSION["erro"] = mysql_error();
			//header ("location: ../GUIs/saidas/erro.php");
			$txt = mysql_error();
			echo $txt;
		}
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
			//$_SESSION["erro"] = 1;
			//header("Location: ../GUIs/login.php");
			return false;
		}
		else {
			if ($senha != $professor->getSenha()){				
				//$_SESSION["erro"] = 2;
				//header("Location: ../GUIs/login.php");
				return false;
			} 
			else {
				//$_SESSION["erro"] = 0;
				$_SESSION["logado"] = "true";
				$_SESSION["id"] = $login;
				$_SESSION["senha"] = $senha;
				$_SESSION["nome"] = $professor->getNome();
				$_SESSION["acesso"] = $professor->getAcesso();
				$acesso = $professor->getAcesso(); 				
				//header("Location: ../GUIs/home$acesso.php");	
				return "home$acesso.php";
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