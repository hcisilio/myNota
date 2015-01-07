<?php
class Permissao{
	var $pagina;
	var $descricao;
	var $nivel;
	var $ordem;

	//metodos GET
	function getPagina(){
		return $this->pagina;
	}
	function getDescricao(){
		return $this->descricao;
	}
	function getNivel(){
		return $this->nivel;
	}
	function getOrdem(){
		return $this->ordem;
	}
	
	//métodos SET
	function setPagina($pagina){
		$this->pagina = $pagina;
	}
	function setDescricao($descricao){
		$this->descricao = $descricao;
	}
	function setNivel($nivel){
		$this->nivel = $nivel;
	}
	function setOrdem($ordem){
		$this->ordem = $ordem;
	}
	
}
?>