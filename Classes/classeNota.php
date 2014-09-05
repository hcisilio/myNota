<?php
class Nota{
	
	var $aluno;	
	var $modulo;
	var $nota;
	
	//metodos get
	function getAluno(){
		return $this->aluno;
	}
	function getModulo(){
		return $this->modulo;
	}
	function getNota(){
		return $this->nota;
	}
	
	//metodos set
	function setAluno($aluno){
		$this->aluno = $aluno;
	}
	function setModulo($modulo){
		$this->modulo = $modulo;
	}
	function setNota($nota){
		$this->nota = $nota;
	}
	
}
?>