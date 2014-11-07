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
	
	function pegarNota($aluno,$modulo){
		$persistir = new NotaSQL();
		return $persistir->pegarNota($aluno,$modulo);
	}
	
	function imprimir(){
		include_once("../GUIs/constroiNotasTurma.php");
		include_once ("../Controladores/impressora.php");
		return $impressora = new Impressora('Notas'.$_REQUEST["turma"], $txt);		
	}

}
?>