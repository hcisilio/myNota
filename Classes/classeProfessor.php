<?php
class Professor{
	
	var $id;
	var $nome;
	var $comentario;
	var $senha;
	var $acesso;
	var $ativo;
	
	//metodos get
	function getId(){
		return $this->id;
	}
	function getNome(){
		return $this->nome;
	}
	function getComentario(){
		return $this->comentario;
	}
	function getSenha(){
		return $this->senha;
	}
	function getAcesso(){
		return $this->acesso;
	}
	function getAtivo(){
		return $this->ativo;
	}
	
	//metodos set
	function setId($id){
		$this->id = $id;
	}
	function setNome($nome){
		$this->nome = $nome;
	}
	function setComentario($comentario){
		$this->comentario = $comentario;
	}
	function setSenha($senha){
		$this->senha = $senha;
	}
	function setAcesso($acesso){
		$this->acesso = $acesso;
	}
	function setAtivo($ativo){
		$this->ativo = $ativo;
	}
	
}
?>