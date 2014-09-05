<?php
include("../conexao.php");
include("../Classes/classeProfessor.php");

class ProfessorSQL{

	var $sql;

	function inserir($professor){
		$this->sql = "insert into professores values (
		'".$professor->getId()."',
		'".$professor->getNome()."',
		'".$professor->getComentario()."',
		'".$professor->getSenha()."',
		'".$professor->getAcesso()."'
		)";
		return mysql_query($this->sql);
	}
	
	function alterar($professor){
		$this->sql = "update professores set 
		nome = '".$professor->getNome()."',
		comentario = '".$professor->getComentario()."',
		senha = '".$professor->getSenha()."',
		acesso = '".$professor->getAcesso()."'
		where id = '".$professor->getId()."' ";
		return mysql_query($this->sql);
	}
	
	function deletar($professor){
		
	}
	
	function listar($id){
		$this->sql = "select * from professores where id = \"$id\"";
		$query = mysql_query($this->sql);
		$linha=mysql_fetch_array($query);
		$professor = new Professor();
		$professor->setId($linha["id"]);
		$professor->setNome($linha["nome"]);
		$professor->setAcesso($linha["acesso"]);
		$professor->setSenha($linha["senha"]);
		$professor->setComentario($linha["comentario"]);
		return $professor;		
	}
	
	function listarTodos(){
		$this->sql = "select * from professores";
		$query = mysql_query($this->sql);
		$professorArr = array();
		while ($linha=mysql_fetch_array($query)){
			$professor = new Professor();
			$professor->setId($linha["id"]);
			$professor->setNome($linha["nome"]);
			$professor->setAcesso($linha["acesso"]);
			$professor->setSenha($linha["senha"]);
			$professor->setComentario($linha["comentario"]);
			$professorArr[] = $professor;
			unset($professor);
		}		
		return $professorArr;		
	}

}
?>