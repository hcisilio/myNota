<?php 
	session_start("mynota");
	$link = $_SESSION["minhaPermissao"];
	$msg = $_SESSION["msg"];
	$erro = $_SESSION["erro"];
	$acesso = $_SESSION["acesso"];	
	unset ($_SESSION["msg"]);
	unset ($_SESSION["erro"]);
?>
<html>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
<link rel="stylesheet" type="text/css" href="CSS/mynota.css">
<title>Erro</title>
</head>

<body>
	
	<div id="principal">

		<div id="topo">
			Topo da página
		</div>
		
		<div id="barra">
			<ul>
				<li>  </li>           
			</ul>
		</div>
		
		<div id="menu">
			<?php include("mainMenu.php"); ?>
		</div>

		<div id="formulario">
			<?php
				echo "$msg <BR />";
				echo "Erro gerado: $erro <br />";
			?>
		</div>
		<div class="clear">  </div>
		
		<div id="rodape">
		  <p>I CS - Cisilio's Sistemas &copy;2013 - Todos os direitos reservados I <a href="#"></a> </p>
		</div>
	
	</div>	
	
</body>
</html>