<?php
session_start("mynota");
include ("../ClassesSQL/classeModuloSQL.php");

class controladorModulo {
	
	function inserir(){
		
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
		//$id = $_REQUEST["turma"];
		//$id = "Familia";
		$persistir = new ControladorTurma();
		$turma = $persistir->listar($id);
		$persistir = new ModuloSQL();
		$modulos = $persistir->listarPorTurma($turma);
		return $modulos;
	}
}
?>