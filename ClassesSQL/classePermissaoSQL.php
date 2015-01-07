<?php
include("../conexao.php");
include("../Classes/classePermissao.php");

class PermissaoSQL{
	
	var $sql;
	
	function inserir($permissao){

	}
	
	function alterar(){
		
	}
	
	function deletar(){
		
	}
	
	function listar($pagina){
		$linha = mysql_fetch_array(
							mysql_query(
								" select * from permissoes_paginas where pagina = '$pagina' "
							)	
						);
		$permissao = new Permissao();
		$permissao->setPagina($linha["pagina"]);
		$permissao->setDescricao($linha["descricao"]);
		$permissao->setNivel($linha["nivel"]);
		$permissao->setOrdem($linha["ordem"]);
		return $permissao;
	}
	
	function listarTodos(){

	}
	
	### outras funções
	
	function listarMinhasPaginas($meuAcesso){
		$this->sql = "select * from permissoes_paginas where nivel >= $meuAcesso and pagina <> 'home.php' and pagina <> 'TrocaSenha.php' order by ordem";
		$query = mysql_query($this->sql);
		$permissaoArr = array();
		while ($linha = mysql_fetch_array($query)){
			$permissao = new Permissao();
			$permissao->setPagina($linha["pagina"]);
			$permissao->setDescricao($linha["descricao"]);
			$permissao->setNivel($linha["nivel"]);
			$permissao->setOrdem($linha["ordem"]);
			$permissaoArr [] = $permissao;
			unset($permissao);
		}
		return $permissaoArr;		
	}
}
?>