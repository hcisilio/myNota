<?php
class PlanoAula {
	var $id;
	var $turma;
	var $modulo;
	var $professor;
	var $data;
	var $conteudo;
	
	function getId(){
		return $this->id;
	}
	function getTurma(){
		return $this->turma;
	}
	function getModulo(){
		return $this->modulo;
	}
	function getProfessor(){
		return $this->professor;
	}
	function getData(){
		return $this->data;
	}
	function getConteudo(){
		return $this->conteudo;
	}
	
	function setId($id){
		$this->id = $id;
	}
	function setTurma($turma){
		$this->turma = $turma;
	}
	function setModulo($modulo){
		$this->modulo = $modulo;
	}
	function setProfessor($professor){
		$this->professor = $professor;
	}
	function setData($data){
		$this->data = $data;
	}
	function setConteudo($conteudo){
		$this->conteudo = $conteudo;
	}
}