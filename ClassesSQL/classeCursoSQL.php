<?php

include("../conexao.php");
include("../Classes/classeCurso.php");

class CursoSQL {
	
	var $sql;
	
	function inserir($curso){
		$this->sql = "insert into cursos (descricao) values (
		'".$curso->getDescricao()."'
		)";
		mysql_query($this->sql);
		return mysql_insert_id();
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
	
	function listarMuitos($parametros){
		//Motando a clausura where a partir dos parâmetros
		if ($parametros){
			$wheres = " where ";
			while ($parametro = current($parametros)) {
				$wheres .= key($parametros)."='".$parametro."'";				
				if (next($parametros)){
					$wheres .= " and ";
				}
			}
			$this->sql = "select * from cursos".$wheres." order by descricao";
		}
		else {
			$this->sql = "select * from cursos order by descricao";
		}
		//Executando a Query		
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