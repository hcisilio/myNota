<?php 
class Dia{

	var $id;
	var $nome;
	
	function getId(){
		return $this->id;
	}
	function getNome(){
		return $this->nome;
	}
	
	function setId($id){
		$this->id = $id;
	}
	function setNome($nome){
		$this->nome = $nome;
	}
	
}
?>