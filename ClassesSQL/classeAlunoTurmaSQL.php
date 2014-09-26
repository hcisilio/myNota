<?php

include("../conexao.php");
include_once("../Classes/classeAlunoTurma.php");
include_once("../ClassesSQL/classeAlunoSQL.php");
include_once("../ClassesSQL/classeTurmaSQL.php");

class AlunoTurmaSQL{
	
	var $sql;
	
	function inserir($alunoTurma){
		$this->sql = "insert into aluno_turma values (
		'".$alunoTurma->getAluno()->getId()."',
		'".$alunoTurma->getTurma()->getId()."'
		)";
		return mysql_query($this->sql);
	}
	
	function transferir($alunoTurma, $novaTurma){
		$this->sql = "update aluno_turma set
		turma = '$novaTurma'
		where aluno = '".$alunoTurma->getAluno()->getId()."' and turma = '".$alunoTurma->getTurma()->getId()."'
		";
		return mysql_query($this->sql);
	}
	
	function deletar(){
		
	}
	
	/*function checarMatricula($aluno, $curso){
		$this->sql = "select * from aluno_turma where aluno='$aluno' and turma in (select id from turmas where curso = $curso)";
		$query = mysql_query($this->sql);
		/-$linha=mysql_fetch_array($query);
		$alunoTurmaArr = array();
		while ($linha=mysql_fetch_array($query)) {
			$aluno_turma = new AlunoTurma();
			$aluno = new AlunoSQL();
			$aluno_turma->setAluno($aluno->listar($linha["aluno"]));
			$turma = new TurmaSQL();
			$aluno_turma->setTurma($turma->listar($linha["turma"]));
			$alunoTurmaArr[] = $aluno_turma;
			unset ($aluno_turma);
		}
		return $alunoTurmaArr[];-/	
		$check = mysql_num_rows($query);
		return $check;		
	}*/	
	
}

?>