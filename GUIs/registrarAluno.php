<?php 
	include_once ("../Controladores/controladorPermissao.php");
	$persistir = new ControladorPermissao();
	$persistir->autorizarAcesso( end(explode("/", $_SERVER['PHP_SELF'])) );
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Cadastrar Aluno</title>
	<link rel="stylesheet" type="text/css" href="CSS/estilos.css">
	<link href="CSS/bootstrap.css" rel="stylesheet">	
	<script src="../Ajax/jQuery.js"></script>
	<script type="text/javascript" src="../Ajax/validacoes.js"></script>
	<script src="js/bootstrap.min.js"></script>	
	<script>
		function matricularAluno() {
			if ( nuloOUvazio("#aluno") ) {
				$.ajax({			        
					type: "POST",
					url: "../Controladores/controlador.php",
					data: { 
						id: $("#id").val(),
						nome: $("#nome").val(),
						mail: $("#mail").val(),
						classe: "Aluno",
						metodo: "inserir"
					},
					success: function(resultado) {
						$('#principal').hide();				
						$('#principal').html(resultado);
						$('#principal').show("slow");	
					},
					error: function(resultado) {				
						
					}
				});
			}
		}
	</script>
</head>

<body>

	<!-- NavBar -->
	<nav class="navbar navbar-default" role="navigation" id="barra">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="../GUIs/home.php"> <img alt="Brand" src="Imagens/sublogo_branco.png"> </a>		
			</div>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav navbar-right">	
					<li> <a href="JavaScript:matricularAluno()"> <img src="Imagens/save.png"> </a></li>				         
				</ul>
			</div>
		</div>
	</nav>
	
	<div id="row">
		<!-- menu lateral -->
		<div class="col-md-3 menuLateral">
			<?php $persistir->criarMenu() ?>
		</div>
		<!-- espaçamento -->
		<div class="col-md-1">
		</div>
		<!-- conteúdo -->
		<div id="principal" class="abaixo col-md-7">			
			<form id="aluno" action="../Controladores/controlador.php" method="post">
				<div class="input-group abaixo">
			 		<span class="input-group-addon edits"><span class="glyphicon glyphicon-barcode"></span></span>			 		
					<input class="form-control edits nuloOUvazio" name="id" id="id" type="text" placeholder="Matrícula" maxlength="10">
			  	</div>
			  	<div class="input-group abaixo">
			 		<span class="input-group-addon edits"><span class="glyphicon glyphicon-pencil"></span></span>			 		
					<input class="form-control edits nuloOUvazio" name="nome" id="nome" type="text" placeholder="Nome Completo">
			  	</div>
			  	<div class="input-group abaixo">
			 		<span class="input-group-addon edits">@</span>			 		
					<input class="form-control edits" name="mail" id="mail" type="text" placeholder="E-mail">
			  	</div>			  	
			</form>			
		</div>
		<!-- sobra -->
		<div class="col-md-1">
		</div>
		
	</div>
	
	<!-- rodapé -->
	<?php include ("rodape.php") ?>

</body>