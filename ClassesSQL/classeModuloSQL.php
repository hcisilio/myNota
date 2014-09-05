<?php
include("../conexao.php");
include("../Classes/classeModulo.php");

class ModuloSQL {
	
	var $sql;
	
	function listarPorTurma($turma){
		$id = $turma->getId();
		$this->sql = "select * from modulos where curso in ( select curso from turmas where id = \"$id\" )";
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