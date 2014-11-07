<?php
include_once ("../pdf/mpdf.php");

class Impressora {
	function impressora($arquivo, $relatorio){
		$mpdf = new mPDF();
		$relatorio = "
			<link rel='stylesheet' type='text/css' href='../GUIs/CSS/estilos.css'>
			<div align='center'> <img src='../GUIs/Imagens/microlins.png' height='150px'> </div>
			<br />
		".$relatorio;
		$mpdf->WriteHTML($relatorio);
		return $mpdf->Output($arquivo, 'D');
	}
}
?>