<?php 
//session_start("mynota");
include_once ("../Controladores/controladorAula.php");
include_once ("../Controladores/controladorTurma.php");

$persistir = new ControladorTurma();
$turma = $persistir->listar($_REQUEST["turma"]);
if ($turma->getId()){
	//Obtendo os dias de aula da turma
	$dias = "";
	$diasDeAula = $persistir->diasDeAula($turma);
	for($i = 0; $i < count($diasDeAula); $i++){
		$dias .= $diasDeAula[$i]->getNome()." ";
	}
	//Obtendo as aulas e construindo a tabela para exibição
	$txt = "<table border='1' class='table table-striped tabela-consulta'>";
	$txt .= "<tr> <th colspan='4' align='center'> Turma: ".$turma->getId(). " | Dia da aula: ".$dias." </th> </tr>";
	$txt .= "<tr> <th> Conteúdo </th> <th> Professor </th> <th> Data </th> <th> Remover </th> </tr>";
	$persistir = new ControladorAula();
	$aulas = $persistir->listarPorTurma($_REQUEST["turma"]);
	if (count($aulas) > 0) {
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
				$txt .= "<td></td>";
			}
		}	
	} 
	else {
		$txt .= "<tr> <td colspan='4' align='center'> Ainda não foi registrada aula para a turma selecionada </td> </tr>";
	}
	$txt .= "</table>";
	$txt .= "<p class='obs'> Obs.: O botão de excluir aula aparece apenas paras as aulas que você cadastrou! </p>";
	
}
else {
	$txt = "<div class='alert alert-danger'> Turma ".$_REQUEST["turma"]." não existe no sistema! </div>";
}

echo nl2br($txt);

?>