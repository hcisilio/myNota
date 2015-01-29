<?php
include("../conexao.php");
include("../Classes/classeNota.php");

class NotaSQL {

	var $sql;
	
	function inserir($nota){
		$this->sql = "insert into notas values (
		'".$nota->getAluno()->getId()."',
		'".$nota->getModulo()->getId()."',
		'".$nota->getNota()."'
		)";
		return mysql_query($this->sql);		
	}
	
	function alterar($nota){
		$this->sql = "update notas set nota = ".$nota->getNota()." where aluno = '".$nota->getAluno()."' and modulo = ".$nota->getModulo()." ";
		return mysql_query($this->sql);
	}	
	
	function pegarNota($aluno,$modulo) {		
		$this->sql = "select * from notas where aluno = '".$aluno->getId()."' and modulo = ".$modulo->getId();
		$query = mysql_query($this->sql);
		$linha = mysql_fetch_array($query);
		$nota = new Nota();
		$nota->setAluno($linha["aluno"]);
		$nota->setModulo($linha["modulo"]);
		$nota->setNota($linha["nota"]);
		return $nota;		
	}
}

?>