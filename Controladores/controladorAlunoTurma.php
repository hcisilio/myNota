<?php
session_start("mynota");
include_once("../ClassesSQL/classeAlunoTurmaSQL.php");
include_once("controladorNota.php");

class controladorAlunoTurma{
	
	function inserir(){
		$alunoTurma = new AlunoTurma();
		$aluno = new AlunoSQL();
		$alunoTurma->setAluno($aluno->listar($_REQUEST["aluno"]));
		$turma = new TurmaSQL();
		$alunoTurma->setTurma($turma->listar($_REQUEST["turma"]));
		$persistir = new AlunoTurmaSQL();
		if ($persistir->checarMatricula( $aluno->listar($_REQUEST["aluno"])->getId(), $turma->listar($_REQUEST["turma"])->getCurso()->getId() ) == 0) {
			if ($persistir->inserir($alunoTurma)){
				$persistir = new controladorNota();
				$resultado = $persistir->notasIniciais($aluno->listar($_REQUEST["aluno"]), $turma->listar($_REQUEST["turma"]));
			}
			else{
				$resultado = "
					<div class='alert alert-danger' role='alert'>
						Ops! Inclusão do aluno em turma não realizada! <BR />".mysql_error()."
					</div>
				";
			}	
		}
		else {
			$resultado = "
				<div class='alert alert-danger' role='alert'>
					Ops! Inclusão do aluno em turma não realizada! <BR /> Aluno Já está matriculado em uma turma do mesmo curso! <BR /> SQL Error:
					".$persistir->checarMatricula( $aluno->listar($_REQUEST["aluno"])->getId(), $turma->listar($_REQUEST["turma"])->getCurso()->getId() )."
				</div>
			";
		}
		echo $resultado;
	} 
	
	function transferir(){
		$alunoTurma = new AlunoTurma();
		$aluno = new AlunoSQL();
		$alunoTurma->setAluno($aluno->listar($_REQUEST["aluno"]));
		$turma = new TurmaSQL();
		$alunoTurma->setTurma($turma->listar($_REQUEST["turmaAtual"]));
		$persistir = new AlunoTurmaSQL();
		if ($persistir->transferir($alunoTurma, $_REQUEST["novaTurma"])){
			$resultado = "
				<div class='alert alert-success' role='alert'>
					Transferência realizada com sucesso! <BR /> O aluno ".$aluno->listar($_REQUEST["aluno"])->getNome()." está agora matriculado na turma ".$_REQUEST["novaTurma"]." <BR />
				</div>
			";
		}
		else{
			$resultado = "
				<div class='alert alert-danger' role='alert'>
					Ops! Transferência entre turmas nãi realizada! <BR />".mysql_error()."
				</div>
			";
		}
		echo $resultado;
	}	

}

?>
