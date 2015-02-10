<?php

include("../conexao.php");
include_once("../Classes/classeTurma.php");
include_once("../Classes/classeDia.php");
include_once("../ClassesSQL/classeProfessorSQL.php");
include_once("../ClassesSQL/classeCursoSQL.php");


class TurmaSQL{

	var $sql;

	function inserir($turma){
		$this->sql = "insert into turmas values (
		'".$turma->getId()."',
		'".$turma->getProfessor()->getID()."',
		'".$turma->getCurso()->getId()."',
		'".$turma->getStatus()."'		
		)";
		return mysql_query($this->sql);
	}

	function alterar($turma){
		$this->sql = "update turmas set
		professor = '".$turma->getProfessor()->getId()."',
		curso = '".$turma->getCurso()->getId()."',
		status = '".$turma->getStatus()."'
		where id = '".$turma->getId()."'
		";
		return mysql_query($this->sql);
	}

	function deletar($turma){

	}

	function listar($id){
		$this->sql = "select * from turmas where id = \"$id\"";
		$query = mysql_query($this->sql);
		$linha=mysql_fetch_array($query);
		$turma = new Turma();
		$turma->setId($linha["id"]);
		$professor = new ProfessorSQL();
		$turma->setProfessor($professor->listar($linha["professor"]));
		$curso = new CursoSQL();
		$turma->setCurso($curso->listar($linha["curso"]));
		$turma->setStatus($linha["status"]);
		return $turma;
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
			$this->sql = "select * from turmas".$wheres;
		}
		else {
			$this->sql = "select * from turmas";
		}
		//Executando a Query		
		$query = mysql_query($this->sql);
		$turmaArr = array();
		while ($linha=mysql_fetch_array($query)){
			$turma = new Turma();
			$turma->setId($linha["id"]);
			$professor = new ProfessorSQL();
			$turma->setProfessor($professor->listar($linha["professor"]));
			$curso = new CursoSQL();
			$turma->setCurso($curso->listar($linha["curso"]));
			$turma->setStatus($linha["status"]);
			//$dias = $this->diasDeAula($linha["id"]);
			//$turma->setDia($dias);
			$turmaArr[] = $turma;
			unset ($turma);
		}
		return $turmaArr;
	}
	
	### outras funções	
	
	function turmasDoAluno($aluno){
		$this->sql = "select * from turmas where id in (select turma from aluno_turma where aluno = '".$aluno->getId()."')";		
		$query = mysql_query($this->sql);
		$turmaArr = array();
		while ($linha=mysql_fetch_array($query)){
			$turma = new Turma();
			$turma->setId($linha["id"]);
			$professor = new ProfessorSQL();
			$turma->setProfessor($professor->listar($linha["professor"]));
			$curso = new CursoSQL();
			$turma->setCurso($curso->listar($linha["curso"]));
			$turma->setStatus($linha["status"]);
			//$turma->setDia($linha["dia"]);
			$turmaArr[] = $turma;
			unset ($turma);
		}
		return $turmaArr;
	}	
	
	//funções para manipular os dias de aula das turmas

	function DiaTurma($dia,$turma){
		$this->sql = "insert into turma_dia values ('$turma',$dia)";
		return mysql_query($this->sql);
	}

	function removerDias($turma){
		$this->sql = "delete from turma_dia where turma = '$turma'";
		return mysql_query($this->sql);
	}
	
	function diasDeAula($turma) {
		$this->sql = "select * from dias where id in (select dia from turma_dia where turma = '$turma')";
		$query = mysql_query($this->sql);
		$diasArr = array();
		while ($linha=mysql_fetch_array($query)){
			$dia = new Dia();
			$dia->setId($linha["id"]);
			$dia->setNome($linha["nome"]);
			$diasArr[] = $dia;
			unset ($dia);
		}
		return $diasArr;
	}

}

?>