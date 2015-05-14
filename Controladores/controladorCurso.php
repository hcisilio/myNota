<?php
session_start("mynota");
include ("../ClassesSQL/classeCursoSQL.php");
include ("controladorModulo.php");

class ControladorCurso {
	
	function inserir(){
		$curso = new Curso();
		$curso->setDescricao($_REQUEST['descricao']);
		$persistir = new CursoSQL();
		$id = $persistir->inserir($curso);
		if (is_numeric($id)) {
			$curso->setId($id);
			$controlador = new ControladorModulo();
			$controlador->inserir($curso);
			$resultado = "
				<div class='alert alert-success' role='alert'>
					Curso ".$_REQUEST["descricao"]." criado com sucesso
				</div>
			";
		}
		else {
			$resultado = "
				<div class='alert alert-danger' role='alert'>
					Ops! O curso não foi criado!. <BR />".mysql_error()."
				</div>
			";
		}
		echo $resultado;
	}

	function listarTodos(){
		$parametros = False;
		$persistir = new cursoSQL();
		return $persistir->listarMuitos($parametros);
	}
	
	function criarCombo(){
		$combo = "<option value='null'> Selecione um curso </option>";
		if ($_REQUEST["tipo"] == "todos"){
			$cursos = $this->listarTodos();
		}
		foreach ($cursos as $curso) {
			$combo .= "<option value=".$curso->getId()."> ".$curso->getDescricao()." </option>";
		}
		echo $combo;
	}
	
}
?>