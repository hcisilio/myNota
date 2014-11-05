<?php
session_start("mynota");
include_once ("../ClassesSQL/classePlanoAulaSQL.php");
include_once ("../ClassesSQL/classeTurmaSQL.php");
include_once ("../ClassesSQL/classeModuloSQL.php");
include_once ("../ClassesSQL/classeProfessorSQL.php");

class ControladorPlanoAula {	
	
	function inserir(){
		$planoAula = new PlanoAula();
		$persistir = new TurmaSQL();
		$planoAula->setTurma($persistir->listar($_REQUEST["turma"]));
		$persistir = new ModuloSQL();
		$planoAula->setModulo($persistir->listar($_REQUEST["modulo"]));
		$persistir = new ProfessorSQL();
		$planoAula->setProfessor($persistir->listar($_SESSION["id"]));
		$planoAula->setConteudo(
			"Tema:\n"."Capitulo(s) ".$_REQUEST["caps"]."\n\n".
			"Conteúdo:\n".$_REQUEST["conteudo"]."\n\n".
			"Desenvolvimento do tema:\n".$_REQUEST["desenvolvimento"]."\n\n".
			"Recursos Ditáticos:\n".$_REQUEST["recursos"]."\n\n".
			"Avaliações Programadas:\n".$_REQUEST["avaliacoes"]
		);	
		$planoAula->setData( implode("-", array_reverse(explode("/", $_REQUEST["data"]))) );
		$persistir = new PlanoAulaSQL();
		$persistir->inserir($planoAula);
	}
	
	function deletar(){
		$persistir = new PlanoAulaSQL();
		return $persistir->deletar($_REQUEST["id"]);
	}
	
	function listar($id){
		$persistir = new PlanoAulaSQL();
		return $persistir->listar($id);		
	}
	
	function listarPorTurma($turma){
		$persistir = new PlanoAulaSQL();
		$parametros = array("turma" => $turma);
		return $persistir->listarMuitos($parametros);		
	}
	
	function imprimir(){		
		$plano = $this->listar($_REQUEST["id"]);		
		$saida = "		
		<center> <h1> Relatório de plano de aula </h1> </center> 
		<div class='relatorio'> 
			Turma: ".$plano->getTurma()->getId()."
			Módulo: ".$plano->getModulo()->getNome()."
			Professor: ".$plano->getProfessor()->getNome()."
		</div>
		<div class='relatorio'>".$plano->getConteudo()." </div>
		";
		echo nl2br($saida);

	}
	
}

?>