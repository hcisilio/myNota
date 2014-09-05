<?php
	$con=mysql_connect("127.0.0.1","root","root")
		or die ("Erro de conexão ");
	$bd=mysql_select_db("MyNota") 
		or die("Erro na seleção do bd");
?>