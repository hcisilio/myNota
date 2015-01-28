<?php
include_once("controladorModulo.php");
include_once("../ClassesSQL/classeNotaSQL.php");

class ControladorNota {

	function inserir($nota){
		$persistir = new NotaSQL();
		return $persistir->inserir($nota);
	}

	function alterar(){		
		$nota = new Nota(); 
		$nota->setNota($_REQUEST["valor"]);
		$nota->setAluno($_REQUEST["aluno"]);
		$nota->setModulo($_REQUEST["modulo"]);
		$persistir = new NotaSQL();
		return $persistir->alterar($nota);
	}
	
	function pegarNota($aluno,$modulo){
		$persistir = new NotaSQL();
		return $persistir->pegarNota($aluno,$modulo);
	}

	function notasIniciais($aluno, $turma){
		$persistir = new controladorModulo();
		$modulos = $persistir->listarPorTurma($turma->getId());
		$nota = new Nota();
		foreach ($modulos as $modulo) {
			$nota->setAluno($aluno);
			$nota->setModulo($modulo);
			$nota->setNota(0);
			$ok = $this->inserir($nota);
		}
		if ($ok) {
			$resultado = "
				<div class='alert alert-success' role='alert'>
					Aluno ".$aluno->getNome()." matriculado com sucesso na turma ".$turma->getId()."!
				</div>
			";
		} else {
			$resultado = "
				<div class='alert alert-danger' role='alert'>
					Ops! Inclusão do aluno em turma não realizada! <BR />".mysql_error()."
				</div>
			";
		}
		echo $resultado;
	}
	
	function imprimir(){
		ob_start();
		include_once("../GUIs/constroiNotasTurma.php");
		ob_end_clean();
		include_once ("../Controladores/impressora.php");
		return $impressora = new Impressora('Notas'.$_REQUEST["turma"], $txt);		
	}

}
?>