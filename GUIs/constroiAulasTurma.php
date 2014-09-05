<?php 
session_start("mynota");
include_once ("../Controladores/controladorAula.php");
include_once ("../Controladores/controladorTurma.php");

$persistir = new ControladorAula();
$aulas = $persistir->listarPorTurma($_REQUEST["turma"]);

$persistir = new ControladorTurma();
$dias = "";
$diasDeAula = $persistir->diasDeAula($_REQUEST["turma"]);
for($i = 0; $i < count($diasDeAula); $i++){
	$dias .= $diasDeAula[$i]->getNome()." ";
}

$txt = "<table border='1' class='tabela'>";
$txt .= "<tr> <td colspan='3' align='center'> Turma: ".$_REQUEST["turma"]. " | Dia da aula: ".$dias." </td> </tr>";
$txt .= "<tr> <td> Conteúdo </td> <td> Professor </td> <td> Data </td> </tr>";
if (count($aulas) > 0) {
	for ($i=0;$i<count($aulas);$i++) {
		$professor = $aulas[$i]->getProfessor()->getNome();
		$dt = explode("-", $aulas[$i]->getData());
		$data = $dt[2]."/".$dt[1]."/".$dt[0];
		$conteudo = $aulas[$i]->getConteudo();
		$txt .= "<tr><td align=left width='60%'>$conteudo</td> <td td align=left width='30%'>$professor</td> <td td align='center' width='10%'>$data</td>";
	}	
} 
else {
	$txt .= "<tr> <td colspan='3' align='center'> Ainda não foi registrada aula para a turma selecionada </td> </tr>";
}


$txt .= "</table>";

echo nl2br($txt);

?>