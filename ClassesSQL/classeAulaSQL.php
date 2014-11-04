<?php
include("../conexao.php");
include("../Classes/classeAula.php");

class AulaSQL{
	
	var $sql;
	
	function inserir($aula){
		$this->sql = "insert into aulas (turma, professor, data, conteudo) values (
		'".$aula->getTurma()->getId()."',
		'".$aula->getProfessor()->getId()."',
		'".$aula->getData()."',
		'".$aula->getConteudo()."'
		)";
		return mysql_query($this->sql);
	}
	
	function deletar($id) {
		$this->sql = "delete from aulas where id = $id";
		return mysql_query($this->sql);
	}
	
	function listarMuitos($parametros){
		//Motando a clausura where a partir dos parâmetros
		if ($parametros){
			$wheres = " where ";
			while ($parametro = current($parametros)) {
				$wheres .= key($parametros)."='".$parametro."'";				
				if (next($parametros)){
					$wheres .= " and ";
				}
			}
			$this->sql = "select * from aulas".$wheres." order by data desc";
		}
		else {
			$this->sql = "select * from aulas order by data desc";
		}
		//Executando a Query				
		$query = mysql_query($this->sql);
		$aulaArr = array();		
		$persistir = new ProfessorSQL();
		while ($linha=mysql_fetch_array($query)){
			$aula = new Aula();
			$aula->setId($linha["id"]);
			$aula->setProfessor($persistir->listar($linha["professor"]));
			$aula->setData($linha["data"]);
			$aula->setTurma($linha["turma"]);
			$aula->setConteudo($linha["conteudo"]);
			$aulaArr[] = $aula;
			unset($aula);
		}
		return $aulaArr;
	}
	
}

?>