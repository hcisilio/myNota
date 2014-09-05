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
		$_SESSION["msg"] = "
		Aluno matriculado na turma com sucesso!
		";	
		header ("location: saidas/sucesso.php");
	} else {
		$_SESSION["msg"] = "Matrícula não realizada!";
		$_SESSION["erro"] = mysql_error();
		header ("location: saidas/erro.php");	
	}

?>