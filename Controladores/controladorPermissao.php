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
	
	function inserir(){
		$permissao = new Permissao();
		$permissao->setPagina($_REQUEST["pagina"]);
		$permissao->setDescricao($_REQUEST["descricao"]);
		$permissao->setOrdem($_REQUEST["ordem"]);
		$permissao->setNivel($_REQUEST["nivel"]);
		$persistir = new PermissaoSQL();
		if ($persistir->inserir($permissao)){
			$resultado = "
				<div class='alert alert-success' role='alert'>
					Nova página registrada no sistema!
				</div>
			";
		}
		else {
			$resultado = "
				<div class='alert alert-danger' role='alert'>
					Ops! Cadastro da páginanão efetuado. <BR />".mysql_error()."
				</div>
			";
		}
		echo $resultado;
	}
	
	function alterar(){
		$persistir = new PermissaoSQL();
		$permissao = $persistir->listar($_REQUEST["pagina"]);
		$permissao->setDescricao($_REQUEST["descricao"]);
		$permissao->setOrdem($_REQUEST["ordem"]);
		$permissao->setNivel($_REQUEST["nivel"]);
		if ($persistir->alterar($permissao)){
			$resultado = "
				<div class='alert alert-success' role='alert'>
					Configurações da página alterada com sucesso! (:
				</div>
			";
		}
		else {
			$resultado = "
				<div class='alert alert-danger' role='alert'>
					Erro! Não foi possível gravar as alterações na página ): <BR />".mysql_error()."
				</div>
			";
		}
		echo $resultado;
	}
	
	function deletar() {
		$persistir = new PermissaoSQL();
		if ($persistir->deletar($_REQUEST["pagina"])){
			$resultado = "
				<div class='alert alert-success' role='alert'>
					Página ".$_REQUEST["pagina"]." removida do sistema!
				</div>
			";
		}
		else {
			$resultado = "
				<div class='alert alert-danger' role='alert'>
					Ops! Página ".$_REQUEST["pagina"]." não pode ser removida <BR />".mysql_error()."
				</div>
			";
		}
		echo $resultado;
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
	
	function gerenciarPaginas(){
		$n = 0;
		$persistir = new PermissaoSQL();
		foreach ($persistir->listarTodos() as $pagina) {
			$form = "
				<tr>
					<form id='paginas$n' class='form-inline' role='form' method='GET'>					
						<td><input id='pagina$n' class='edits nuloOUvazio' type='text' value='".$pagina->getPagina()."' readonly></td>
						<td><input id='descricao$n' class='edits nuloOUvazio' type='text' value='".$pagina->getDescricao()."'></td>
						<td><input id='nivel$n' class='edits nuloOUvazio' size='10' type='text' value=".$pagina->getNivel()."></td>
						<td><input id='ordem$n' class='edits nuloOUvazio' size='10' type='text' value=".$pagina->getOrdem()."></td>
						<td><a href='JavaScript:atualizar($n)'> <img src='Imagens/save.png' height='28'> </a></td>
						<td><a href='JavaScript:deletar($n)'> <img src='Imagens/delete-icon.png' height='28'> </a></td>
					</form>
				</tr>
			";
			echo $form;
			$n++;
		}
	}
	
}

?>