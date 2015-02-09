<?php
session_start("mynota");
include_once "../ClassesSQL/classeTurmaSQL.php";
include_once "controladorAluno.php";

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

	function alterar(){
		if(isset($_REQUEST["dias"])) {
			$persistir = new TurmaSQL();
			$turma = $persistir->listar($_REQUEST["id"]);
			if (isset($_REQUEST["professor"])){
				$professor = new ProfessorSQL();
				$turma->setProfessor($professor->listar($_REQUEST["professor"]));
			}
			$ok = $persistir->alterar($turma);		
			if ($ok == true) {
				$dia = new Dia();
				$persistir->removerDias($_REQUEST["id"]);
				for($i = 0; $i < count($_REQUEST["dias"]); $i++) {
					$persistir->DiaTurma($_REQUEST["dias"][$i],$_REQUEST["id"]);
				}
				$resultado = "
					<div class='alert alert-success' role='alert'>
						Dados da turma atualizados com sucesso!
					</div>
				";
			}
			else{
				$resultado = "
					<div class='alert alert-danger' role='alert'>
						Ops! A atualização da turma falhou!. <BR />".mysql_error()."
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
	
	#funções para consulta de turma
	function listar($id){
		$persistir = new TurmaSQL();
		return $persistir->listar($id);		
	}
	
	function listarTodos(){
		$parametros = False;
		$persistir = new turmaSQL();
		return $persistir->listarMuitos($parametros);
	}	
	
	function listarAtivas() {
		$parametro = array("status" => 1);
		$persistir = new TurmaSQL();
		return $persistir->listarMuitos($parametro);
	}
	
	function listarMinhas(){
		$parametro = array("professor" => $_SESSION["id"], "status" => 1);		
		$persistir = new turmaSQL();
		return $persistir->listarMuitos($parametro);
	}
	
	function deMesmoCurso(){
		$turma = $this->listar($_REQUEST["turma"]);
		$parametro = array("curso" => $turma->getCurso()->getId(), "status" => 1);
		$persistir = new TurmaSQL();
		return $persistir->listarMuitos($parametro);
	}
	
	function turmasDoAluno($aluno){
		$persistir = new TurmaSQL();
		return $persistir->turmasDoAluno($aluno);
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
	
	function diasDeAula($turma){
		$persistir = new turmaSQL();
		return $persistir->diasDeAula($turma->getId());
	}
		
	function criarCombo() {		
		$combo = "<option value='null'> Selecione uma turma </option>";
		if ($_REQUEST["tipo"] == "minhas"){
			$turmas = $this->listarMinhas();
		} 
		else if ($_REQUEST["tipo"] == "ativas"){
			$turmas = $this->listarAtivas();
		}
		else if ($_REQUEST["tipo"] == "porAluno") {
			$aluno = new ControladorAluno();
			$aluno = $aluno->listar($_REQUEST["aluno"]);
			$turmas = $this->turmasDoAluno($aluno);
		}
		else if ($_REQUEST["tipo"] == "deMesmoCurso") {
			$turmas = $this->deMesmoCurso($_REQUEST["turma"]);
		}
		
		foreach ($turmas as $turma) {
			$combo .= "<option value=".$turma->getId()."> ".$turma->getId()." </option>";
		}
		echo $combo;
	}

}
?>