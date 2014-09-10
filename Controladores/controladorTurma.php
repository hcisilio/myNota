<?php
session_start("mynota");
include_once "../ClassesSQL/classeTurmaSQL.php";

class ControladorTurma {

	function inserir(){
		if(isset($_REQUEST["dia"])) {
			$turma = new turma();		
			$turma->setId($_REQUEST["id"]);
			$professor = new ProfessorSQL();
			$turma->setProfessor($professor->listar($_REQUEST["professor"]));
			$curso = new CursoSQL();
			$turma->setCurso($curso->listar($_REQUEST["curso"]));		
			$turma->setStatus(1);
			$persistir = new TurmaSQL();
			$ok = $persistir->inserir($turma);			
			if ($ok == true) {
				$dia = new Dia();
				for($i = 0; $i < count($_REQUEST["dia"]); $i++) {
					$persistir->DiaTurma($_REQUEST["dia"][$i],$_REQUEST["id"]);
				}
				$resultado = "
				<div class='alert alert-success' role='alert'>
					Nova turma $id registrada no sistema!
				</div>
			";
			}
			else{
				$resultado = "
					<div class='alert alert-danger' role='alert'>
						Ops! O cadastro da turma falhou!. <BR />".mysql_error()."
					</div>
				";
			}
		} else {
			$resultado = "
				<div class='alert alert-danger' role='alert'>
					Ops! Não foram selecionados os dias de aula desta turma
				</div>
			";
		}
		echo $resultado;
	}
	
	function listar($id){
		$persistir = new TurmaSQL();
		return $persistir->listar($id);		
	}
	
	### outras funções
	function encerrar(){
		$persistir = new TurmaSQL();
		$turma = $persistir->listar($_REQUEST["turma"]);
		$turma->setStatus(0);
		if ($persistir->alterar($turma)) {
			$_SESSION["msg"] = "Turma $id concluída!";
			header ("location: ../GUIs/sucesso.php");
		}
		else{
			$_SESSION["msg"] = "Ops! Finalização da turma não realizada.";
			$_SESSION["erro"] = mysql_error();
			header ("location: ../GUIs/erro.php");		
		}
	}
	
	function listarAtivas() {
		$persistir = new TurmaSQL();
		return $persistir->listarAtivas();
	}
	
	function listarMinhas(){
		$professor = $_SESSION["id"];		
		$persistir = new turmaSQL();
		return $persistir->listarMinhas($professor);
	}
	
	function diasDeAula($turma){
		$persistir = new turmaSQL();
		return $persistir->diasDeAula($turma);
	}

}
?>