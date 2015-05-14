<?php
class Modulo{

	var $id;
	var $nome;
	var $curso;

	//metodos get
	function getId(){
		return $this->id;
	}
	function getNome(){
		return $this->nome;
	}
	function getCurso(){
		return $this->curso;
	}

	//metodos set
	function setId($id){
		$this->id = $id;
	}
	function setNome($nome){
		$this->nome = $nome;
	}
	function setCurso($curso){
		$this->curso = $curso;
	}

}
?>