<?php
	session_start("mynota");
	include ("../Controladores/controladorAluno.php");
	include ("../Controladores/controladorTurma.php");
	include ("../Controladores/controladorModulo.php");
	include ("../Controladores/controladorNota.php");
	
	$persistir = new controladorModulo();
	$modulos = $persistir->listarPorTurma($_SESSION["turma"]);
	$nota = new Nota();
	$persistir = new ControladorNota();
	for ($i=0;$i<count($modulos);$i++) {	
		$nota->setAluno($_SESSION["aluno"]);
		$nota->setModulo($modulos[$i]->getId());
		$nota->setNota(0);
		$ok = $persistir->inserir($nota);
	}
	
	if ($ok) {
		$resultado = "
			<div class='alert alert-success' role='alert'>
				Aluno matriculado com sucesso!
			</div>
		";
	} else {
		$resultado = "
			<div class='alert alert-danger' role='alert'>
				Ops! Inclusão do aluno em turma não realizada! <BR />".mysql_error()."
			</div>
		";
	}

?>