<?php
session_start("mynota");
if ($_SESSION["logado"] == 'true'){
	$link = $_SESSION["minhaPermissao"];
	header("Location: ../GUIs/home$acesso.php");
} 
else {header("Location: GUIs/login.php");}
?>