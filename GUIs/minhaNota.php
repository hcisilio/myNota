<?php 
	session_start("mynota");
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Consulta de nota individual</title>
	<link rel="stylesheet" type="text/css" href="CSS/estilos.css">
	<link href="CSS/bootstrap.css" rel="stylesheet">	
	<script src="../Ajax/jQuery.js"></script>
	<script type="text/javascript" src="../Ajax/validacoes.js"></script>
	<script src="js/bootstrap.min.js"></script>	
	<script>
		function consultarNotas() {
			$.ajax({			        
				type: "POST",
				url: "constroiNotasAluno.php",
				data: { 
					aluno: $("#aluno").val(),										
				},
				
				beforeSend: function() {
					$("#notas").html("<img src='Imagens/carregando.gif'/>");				
				},
				success: function(txt) {			
					$("#notas").html(txt);	
				},
				error: function(txt) {	
					$("#notas").html("fudeu");			
				}
			});
			
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
				<ul class="nav navbar-nav navbar-right">	
					<li> <a href="home.php"> <img src="Imagens/home.png"> </a></li>				         
				</ul>
			</div>
		</div>
	</nav>
	
	<div id="row">
		<!-- menu lateral -->
		<div class="col-md-3 menuLateral">
			<?php 
				if ($_SESSION["logado"] == "true"){
					$acesso = $_SESSION["acesso"];
					include("opcoes$acesso.php"); 
				}
			?>
		</div>
		<!-- espaçamento -->
		<div class="col-md-1">
		</div>
		<!-- conteúdo -->
		<div class="abaixo col-md-7">			
			<form class="form-inline" action="../Controladores/controlador.php" method="post">
				<div class="input-group abaixo">			 				 	
					<input class="form-control edits" name="aluno" id="aluno" type="text" placeholder="Matrícula" maxlength="10">
					<span class="input-group-btn">
				    	<button class="btn btn-default edits" type="button" OnClick="consultarNotas()">OK</button>
				    </span>
			  	</div>
			</form>	
			<div id="notas"></div>	
		</div>
		<!-- sobra -->
		<div class="col-md-1">
		</div>		
	</div>
	
	<!-- rodapé -->
	<?php include ("rodape.php") ?>

</body>