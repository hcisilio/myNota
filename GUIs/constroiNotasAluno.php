<?php 
include ("../Controladores/controladorAluno.php");
include ("../Controladores/controladorTurma.php");
include ("../Controladores/controladorModulo.php");
include ("../Controladores/controladorNota.php");

$persistir = new ControladorAluno();
$aluno = $persistir->listar($_REQUEST["aluno"]);

if ($aluno->getId()) {
	
	$persistir = new ControladorTurma();
	$turmas = $persistir->turmasDoAluno($aluno);
	$txt = "";
	
	for ($i=0; $i<count($turmas); $i++){
		
		$persistir = new ControladorTurma();
		$diasDeAula = $persistir->diasDeAula($turmas[$i]);
		$dias="";
		for($j = 0; $j < count($diasDeAula); $j++){
			$dias .= $diasDeAula[$j]->getNome(). " ";
		}	
		$persistir = new controladorModulo();
		$modulos = $persistir->listarPorTurma($turmas[$i]->getId());
						
		$txt .= "<table border='1' class='table table-striped tabela-consulta'>";
		$colspan = 2+count($modulos);
		$txt .= "<tr> <th colspan='$colspan' align='center'> Turma: ".$turmas[$i]->getId(). " | Dia da aula: ".$dias." </th> </tr>";
		$txt .= "<tr> <th> Matrícula </td> <th> Aluno </td>";
		for ($j=0;$j<count($modulos);$j++) {
			$nome = $modulos[$j]->getNome();
			$txt .= "<th> <label class='em_pe'> $nome </label> </th>";
		}
		$txt .= "</tr>";
		$txt .= "<tr><td>".$aluno->getId()."</td> <td width='70%' align='left'>".$aluno->getNome()."</td>";
		
		$persistir = new ControladorNota();
		for ($j=0;$j<count($modulos);$j++) {
			$nota = $persistir->pegarNota($aluno,$modulos[$j]);		
			$valor = $nota->getNota();
			$modulo = $nota->getModulo();
			$txt .= "<td title='$modulo'> $valor </td>";
		}
		
		$txt .= "</tr>";
		$txt .= "</table>"; 
	
	}
}

else {
	
	$txt = "<div class='alert alert-danger'> Não existe aluno com matrícula ".$_REQUEST["aluno"]."! </div>";
	
}

echo $txt;

?>