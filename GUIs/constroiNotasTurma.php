<?php 
include ("../Controladores/controladorAluno.php");
include ("../Controladores/controladorTurma.php");
include ("../Controladores/controladorModulo.php");
include ("../Controladores/controladorNota.php");

$persistir = new ControladorTurma();
$turma = $persistir->listar($_REQUEST["turma"]);
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
	$txt .= "<th> $nome </th>";
}
$txt .= "</tr>";
for ($i=0;$i<count($alunos);$i++) {
	$id = $alunos[$i]->getId();
	$nome= $alunos[$i]->getNome();
	$txt .= "<tr><td>$id</td> <td>$nome</td>";
	for ($j=0;$j<count($modulos);$j++) {
		$nota = $persistir->pegarNota($alunos[$i],$modulos[$j]);		
		$valor = $nota->getNota();
		$modulo = $nota->getModulo();
		$txt .= "<td title='$modulo' class='editavel'> $valor </td>";
	}
	$txt .= "</tr>";
}



$txt .= "</table>";
echo $txt;

?>