<?php 
include ("../Controladores/controladorAluno.php");
include ("../Controladores/controladorTurma.php");
include ("../Controladores/controladorModulo.php");
include ("../Controladores/controladorNota.php");

$persistir = new ControladorTurma();
$turma = $persistir->listar($_REQUEST["turma"]);
if ($turma->getId()) {
	$diasDeAula = $persistir->diasDeAula($_REQUEST["turma"]);
	$dias="";
	for($i = 0; $i < count($diasDeAula); $i++){
		$dias .= $diasDeAula[$i]->getNome(). " ";
	}
	$persistir = new ControladorAluno();
	$alunos = $persistir->listarPorTurma();
	$persistir = new controladorModulo();
	$modulos = $persistir->listarPorTurma($_REQUEST["turma"]);
	$persistir = new ControladorNota();
	
	
	$txt = "<script type=\"text/javascript\" src=\"../Ajax/tabelaEditavel.js\"></script>";
	$txt .= "<table border='1' class='table table-striped tabela-consulta'>";
	$colspan = 2+count($modulos);
	$txt .= "<tr> <th colspan='$colspan' align='center'> Turma: ".$turma->getId(). " | Dia da aula: ".$dias." </th> </tr>";
	$txt .= "<tr> <th> Matrícula </td> <th> Aluno </td>";
	for ($i=0;$i<count($modulos);$i++) {
		$nome = $modulos[$i]->getNome();
		$txt .= "<th> <label class='em_pe'> $nome </label> </th>";
	}
	$txt .= "</tr>";
	if (count($alunos)>0){
		for ($i=0;$i<count($alunos);$i++) {
			$id = $alunos[$i]->getId();
			$nome= $alunos[$i]->getNome();
			$txt .= "<tr><td>$id</td> <td width='70%' align='left'>$nome</td>";
			for ($j=0;$j<count($modulos);$j++) {
				$nota = $persistir->pegarNota($alunos[$i],$modulos[$j]);		
				$valor = $nota->getNota();
				$modulo = $nota->getModulo();
				$txt .= "<td title='$modulo' class='editavel'> $valor </td>";
			}
			$txt .= "</tr>";
		}
	}
	else {
		$txt .= "<tr> <td colspan='$colspan' align='center'> Turma não possui nenhum aluno matriculado! </td> </tr>";
	}
	$txt .= "</table>";
	$txt .= "<div class='obs'> Obs.: Dê um duplo clique na nota que será editada e use ponto (.) para separar as casas decimais. </div>";
}
else {
	$txt = "<div class='alert alert-danger'> Turma ".$_REQUEST["turma"]." não existe no sistema! </div>";
}

echo $txt;

?>