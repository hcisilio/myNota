<?php
class AlunoTurma{
	var $aluno;
	var $turma;
	
	//metodos GET
	function getAluno(){
		return $this->aluno;
	}
	function getTurma(){
		return $this->turma;
	}
	
	//metodos SET
	function setAluno($aluno){
		$this->aluno = $aluno;
	}
	function setTurma($turma){
		$this->turma = $turma;
	}
}
?>