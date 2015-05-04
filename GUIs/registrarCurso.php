<?php 
	include_once ("../Controladores/controladorPermissao.php");
	$persistir = new ControladorPermissao();
	$persistir->autorizarAcesso( end(explode("/", $_SERVER['PHP_SELF'])) );
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Cadastrar Novo Curso</title>
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
	<link href="css/bootstrap.css" rel="stylesheet">	
	<script src="js/jQuery.js"></script>
	<script type="text/javascript" src="js/validacoes.js"></script>
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
		function incluirCurso(){

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
		<div class="col-md-2">
		</div>
		<!-- conteúdo -->
		<div id="principal" class="abaixo col-md-5">			
			<form id="curso" action="../Controladores/controlador.php" method="post">
				<div class="input-group abaixo">
			 		<span class="input-group-addon edits"><span class="glyphicon glyphicon-pencil"></span></span>
					<input class="form-control edits nuloOUvazio" name="descricao" id="descricao" type="text" placeholder="Descrição do curso">	
			  	</div>
			</form>
			<p>Módulos:</p>
		  	<div class='input-group abaixo'>
		  		<span class="input-group-addon edits"><span class="glyphicon glyphicon-pencil"></span></span>
				<input class="form-control edits nuloOUvazio" name="modulo" id="modulo" type="text" placeholder="Módulo">
		  		<span class="input-group-btn"><input type='button' class='btn btn-primary' value='Incluir'></span>
		  	</div>
		</div>
		<!-- sobra -->
		<div class="col-md-2">
		</div>
		
	</div>
	
	<!-- rodapé -->
	<?php include ("rodape.php") ?>

</body>