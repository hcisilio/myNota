<?php
$classe = $_REQUEST["classe"];
$metodo = $_REQUEST["metodo"];
include_once ("../Controladores/controlador$classe.php");
$var = "controlador$classe";
//echo "$var <br> $classe <br> $metodo <br>";
$persistir = new $var();
$persistir->$metodo();
?>