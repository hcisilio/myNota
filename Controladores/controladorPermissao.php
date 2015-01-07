<?php
session_start("mynota");
include ("../ClassesSQL/classePermissaoSQL.php");

class ControladorPermissao {	
	
	var $meuAcesso;
	
	function __construct(){
		//checa se o usuario já está logado
		if ($_SESSION["logado"] <> "true") {
			header("Location: login.php");
		}
		else {
			//transforma permissões string para códigos int		
			if ($_SESSION["acesso"] == "Administrador") {
				$this->meuAcesso = 0;
			}
			else if ($_SESSION["acesso"] == "Diretor") {
				$this->meuAcesso = 1;
			}
			else if ($_SESSION["acesso"] == "Professor") {
				$this->meuAcesso = 2;
			}
			else {
				//Usuário com perfil desconhecido receberá um código que o impedirá de acessar qualquer página
				$this->meuAcesso = 99;
			}
		}
	}
	
	function autorizarAcesso($pagina){
		//consulta o nível de permissão da página atual
		$persistir = new PermissaoSQL();
		$acessoPagina = $persistir->listar($pagina)->getNivel();
		//Checa o acesso do usuário para a página atual
		if ($this->meuAcesso > $acessoPagina){
			header("Location: acessoNegado.php");
		}
	}
	
	function criarMenu(){
		$menu = "<a href='home.php' class='list-group-item active'> Página Inicial </a>";
		$persistir = new PermissaoSQL();
		foreach ($persistir->listarMinhasPaginas($this->meuAcesso) as $pagina) {
			$menu .= "<a href='../GUIs/".$pagina->getPagina()."' class='list-group-item'>".$pagina->getDescricao()."</a>";
		}
		echo $menu;
	}
	
}

?>