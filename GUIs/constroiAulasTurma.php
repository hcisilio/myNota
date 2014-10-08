<?php 
//session_start("mynota");
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

$txt = "<table border='1' class='table table-striped tabela-consulta'>";
$txt .= "<tr> <th colspan='4' align='center'> Turma: ".$_REQUEST["turma"]. " | Dia da aula: ".$dias." </th> </tr>";
$txt .= "<tr> <th> Conteúdo </th> <th> Professor </th> <th> Data </th> <th> Remover </th> </tr>";
if (empty($dias)) {
	$txt .= "<tr> <td colspan='4' align='center'> Turma ".$_REQUEST["turma"]." não existe no sistema </td> </tr>";
}
else if (count($aulas) > 0) {
	for ($i=0;$i<count($aulas);$i++) {
		$id = $aulas[$i]->getId();
		$professor = $aulas[$i]->getProfessor()->getNome();
		$data = implode("/", array_reverse(explode("-", $aulas[$i]->getData())));
		$conteudo = $aulas[$i]->getConteudo();
		$txt .= "<tr><td align=left width='50%'>$conteudo</td> <td td align=left >$professor</td> <td>$data</td>";
		// Opção de lançar aulas irá aparecer apenas para o professor que cadastrou a aula
		if ($aulas[$i]->getProfessor()->getId() == $_SESSION["id"]){
			$txt .= "<td> <img src='Imagens/delete-icon.png' height='30px' onclick='removeAula($id)'> </td> ";
		} 
		else {
			$txt .= "<td>$a</td>";
		}
	}	
} 
else {
	$txt .= "<tr> <td colspan='4' align='center'> Ainda não foi registrada aula para a turma selecionada </td> </tr>";
}


$txt .= "</table>";
$txt .= "<p class='obs'> Obs.: O botão de excluir aula aparece apenas paras as aulas que você cadastrou! </p>";

echo nl2br($txt);

?>