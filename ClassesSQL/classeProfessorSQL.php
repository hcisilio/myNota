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
		'".$professor->getAcesso()."',
		'Ativo'
		)";
		return mysql_query($this->sql);
	}
	
	function alterar($professor){
		$this->sql = "update professores set 
		nome = '".$professor->getNome()."',
		comentario = '".$professor->getComentario()."',
		senha = '".$professor->getSenha()."',
		acesso = '".$professor->getAcesso()."',
		ativo = '".$professor->getAtivo()."'
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
		$professor->setAtivo($linha["ativo"]);
		$professor->setComentario($linha["comentario"]);
		return $professor;		
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
			$this->sql = "select * from professores".$wheres;
		}
		else {
			$this->sql = "select * from professores";
		}
		//Executando a Query
		$query = mysql_query($this->sql);
		$professorArr = array();
		while ($linha=mysql_fetch_array($query)){
			$professor = new Professor();
			$professor->setId($linha["id"]);
			$professor->setNome($linha["nome"]);
			$professor->setAcesso($linha["acesso"]);
			$professor->setSenha($linha["senha"]);
			$professor->setAtivo($linha["ativo"]);
			$professor->setComentario($linha["comentario"]);
			$professorArr[] = $professor;
			unset($professor);
		}		
		return $professorArr;		
	}

}
?>