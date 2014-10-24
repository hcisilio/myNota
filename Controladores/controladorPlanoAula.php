<?php
session_start("mynota");
include ("../ClassesSQL/classePlanoAulaSQL.php");
include ("../ClassesSQL/classeTurmaSQL.php");
include ("../ClassesSQL/classeModuloSQL.php");

class ControladorPlanoAula {	
	
	function inserir(){
		$planoAula = new PlanoAula();
		$persistir = new TurmaSQL();
		$planoAula->setTurma($persistir->listar($_REQUEST["turma"]));
		$persistir = new ModuloSQL();
		$planoAula->setModulo($persistir->listar($_REQUEST["modulo"]));
		$persistir = new ProfessorSQL();
		$planoAula->setProfessor($persistir->listar($_SESSION["id"]));
		$planoAula->setConteudo($_REQUEST["conteudo"]);	
		$planoAula->setData( implode("-", array_reverse(explode("/", $_REQUEST["data"]))) );
		$persistir = new PlanoAulaSQL();
		$persistir->inserir($planoAula);
	}
	
	function deletar(){
		$persistir = new PlanoAulaSQL();
		return $persistir->deletar($_REQUEST["id"]);
	}
	
	function listarPorTurma($turma){
		$persistir = new PlanoAulaSQL();
		return $persistir->listarPorTurma($turma);		
	}
	
}

?>