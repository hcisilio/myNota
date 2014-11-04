<?php
include("../conexao.php");
include("../Classes/classePlanoAula.php");

class PlanoAulaSQL{
	
	var $sql;
	
	function inserir($planoAula){
		$this->sql = "insert into planos_aula (turma, modulo, professor, data, conteudo) values (
		'".$planoAula->getTurma()->getId()."',
		'".$planoAula->getModulo()->getId()."',
		'".$planoAula->getProfessor()->getId()."',
		'".$planoAula->getData()."',
		'".$planoAula->getConteudo()."'
		)";
		return mysql_query($this->sql);
	}
	
	function deletar($id) {
		$this->sql = "delete from planos_aula where id = $id";
		return mysql_query($this->sql);
	}
	
	function listar($id){
		$this->sql = "select * from planos_aula where id = $id";		
		$query = mysql_query($this->sql);
		$linha=mysql_fetch_array($query);
		$planoAula = new PlanoAula();
		$planoAula->setId($linha["id"]);
		$persistir = new ProfessorSQL();
		$planoAula->setProfessor($persistir->listar($linha["professor"]));
		$planoAula->setData($linha["data"]);
		$persistir = new TurmaSQL();
		$planoAula->setTurma($persistir->listar($linha["turma"]));
		$persistir = new ModuloSQL();
		$planoAula->setModulo($persistir->listar($linha["modulo"]));
		$planoAula->setConteudo($linha["conteudo"]);
		$planoAulaArr[] = $planoAula;
		return $planoAula;
	}
	
	function listarMuitos($parametros){
		//Motando a clausura where a partir dos parâmetros
		if ($parametros){
			$wheres = " where ";
			while ($parametro = current($parametros)) {
				if (is_object($parametro)) {
					$wheres .= key($parametros)."='".$parametro->getId()."'";
				}
				else {
					$wheres .= key($parametros)."='".$parametro."'";
				}
								
				if (next($parametros)){
					$wheres .= " and ";
				}				
			}
			$this->sql = "select * from planos_aula".$wheres." order by data desc";
		}
		else {
			$this->sql = "select * from planos_aula order by data desc";
		}
		//Executando a Query			
		$query = mysql_query($this->sql);
		$aulaArr = array();		
		while ($linha=mysql_fetch_array($query)){
			$planoAula = new PlanoAula();
			$planoAula->setId($linha["id"]);
			$persistir = new ProfessorSQL();
			$planoAula->setProfessor($persistir->listar($linha["professor"]));
			$planoAula->setData($linha["data"]);
			$persistir = new TurmaSQL();
			$planoAula->setTurma($persistir->listar($linha["turma"]));
			$persistir = new ModuloSQL();
			$planoAula->setModulo($persistir->listar($linha["modulo"]));
			$planoAula->setConteudo($linha["conteudo"]);
			$planoAulaArr[] = $planoAula;
			unset($planoAula);
		}
		return $planoAulaArr;
	}
	
}

?>