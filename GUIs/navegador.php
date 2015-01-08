<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Navegador Inválido</title>
	<link rel="stylesheet" type="text/css" href="CSS/estilos.css">
	<link href="CSS/bootstrap.css" rel="stylesheet">
	<style>
		.navbar-text {
			color: #fff !important;			
		}
	</style>	
	<script src="../Ajax/jQuery.js"></script>
	<script src="js/bootstrap.min.js"></script>	
</head>

<body onLoad="trocaPesquisa('todas')">

	<!-- NavBar -->
	<nav class="navbar navbar-default" role="navigation" id="barra">
		<div class="container-fluid">
			<div class="navbar-header">
				<h1 class="navbar-text navbar-center"> Este sistema está disponível apenas no google Chrome. </h1>
			</div>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav navbar-right">	
					<li> </li>				         
				</ul>
			</div>
		</div>
	</nav>
	
	<div id="row">
		<!-- espaçamento -->
		<div class="col-md-1">
		</div>
		<!-- conteúdo -->
		<div id="principal" class="abaixo col-md-10 proibido">				
			<div class='abaixo' align='center' > <a href="http://www.google.com.br/chrome"> <img src="Imagens/Google_Chrome.png"> </a> </div>
			<div align='center' > Caso não possua o Google Chrome instalado, clique na imagem acima para fazer o download! </a> </div>
		</div>
		<!-- sobra -->
		<div class="col-md-1">
		</div>
		
	</div>
	
	<!-- rodapé -->
	<?php include ("rodape.php") ?>

</body>

</html>