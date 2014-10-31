<?php
include_once ("../pdf/mpdf.php");

$arquivo = 'report.pdf';
$mpdf = new mPDF();
$mpdf->WriteHTML($_REQUEST["saida"]);
$mpdf->Output($arquivo, 'I');
?>