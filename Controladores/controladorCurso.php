<?php
session_start("mynota");
include ("../ClassesSQL/classeCursoSQL.php");

class ControladorCurso {
	
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