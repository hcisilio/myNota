<?php
include("../conexao.php");
include("../Classes/classeModulo.php");

class ModuloSQL {
	
	var $sql;
	
	function listar($id){
		$this->sql = "select * from modulos where id = $id";
		$query = mysql_query($this->sql);
		$linha = mysql_fetch_array($query);
		$modulo = new Modulo();
		$modulo->setId($linha["id"]);
		$modulo->setNome($linha["nome"]);
		return $modulo;
	}
	
	function listarPorTurma($turma){
		$this->sql = "select * from modulos where curso in ( select curso from turmas where id = '".$turma->getId()."')";
		$query = mysql_query($this->sql);
		$moduloArr = array();
		while ($linha = mysql_fetch_array($query)){
			$modulo = new Modulo();
			$modulo->setId($linha["id"]);
			$modulo->setNome($linha["nome"]);
			$moduloArr [] = $modulo;
			unset($modulo);
		}
		return $moduloArr;
	}
}
?>