<?php

	session_start("mynota");
	
	//checa se o usuario já está logado
	if ($_SESSION["logado"] <> "true") {
		header("Location: login.php");
	}
	else {
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
			//Usuário com perfil desconhecido receberá um código que o impedirá de acessar qualquer página
			$meuAcesso = 99;
		}
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
	

?>