<?php 
	session_start("mynota");
	if ($_SESSION["logado"] <> "true") {
		header("Location: login.php");
	}
	else if ( ($_SESSION["acesso"] == "Gerente") || ($_SESSION["acesso"] == "Administrador") ){
		//acesso permitido	
		$acesso = $_SESSION["acesso"];
	}
	else {
		//acesso negado
	}
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Cadastrar professor</title>
   	<link rel="stylesheet" type="text/css" href="CSS/estilos.css">
	<link href="CSS/bootstrap.css" rel="stylesheet">	
	<script src="../Ajax/jQuery.js"></script>
	<script src="js/bootstrap.min.js"></script>	
	<script>
	   function doPost() {
	       $.ajax({			        
				type: "POST",
				url: "../Controladores/controlador.php",
				data: { 
					id: $("#id").val(),
					nome: $("#nome").val(),
					senha: $("#senha").val(),
					acesso: $("#acesso").val(),
					obs: $("#obs").val(),				
					classe: "Professor",
					metodo: "inserir" 
				},
				
				beforeSend: function() {						
					
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
					<li> <a href="JavaScript:doPost()"> <img src="Imagens/save.png"> </a></li>				         
				</ul>
			</div>
		</div>
	</nav>
	
	<div id="row">
		<!-- menu lateral -->
		<div class="col-md-3 menuLateral">
			<?php include("opcoes$acesso.php"); ?>
		</div>
		<!-- espaçamento -->
		<div class="col-md-1">
		</div>
		<!-- conteúdo -->
		<div id="principal" class="col-md-7">			
			<form id="professor" action="../Controladores/controlador.php" method="post">
				<div class="input-group abaixo">
			 		<span class="input-group-addon edits"><span class="glyphicon glyphicon-user"></span></span>			 		
					<input class="form-control edits" name="id" id="id" type="text" placeholder="Login" maxlength="20">
			  	</div>
				<div class="input-group abaixo">
			 		<span class="input-group-addon edits"><span class="glyphicon glyphicon-pencil"></span></span>			 		
					<input class="form-control edits" name="nome" id="nome" type="text" placeholder="Nome Completo">
			  	</div>
			  	<div class="input-group abaixo">
			 		<span class="input-group-addon edits"><span class="glyphicon"><img src="Imagens/glyphicons_044_keys.png" style="width: 14px; height: 14px;"></span></span>			 		
					<input class="form-control edits" name="senha" id="senha" type="password" placeholder="Senha">
			  	</div>
			  	<div class="input-group abaixo">
			  		<span class="input-group-addon edits"><span class="glyphicon glyphicon-tags"></span></span>		
					<select name="acesso" class="form-control edits">
						<option value="Professor"> Professor </option>
						<option value="Diretor"> Diretor </option>
						<option value="Administrador"> Administrador </option>
					</select>
				</div>
				<div class="input-group abaixo">
					<textarea name="obs" cols="200%" rows="5" class="form-control edits"></textarea>
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