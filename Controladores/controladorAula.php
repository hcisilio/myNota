<?php
session_start("mynota");
include ("../ClassesSQL/classeAulaSQL.php");
include ("../ClassesSQL/classeTurmaSQL.php");

class ControladorAula {	
	
	function inserir(){
		$aula = new Aula();
		$persistir = new TurmaSQL();
		$aula->setTurma($persistir->listar($_REQUEST["turma"]));
		$persistir = new ProfessorSQL();
		$aula->setProfessor($persistir->listar($_SESSION["id"]));
		$aula->setConteudo($_REQUEST["conteudo"]);
		$aula->setData(date("Y-m-d"));
		$persistir = new AulaSQL();
		$ok = $persistir->inserir($aula);
		if ($ok == true){
			//header ("location: ../GUIs/saidas/sucesso.php");
		}
		else{
			$_SESSION["msg"] = "Ops! Cadastro de aula não efetuado.";
			$_SESSION["erro"] = mysql_error();
			header ("location: ../GUIs/erro.php");
		}
	}
	
	function listarPorTurma($turma){
		$persistir = new AulaSQL();
		return $persistir->listarPorTurma($turma);		
	}
	
}

?>