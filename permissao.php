<?php

	session_start("mynota");
	
	//checa se o usuario já está logado
	if ($_SESSION["logado"] <> "true") {
		header("Location: login.php");
	}
	
	//transforma permissões string para códigos int		
	if ($_SESSION["acesso"] == "Administrador") {
		$meuAcesso = 0;
	}
	else if ($_SESSION["acesso"] == "Diretor") {
		$meuAcesso = 1;
	}
	else if ($_SESSION["acesso"] == "Professor") {
		$meuAcesso = 2;
	}
	else {
		$meuAcesso = 99;
	}
	
	//consulta o nível de permissão da página atual
	include_once("conexao.php");
	$acessoPagina = mysql_fetch_array(
						mysql_query(
							" select nivel from permissoes_paginas where pagina = '".end(explode("/", $_SERVER['PHP_SELF']))."' "
						)	
					);
	
	//Checa o acesso do usuário para a página atual
	if ($meuAcesso > $acessoPagina["nivel"]){
		header("Location: acessoNegado.php");
	}
	
	/*class Permissao {
		
		var $acesso; //Acesso do usuário em forma legível (string)
		var $meuAcesso; //Acesso do usuário em forma numérica (int)
		var $nivelAcessoPagina; //Nível de acesso permitido para acessar a página
		
		//inicialização da classe
		function permissao($nivelAcessoPagina){
			$this->nivelAcessoPagina = $nivelAcessoPagina;
			$this->acesso = $_SESSION["acesso"];
			if ($this->acesso == "Administrador") {
				$this->meuAcesso = 0;
			}
			else if ($this->acesso == "Diretor") {
				$this->meuAcesso = 1;
			}
			else if ($this->acesso == "Professor") {
				$this->meuAcesso = 2;
			}
			$this->teste;
			$this->estouLogado();
			$this->checarAcesso();
		}
		
		//teste de login ativo
		function estouLogado() {
			if ($_SESSION["logado"] <> "true") {
				header("Location: login.php");
			}
			else {
				return True;
			}
		}
		
		//Testes de nível de acesso	
		function checarAcesso() {
			
			if ($this->meuAcesso > $this->nivelAcessoPagina){
				header("Location: acessoNegado.php");
			}
			else {
				return True;
			}
			
		}

	}/*
	

?>