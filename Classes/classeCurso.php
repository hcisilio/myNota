<?php
class Curso{
	var $id;
	var $descricao;

	//metodos GET
	function getId(){
		return $this->id;
	}
	function getDescricao(){
		return $this->descricao;
	}

	//métodos SET
	function setId($id){
		$this->id = $id;
	}
	function setDescricao($descricao){
		$this->descricao = $descricao;
	}

}
?>