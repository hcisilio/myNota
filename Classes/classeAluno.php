<?php
class Aluno{
	var $id;
	var $nome;
	var $mail;

	//metodos GET
	function getId(){
		return $this->id;
	}
	function getNome(){
		return $this->nome;
	}
	function getMail(){
		return $this->mail;
	}
	
	//métodos SET
	function setId($id){
		$this->id = $id;
	}
	function setNome($nome){
		$this->nome = $nome;
	}
	function setMail($mail){
		$this->mail = $mail;
	}
	
}
?>