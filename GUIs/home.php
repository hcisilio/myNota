<?php 
	include ("../permissao.php");
?>
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
	<!-- NavBar -->
	<nav class="navbar navbar-default" role="navigation" id="barra">
		<div class="container-fluid">
			<div class="navbar-header">
				<!-- colocar alguma imagem mynota -->
			</div>
			<div class="collapse navbar-collapse">
			<form action="../Controladores/controlador.php" method="post" name="logout" id="logout">
				<input type="hidden" name="classe" value="Professor">
				<input type="hidden" name="metodo" value="logout">
				<ul class="nav navbar-nav navbar-right">	
					<li> <a href="trocaSenha.php"><img src="Imagens/icone-chaves.png"></a> </li>
					<li> <a href="javaScript:doPost('logout');"> <img src="Imagens/logout.png" > </a></li>					         
				</ul>
			</form>
			</div>
		</div>
	</nav>
	
	<div id="row">
		<!-- menu lateral -->
		<div class="col-md-3 menuLateral">
			<div class="list-group">				
			  	<?php include("opcoes".$_SESSION["acesso"].".php"); ?>
			</div>
		</div>
		<!-- conteúdo -->
		<div class="col-md-9">
			<h1><?php echo "Bem vindo $acesso ".$_SESSION["nome"]."!" ?></h1>
		</div>	
	</div>
	
	<!-- rodapé -->
	<?php include ("rodape.php") ?>

</body>
</html>