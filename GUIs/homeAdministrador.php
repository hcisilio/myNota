<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   	<title>Menu Principal</title>
   	<link rel="stylesheet" type="text/css" href="CSS/estilos.css">
	<link href="CSS/bootstrap.css" rel="stylesheet">	
	<script src="../Ajax/jQuery.js"></script>
	<script src="js/bootstrap.min.js"></script>	
	<script>
	   function doPost(formName) {
	       var theForm = document.getElementById(formName);
	           theForm.submit();
	   }
  	</script>
</head>
<body>
	<div id="row">
		<div class="col-md-3 topo">
		</div>
		<div class="col-md-6 topo">
			<img src="Imagens/mainLogo.png" height="150px" width="100%">
		</div>	
		<div class="col-md-3 topo">
		</div>
	</div>
	
	<div id="row">
		<div class="col-md-12" id="barra">
			<form action="../Controladores/controlador.php" method="post" name="logout" id="logout">
				<input type="hidden" name="classe" value="Professor">
				<input type="hidden" name="metodo" value="logout">
				<ul>	
					<li> <a href="trocaSenha.php"><img src="Imagens/icone-chaves.png"></a> </li>
					<li> <a href="javaScript:doPost('logout');"> <img src="Imagens/logout.png" > </a></li>          
				</ul>
			</form>
		</div>
	</div>
	
	<div id="row">
		<!-- menu lateral -->
		<div class="col-md-3 menuLateral">
			<?php include("mainMenu.php"); ?>
		</div>
		<!-- conteúdo -->
		<div class="col-md-9">
			<h1><?php echo "Bem vindo $acesso $nome!" ?></h1>
		</div>	
	</div>
	
	<!-- rodapé -->
	<?php include ("rodape.php") ?>

</body>
</html>