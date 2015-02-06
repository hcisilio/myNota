<?php
session_start("mynota");
include ("../ClassesSQL/classeAlunoSQL.php");
//include ("controladorTurma.php");
//include ("controladorModulo.php");

class ControladorAluno {
	
	function inserir(){
		$aluno = new Aluno();
		$aluno->setNome($_REQUEST["nome"]);
		$aluno->setId($_REQUEST["id"]);
		$aluno->setMail($_REQUEST["mail"]);
		$persistir = new AlunoSQL();
		$ok = $persistir->inserir($aluno);
		if ($ok == true){
			$resultado = "
				<div class='alert alert-success' role='alert'>
					O aluno ".$_REQUEST["id"]." - ".$_REQUEST["nome"]." foi matriculado com sucesso!
				</div>
			";
		}
		else{
			$resultado = "
				<div class='alert alert-danger' role='alert'>
					Ops! Aluno não matriculado!. <BR />".mysql_error()."
				</div>
			";
		}
		echo $resultado;
	}
	
	function alterar(){
		$persistir = new AlunoSQL;
		$aluno = $persistir->listar($_REQUEST['id']);
		if (isset($_REQUEST['nome'])){
			$aluno->setNome($_REQUEST['nome']);
		}
		if (isset($_REQUEST['mail'])){
			$aluno->setMail($_REQUEST['mail']);
		}
		if ($persistir->alterar($aluno)){
			$resultado = "
				<div class='alert alert-success' role='alert'>
					Dados do aluno ".$aluno->getId()." alterados com sucesso!
				</div>
			";
		}
		else {
			$resultado = "
				<div class='alert alert-danger' role='alert'>
					Ops! Dados do aluno não foram alterados.<BR />".mysql_error()."
				</div>
			";
		}
		echo $resultado;
	}

	function listar($id) {
		$persistir = new AlunoSQL();
		return $persistir->listar($id);
	}
	
	
	### outras funções
	
	function buscar(){
		$q = $_REQUEST["q"];
		$persistir = new AlunoSQL();
		$alunos = $persistir->buscar($q);
		$resultado = "<table class='table table-striped tabela-consulta'>";
		$resultado .= "
					<tr> 
						<th>Matrícula</th> 
						<th>Nome</th> 
					</tr>
				";
		if ($alunos == false){
			$resultado = "Não foram localizados alunos com os parâmetros informados";			
		}
		else {
			$total = count($alunos);
			for($i=0; $i<$total; $i++) {
				$id = $alunos[$i]->getId();
				$nome = $alunos[$i]->getNome();
				$mail = $alunos[$i]->getMail();
				$resultado .= "
					<tr>						
						<td><button type='button' class='btn btn-primary' onClick=\"javaScript:pegueme('$id','$nome', '$mail');\">$id</button> </td> 
						<td>$nome</td> 
					</tr>
				";			
			}
			$resultado .= "</table>";			
		}
		echo $resultado;
	}
	
	function listarPorTurma(){
		$id = $_REQUEST["turma"];
		$persistir = new ControladorTurma();
		$turma = $persistir->listar($id);
		$persistir = new AlunoSQL();
		$alunos = $persistir->listarPorTurma($turma);
		return $alunos;
	}
}
?>