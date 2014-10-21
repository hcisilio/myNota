<?php
session_start("mynota");
include_once "../ClassesSQL/classeTurmaSQL.php";

class ControladorTurma {

	function inserir(){
		if(isset($_REQUEST["dias"])) {
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
				for($i = 0; $i < count($_REQUEST["dias"]); $i++) {
					$persistir->DiaTurma($_REQUEST["dias"][$i],$_REQUEST["id"]);
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
	
	function listarTodos(){
		$persistir = new turmaSQL();
		return $persistir->listarTodos();
	}
	
	function turmasDoAluno($aluno){
		$persistir = new TurmaSQL();
		return $persistir->turmasDoAluno($aluno->getId());
	}
	
	### outras funções
	function encerrar(){
		$persistir = new TurmaSQL();
		$turma = $persistir->listar($_REQUEST["turma"]);
		$turma->setStatus(0);
		if ($persistir->alterar($turma)) {
			$resultado = "
				<div class='alert alert-success' role='alert'>
					As aulas da turma foram concluídas. <BR /> Turma finalizada!
				</div>
			";
		}
		else{
			$resultado = "
				<div class='alert alert-danger' role='alert'>
					Ops! A finalização da turma!. <BR />".mysql_error()."
				</div>
			";	
		}
		echo $resultado;
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
		return $persistir->diasDeAula($turma->getId());
	}
	
	function criarCombo() {
		$persistir = new TurmaSQL();
		$combo = "<option value='null'> Selecione uma turma </option>";
		if ($_REQUEST["tipo"] == "minhas"){
			$lista = $persistir->listarMinhas($_SESSION["id"]);
			for ($i = 0; $i < count($lista); $i++) {
				$id = $lista[$i]->getId();
				$combo .= "<option value=$id> $id </option>";
			}
		} 
		else if ($_REQUEST["tipo"] == "todas"){
			$lista = $persistir->listarAtivas();
			for ($i = 0; $i < count($lista); $i++) {
				$id = $lista[$i]->getId();
				$combo .= "<option value=$id> $id </option>";
			}
		}
		else if ($_REQUEST["tipo"] == "porAluno") {
			$lista = $persistir->turmasDoAluno($_REQUEST["aluno"]);
			if (count($lista) > 0) {
				for ($i = 0; $i < count($lista); $i++) {
					$id = $lista[$i]->getId();
					$combo .= "<option value=$id> $id </option>";
				}
			}
			else {
				$combo = 0;
			}
		}
		else if ($_REQUEST["tipo"] == "deMesmoCurso") {
			$lista = $persistir->deMesmoCurso($_REQUEST["turma"]);
			for ($i = 0; $i < count($lista); $i++) {
				$id = $lista[$i]->getId();
				$combo .= "<option value=$id> $id </option>";
			}
		}
		else {
			$combo .=  "<option> ".$_REQUEST["tipo"]." </option>";
		}
		echo $combo;
	}

}
?>