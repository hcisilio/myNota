<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   <title>Menu Principal</title>
   <link rel="stylesheet" type="text/css" href="CSS/mynota.css">	
<script>
   function doPost(formName) {
       var theForm = document.getElementById(formName);
           theForm.submit();
   }
   </script>
</head>
<body>	
	
	<div id="principal">
	
		<div id="topo">
			Topo da página
		</div>
		
		<div id="barra">
			<form action="../Controladores/controlador.php" method="post" name="logout" id="logout">
				<input type="hidden" name="classe" value="Professor">
				<input type="hidden" name="metodo" value="logout">
				<ul>	
					<li> <a href="trocaSenha.php"><img src="Imagens/icone-chaves.png"></a> </li>
					<li> <a href="javaScript:doPost('logout');"> <img src="Imagens/logout.png" > </a></li>          
				</ul>
			</form>
		</div>
		
		<div id="menu">
			<?php include("mainMenu.php"); ?>
		</div>
		
		<div id="formulario">
			<h1><?php echo "Bem vindo $acesso $nome!" ?></h1>	
		</div>
		
		<div class="clear"> </div>
		
		<div id="rodape">
			<p>I CS - Cisilio's Sistemas &copy;2014 - Todos os direitos reservados I</p>
		</div>	
	
	</div>	

</body>
</html>