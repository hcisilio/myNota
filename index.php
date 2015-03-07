<?php
session_start("mynota");

//Checa se o cliente já está logado
if ($_SESSION["logado"] == 'true'){	
	header("Location: ../myNota/GUIs/home.php");
} 
else {header("Location: GUIs/login.php");}
?>