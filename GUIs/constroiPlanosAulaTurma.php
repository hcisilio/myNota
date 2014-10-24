<?php 
include_once ("../Controladores/controladorPlanoAula.php");
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
	$txt .= "<tr> <th colspan='5' align='center'> Turma: ".$turma->getId(). " | Dia da aula: ".$dias." </th> </tr>";
	$txt .= "<tr> <th> Módulo </th> <th> Conteúdo </th> <th> Professor </th> <th> Data </th> <th> Remover </th> </tr>";
	$persistir = new ControladorPlanoAula();
	$planos = $persistir->listarPorTurma($turma);
	if (count($planos) > 0) {
		foreach($planos as $plano){
			$id = $plano->getId();
			$modulo = $plano->getModulo()->getNome();
			$professor = $plano->getProfessor()->getNome();
			$data = implode("/", array_reverse(explode("-", $plano->getData())));
			$conteudo = $plano->getConteudo();
			$txt .= "<tr><td>$modulo</td> <td align=left width='50%'>$conteudo</td> <td td align=left >$professor</td> <td>$data</td>";
			// Opção de deletar irá aparecer apenas para o professor que cadastrou a aula
			if ($plano->getProfessor()->getId() == $_SESSION["id"]){
				$txt .= "<td> <img src='Imagens/delete-icon.png' height='30px' onclick='removePlano($id)'> </td> ";
			} 
			else {
				$txt .= "<td></td>";
			}
		}	
	} 
	else {
		$txt .= "<tr> <td colspan='5' align='center'> A turma ".$turma->getId()." ainda não possui plano de aula cadatrado! </td> </tr>";
	}
	$txt .= "</table>";
	$txt .= "<p class='obs'> Obs.: O botão de excluir plano de aula aparece apenas paras as aulas que você cadastrou! </p>";
	
}
else {
	$txt = "<div class='alert alert-danger'> Turma ".$_REQUEST["turma"]." não existe no sistema! </div>";
} 

echo nl2br($txt);

?>