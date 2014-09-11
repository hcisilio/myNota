<?php
session_start("mynota");
include("../ClassesSQL/classeAlunoTurmaSQL.php");

class controladorAlunoTurma{
	
	function inserir(){		
		$alunoTurma = new AlunoTurma();
		$aluno = new AlunoSQL();
		$alunoTurma->setAluno($aluno->listar($_REQUEST["aluno"]));
		$turma = new TurmaSQL();
		$alunoTurma->setTurma($turma->listar($_REQUEST["turma"]));
		$persistir = new AlunoTurmaSQL();
		if ($persistir->checarMatricula( $aluno->listar($_REQUEST["aluno"])->getId(), $turma->listar($_REQUEST["turma"])->getCurso()->getId() ) == 0) {
			$ok = $persistir->inserir($alunoTurma);
			if ($ok == true){				
				$_SESSION["aluno"] = $_REQUEST["aluno"];
				$_SESSION["turma"] = $_REQUEST["turma"];
				header ("location: ../GUIs/notasIniciais.php");				
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
		$alunoTurma->setTurma($turma->listar($_REQUEST["turma"]));
		$persistir = new AlunoTurmaSQL();
		if ($persistir->checarMatricula( $aluno->listar($_REQUEST["aluno"])->getId(), $turma->listar($_REQUEST["turma"])->getCurso()->getId() ) == 1) {
			$ok = $persistir->transferir($alunoTurma, $_REQUEST["novaTurma"]);
			if ($ok == true){
				$_SESSION["msg"] = "Transferência de turma realizada com sucesso!";	
				header ("location: ../GUIs/sucesso.php");
			}
			else{
				$_SESSION["msg"] = "Ops! Matrícula em turma não efetuada.";
				$_SESSION["erro"] = mysql_error();
				header ("location: ../GUIs/erro.php");
			}
		}
		else {
			$_SESSION["msg"] = "Ops! Transferência não efetuada.";
			$_SESSION["erro"] = "O aluno não está matriculado em nenhuma turma do curso indiciado! <BR /> SQL Error: ";
			$_SESSION["erro"] .= $persistir->checarMatricula( $aluno->listar($_REQUEST["aluno"])->getId(), $turma->listar($_REQUEST["turma"])->getCurso()->getId() );
			header ("location: ../GUIs/erro.php");
		}	
	}

}

?>
