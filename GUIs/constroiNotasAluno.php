<?php 
include ("../Controladores/controladorAluno.php");
include ("../Controladores/controladorTurma.php");
include ("../Controladores/controladorModulo.php");
include ("../Controladores/controladorNota.php");

$persistir = new ControladorTurma();
$turma = $persistir->listar($_REQUEST["turma"]);

$diasDeAula = $persistir->diasDeAula($turma);
$dias="";
for($i = 0; $i < count($diasDeAula); $i++){
	$dias .= $diasDeAula[$i]->getNome(). " ";
}
$persistir = new ControladorAluno();
$aluno = $persistir->listar($_REQUEST["aluno"]);
$persistir = new controladorModulo();
$modulos = $persistir->listarPorTurma($_REQUEST["turma"]);
$persistir = new ControladorNota();
	
		
$txt = "<table border='1' class='table table-striped tabela-consulta'>";
$colspan = 2+count($modulos);
$txt .= "<tr> <th colspan='$colspan' align='center'> Turma: ".$turma->getId(). " | Dia da aula: ".$dias." </th> </tr>";
$txt .= "<tr> <th> Matrícula </td> <th> Aluno </td>";
for ($i=0;$i<count($modulos);$i++) {
	$nome = $modulos[$i]->getNome();
	$txt .= "<th> <label class='em_pe'> $nome </label> </th>";
}
$txt .= "</tr>";

$id = $aluno->getId();
$nome= $aluno->getNome();
$txt .= "<tr><td>$id</td> <td width='70%' align='left'>$nome</td>";
for ($j=0;$j<count($modulos);$j++) {
	$nota = $persistir->pegarNota($aluno,$modulos[$j]);		
	$valor = $nota->getNota();
	$modulo = $nota->getModulo();
	$txt .= "<td title='$modulo'> $valor </td>";
}
$txt .= "</tr>";

$txt .= "</table>"; 	

echo $txt;

?>