<?php
include_once ("../pdf/mpdf.php");

$arquivo = 'report.pdf';
$mpdf = new mPDF();
$saida = "
	<link rel='stylesheet' type='text/css' href='CSS/estilos.css'>
	<div align='center'> <img src='../GUIs/Imagens/microlins.png' height='150px'> </div>
	<br />
".$_REQUEST["saida"];
$mpdf->WriteHTML($saida);
$mpdf->Output($arquivo, 'I');
?>