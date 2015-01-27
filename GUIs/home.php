<?php 
	include_once ("../Controladores/controladorPermissao.php");
	$persistir = new ControladorPermissao();
	$persistir->autorizarAcesso( end(explode("/", $_SERVER['PHP_SELF'])) );
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
				<p class="navbar-text"> <?php echo "Bem vindo ".$_SESSION["nome"]."!" ?> </p>		
				<p class="navbar-text"> <?php echo "Perfil de acesso: ".$_SESSION["acesso"] ?> </p>
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
			  	<?php $persistir->criarMenu() ?>
			</div>
		</div>
		<!-- espaçamento -->
		<div class="col-md-1">
		</div>
		<!-- conteúdo -->
		<div class="col-md-7 abaixo">			
			<?php include_once "destaques.php" ?>
		</div>	
		<!-- sobra -->
		<div class="col-md-1">
		</div>
	</div>
	
	<!-- rodapé -->
	<?php include ("rodape.php") ?>

</body>
</html>