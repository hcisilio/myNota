<?php
include("../conexao.php");
include("../Classes/classePermissao.php");

class PermissaoSQL{
	
	var $sql;
	
	function inserir($permissao){
		$this->sql = "insert into permissoes_paginas values (
		'".$permissao->getPagina()."',
		'".$permissao->getDescricao()."',
		'".$permissao->getNivel()."',		
		'".$permissao->getOrdem()."'
		)";
		return mysql_query($this->sql);
	}
	
	function alterar($permissao){
		$this->sql = "update permissoes_paginas set 
		descricao = '".$permissao->getDescricao()."',
		nivel = '".$permissao->getNivel()."',
		ordem = '".$permissao->getOrdem()."'
		where pagina = '".$permissao->getPagina()."'
		";
		return mysql_query($this->sql);
	}
	
	function deletar($pagina){
		$this->sql = "delete from permissoes_paginas where pagina = '$pagina'";
		return mysql_query($this->sql);
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
		$this->sql = "select * from permissoes_paginas";
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