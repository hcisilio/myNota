<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>CS MyNota - Login</title>
	<link rel="stylesheet" type="text/css" href="CSS/estilos.css">
	<link href="CSS/bootstrap.css" rel="stylesheet">	
	<script src="../Ajax/jQuery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script>
	function logar() {		
		$.ajax({	    
			type: "POST",
			url: "../Controladores/controlador.php",
			data: { 
				classe: "Professor",
				metodo: "login",
				id: $("#id").val(),
				senha: $("#senha").val()
			},		
			beforeSend: function() {							
			},
			success: function(saida) {				
				if (saida==false) {
					$("#login").hide();
					$("#login").show("slow");
					return false;
				}
				else {
					window.location.href = saida;
				}				
			},
			error: function() {			
			}
	    });	    
	}
	function chamaLogar(){
		$("#senha").keypress(function (e) {
			if (e.which == 13) {
				logar();
			}
		})
	}	
	</script>
</head>
<body>
	<!-- mainLogo -->
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
		<!-- sublogo -->
		<div class="col-md-6">
			<img src="Imagens/sublogo.png" class="img-responsive" alt="Responsive image">
		</div>
		<!-- formulário -->
		<div class="col-md-4 desce">
			<form action="../Controladores/controlador.php" method="post">
				<div class="input-group abaixo">
			 		<span class="input-group-addon edits"><span class="glyphicon glyphicon-user"></span></span>			 		
					<input class="form-control edits" name="id" id="id" type="text" placeholder="Login">
			  	</div>
			  	<div class="input-group abaixo">
			 		<span class="input-group-addon edits"><span class="glyphicon"><img src="Imagens/glyphicons_044_keys.png" style="width: 14px; height: 14px;"></span></span>			 		
					<input class="form-control edits" name="senha" id="senha" type="password" placeholder="Senha" onKeyPress="chamaLogar()">
			  	</div>
			  	<div class="naDireita">	
			  		<input type="button" class="btn btn-primary" id="btnSubmit" value="Login" onclick="logar()">
			  	</div>
			</form>	
			<div class="alert alert-danger" role="alert" id="login" style="display:none">
			<p align="right"> <a href="minhaNota.php"> Ou clique aqui para consultar sua nota </a> </p>	
				Usuário ou senha inválidos
			</div>			
		</div>
		<!-- sobra -->
		<div class="col-md-2">
		</div>
	</div>
	
	<!-- rodapé -->
	<?php include ("rodape.php") ?>
	
</body>
</html>