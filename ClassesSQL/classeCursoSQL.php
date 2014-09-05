<?php

include("../conexao.php");
include("../Classes/classeCurso.php");

class CursoSQL {
	
	var $sql;
	
	function inserir(){
		
	}
	
	function alterar(){
		
	}
	
	function deletar(){
		
	}
	
	function listar($id){
		$this->sql = "select * from cursos where id = $id";
		$query = mysql_query($this->sql);
		$linha = mysql_fetch_array($query);
		$curso = new curso();
		$curso->setId($linha["id"]);
		$curso->setDescricao($linha["descricao"]);
		return $curso;
	}
	
	function listarTodos(){
		$this->sql = "select * from cursos";
		$query = mysql_query($this->sql);
		$cursoArr = array();
		while ($linha=mysql_fetch_array($query)){
			$curso = new curso();
			$curso->setId($linha["id"]);
			$curso->setDescricao($linha["descricao"]);
			$cursoArr[] = $curso;
			unset ($curso);
		}
		return $cursoArr;
	}
	
}

?>