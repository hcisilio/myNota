<?php
include("../conexao.php");
include("../ClassesSQL/classeNotaSQL.php");

class ControladorNota {

	function inserir($nota){
		$persistir = new NotaSQL();
		return $persistir->inserir($nota);
	}

	function alterar(){		
		$nota = new Nota(); 
		$nota->setNota($_REQUEST["valor"]);
		$nota->setAluno($_REQUEST["aluno"]);
		$nota->setModulo($_REQUEST["modulo"]);
		$persistir = new NotaSQL();
		return $persistir->alterar($nota);
	}

	function listar(){

	}

	function listarTodos(){

	}
	
	function pegarNota($aluno,$modulo){
		$a = $aluno->getId();
		$m = $modulo->getId();
		$persistir = new NotaSQL();
		return $persistir->pegarNota($a,$m);
	}
	
	/*function lancar(){
		$nota = new Nota();
		$nota->setNota($_REQUEST["valor"]);
		$nota->setAluno($_REQUEST["aluno"]);
		$nota->setModulo($_REQUEST["modulo"]);
		$persistir = new NotaSQL();		
		if ($this->inserir($nota)) {
			return true;
		} 
		else {
			return $persistir->alterar($nota);
		}
	}*/
	
	/*function listarPorTurma(){
		//$id = $_REQUEST["turma"];
		$id = "Familia";
		$persistir = new ControladorTurma();
		$turma = $persistir->listar($id);
		$persistir = new NotaSQL();
		$notas = $persistir->listarPorTurma($turma);
		return $notas;
	}*/

}
?>