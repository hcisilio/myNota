<?php
class Turma{
	
	var $id;
	var $professor;
	var $curso;
	var $status;
	//var $dia;
	
	//metodos get
	function getId(){
		return $this->id;	
	}
	function getProfessor(){
		return $this->professor;
	}
	function getCurso(){
		return $this->curso;
	}
	function getStatus(){
		return $this->status;
	}
	/*function getDia(){
		return $this->dia;
	}*/
	
	//metodos set
	function setId($id){
		$this->id = $id;
	}
	function setProfessor($professor){
		$this->professor = $professor;
	}
	function setCurso($curso){
		$this->curso = $curso;
	}
	function setStatus($status){
		$this->status = $status;
	}
	/*function setDia($dia){
		$this->dia = $dia;
	}*/
	
}
?>