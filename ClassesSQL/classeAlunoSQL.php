<?php
include("../conexao.php");
include("../Classes/classeAluno.php");

class AlunoSQL{
	
	var $sql;
	
	function inserir($aluno){
		$this->sql = "insert into alunos (id, nome) values (
		'".$aluno->getId()."',
		'".$aluno->getNome()."'
		)";
		return mysql_query($this->sql);
	}
	
	function alterar(){
		
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
			$alunoArr [] = $aluno;
			unset($aluno);
		}
		return $alunoArr;		
	}
}
?>