<?php
include_once ("../Controladores/controladorProfessor.php");
include_once ("../Controladores/controladorTurma.php");

$persistir = new controladorProfessor();
$professores = $persistir->listarPorStatus('ativo');
$persistir = new ControladorTurma();
$turma = $persistir->listar($_REQUEST["turma"]);
if ($turma->getId()){
	if ($turma->getProfessor()->getAtivo() == "Inativo"){
		$comboProfessores = "<option value='null' selected> ".$turma->getProfessor()->getId()." (professor inativo) </option>";
	}
	else {
		$comboProfessores = "";
	}
	foreach ($professores as $professor){
		if ( $turma->getProfessor()->getId() == $professor->getId() ) {
			$comboProfessores .= "<option selected value=".$professor->getId()." class='destaque'> ".$professor->getNome()."  </option>";
		}
		else {
			$comboProfessores .= "<option value=".$professor->getId()."> ".$professor->getNome()." </option>";
		}
	}
	$dias = "";
	$diasDeAula = $persistir->diasDeAula($turma);
	$c = array();
	foreach ($diasDeAula as $dia){		
		$indice = $dia->getId();
		$c[$indice] = "checked";
	}
	$ckDias = "
		<input type='checkbox' id='dia[]' name='dia[]' value='0' class='edits' $c[0]> Domingo						
		<input type='checkbox' id='dia[]' name='dia[]' value='1' class='edits' $c[1]> Segunda
		<input type='checkbox' id='dia[]' name='dia[]' value='2' class='edits' $c[2]> Terça
		<input type='checkbox' id='dia[]' name='dia[]' value='3' class='edits' $c[3]> Quarta
		<input type='checkbox' id='dia[]' name='dia[]' value='4' class='edits' $c[4]> Quinta
		<input type='checkbox' id='dia[]' name='dia[]' value='5' class='edits' $c[5]> Sexta
		<input type='checkbox' id='dia[]' name='dia[]' value='6' class='edits' $c[6]> Sábado
	";

	$resultado = "
		<form id='edicaoTurma' action='../Controladores/controlador.php' method='post'>
			<div class='input-group abaixo'>
		 		<span class='input-group-addon edits'><span class='glyphicon glyphicon-barcode'></span></span>			 		
				<input class='form-control edits nuloOUvazio' name='id' id='id' type='text' placeholder='ID da turma' readonly value='".$turma->getId()."'>
		  	</div>
		  	<div class='input-group abaixo'>
		  		<span class='input-group-addon edits'><span class='glyphicon glyphicon-user'></span></span>	
				<select id='professor' name='professor' class='form-control edits nuloOUvazio'>
					$comboProfessores
				</select>  			
			</div>
			<div id='dias' class='input-group abaixo'>
				<span class='input-group-addon'>
					<span class='glyphicon'><img src='icons/glyphicons_231_sun.png'>
						$ckDias
					</span>
				</span>					
			</div>
		</form>
	";
}
else {
	$resultado = "<div class='alert alert-danger'> Turma ".$_REQUEST["turma"]." não existe no sistema! </div>";
}

echo $resultado;

?>