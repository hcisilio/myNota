<?php
include_once "../Controladores/controladorTurma.php";
include_once "../Controladores/controladorPlanoAula.php";

$display = "<h3>Os seus planos de aula para hoje</h3>";
$persistir = new controladorTurma();
$turmas = $persistir->listarMinhas();
//Obtendo os Ids das minhas turmas com aulas no dia da semana atual.
$turmasHoje = array();
foreach($turmas as $turma){
	$dias = $persistir->diasDeAula($turma);
	foreach($dias as $dia){
		if($dia->getId() == date("w") ){
			$turmasHoje[] = $turma;
		}
	}
}	

//Obtendo os Planos de aula das turmas de hoje
$persistir = new controladorPlanoAula();
foreach($turmasHoje as $turma){
	$p = $persistir->listarPorTurmaHoje($turma);
	if ($p[0]){
		$planosHoje[] = $p[0];
	}
	else {
		$display .= "<div class='alert alert-danger' role='alert'> A turma ".$turma->getId()." possui aula hoje e não há um plano para esta aula registrado! </div>";
	}
}	

//Constroi exibição dos planos de aula para hoje
if (count($turmasHoje) == 0) {
	$display = "<div class='alert alert-success' role='alert'> Você não possui aulas a ministrar hoje! </div>";	
} 
else if (isset($planosHoje)){	
	foreach ($planosHoje as $plano) {
		if ($plano) {
			$display .= "<table border='1' class='table table-striped tabela-consulta'>";
			$display .= "<tr> <th colspan='4' align='center'> Turma: ".$plano->getTurma()->getId();
			$display .= "<tr> <th> Módulo </th> <th> Conteúdo </th> <th> Professor </th> <th> Data </th>  </tr>";
			$display .= "<tr>
				<td>".$plano->getModulo()->getNome()."</td> 
				<td align=left width='50%'>".nl2br($plano->getConteudo())."</td> 
				<td td align=left >".$plano->getProfessor()->getNome()."</td> 
				<td>".implode("/", array_reverse(explode("-", $plano->getData())))."</td> </tr>";
			$display .= "</table>";				
		}

	}
}

//echo nl2br($display);
echo $display;

?>