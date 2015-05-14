<?php
session_start("mynota");
include_once ("controladorTurma.php");
include ("../ClassesSQL/classeModuloSQL.php");


class controladorModulo {
	
	function inserir($curso){
		$modulo = new Modulo();
		$persistir = new ModuloSQL();
		foreach ($_SESSION['modulos'] as $m) {
			$modulo->setNome($m);
			$modulo->setCurso($curso);
			$persistir->inserir($modulo);
		}
		unset($_SESSION['modulos']);
	}
	
	function alterar(){
		
	}
	
	function deletar(){
		
	}
	
	function listar() {
		
	}
	
	function listarTodos(){
		
	}
	
	function listarPorTurma($id){
		$persistir = new ControladorTurma();
		$turma = $persistir->listar($id);
		$persistir = new ModuloSQL();
		$modulos = $persistir->listarPorTurma($turma);
		return $modulos;
	}
	
	function criarCombo() {
		$modulos = $this->$_REQUEST["consulta"]($_REQUEST["turma"]);		
		$combo = "<option value ='null'> Selecione o módulo </option>";		
		foreach ($modulos as $modulo){
			$combo .= "<option value= '".$modulo->getId()."'>".$modulo->getNome()."</option>";
		}
		echo $combo;
	}
	
}
?>