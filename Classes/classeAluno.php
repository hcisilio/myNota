<?php
class Aluno{
	var $id;
	var $nome;

	//metodos GET
	function getId(){
		return $this->id;
	}
	function getNome(){
		return $this->nome;
	}
	
	//métodos SET
	function setId($id){
		$this->id = $id;
	}
	function setNome($nome){
		$this->nome = $nome;
	}
	
}
?>