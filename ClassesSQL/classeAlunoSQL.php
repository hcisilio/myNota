<?php
include("../conexao.php");
include("../Classes/classeAluno.php");

class AlunoSQL{
	
	var $sql;
	
	function inserir($aluno){
		$this->sql = "insert into alunos (id, nome, email) values (
		'".$aluno->getId()."',
		'".$aluno->getNome()."',
		'".$aluno->getMail()."'
		)";
		return mysql_query($this->sql);
	}
	
	function alterar($aluno){
		$this->sql = "update alunos set
		nome = '".$aluno->getNome()."',
		email = '".$aluno->getMail()."'
		where id = '".$aluno->getId()."'
		";
		return mysql_query($this->sql);
	}
	
	function deletar(){
		
	}
	
	function listar($id){
		$this->sql = "select * from alunos where id = \"$id\"";
		$query = mysql_query($this->sql);
		$linha = mysql_fetch_array($query);
		$aluno = new Aluno();
		$aluno->setId($linha["id"]);
		$aluno->setNome($linha["nome"]);
		$aluno->setMail($linha["email"]);
		return $aluno;
	}
	
	function listarTodos(){
		$this->sql = "select * from alunos";
		$query = mysql_query($this->sql);
		if (empty($query)){
			return false;
		}
		else {
			$alunoArr = array();
			while ($linha = mysql_fetch_array($query)){
			$aluno = new Aluno();
				$aluno->setId($linha["id"]);
				$aluno->setNome($linha["nome"]);
				$aluno->setMail($linha["email"]);
				$alunoArr [] = $aluno;
				unset($aluno);
			}
			return $alunoArr;
		}		
	}
	
	### outras funções
	
	function buscar($q){
		$this->sql = "select * from alunos
		where nome like '$q%' or id = '$q'
		order by nome";
		$query = mysql_query($this->sql);
		if (empty($query)){
			return false;
		}
		else {
			$alunoArr = array();
			while ($linha = mysql_fetch_array($query)){
				$aluno = new Aluno();
				$aluno->setId($linha["id"]);
				$aluno->setNome($linha["nome"]);
				$aluno->setMail($linha["email"]);
				$alunoArr[] = $aluno;
				unset($aluno);
			}
		return $alunoArr;
		}
	}
	
	function listarPorTurma($turma){
		$id = $turma->getId();
		$this->sql = "select * from alunos where id in (select aluno from aluno_turma where turma = \"$id\") order by nome";
		$query = mysql_query($this->sql);
		$alunoArr = array();
		while ($linha = mysql_fetch_array($query)){
			$aluno = new Aluno();
			$aluno->setId($linha["id"]);
			$aluno->setNome($linha["nome"]);
			$aluno->setMail($linha["email"]);
			$alunoArr [] = $aluno;
			unset($aluno);
		}
		return $alunoArr;		
	}
}
?>