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
				if (saida==0) {
					$("#mensagemErro").hide();
					$("#mensagemErro").html("Professor, você não está cadastrado no sistema!");
					$("#mensagemErro").show("slow");
					return false;
				}
				else if (saida==1) {
					$("#mensagemErro").hide();
					$("#mensagemErro").html("Professor, seu cadastro está inativo no sistema!");
					$("#mensagemErro").show("slow");
					return false;
				}
				else if (saida==2) {
					$("#mensagemErro").hide();
					$("#mensagemErro").html("Professor, seu login ou senha estão incorretos!");
					$("#mensagemErro").show("slow");
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
	<div id="row" class="topo">
		<div class="col-md-2">  </div>
		<div class="col-md-8 sublinhado"> <img src="Imagens/microlins.png" height="50px"> </div>	
		<div class="col-md-2"> 	</div>
	</div>
	<div id="row">
		<!-- sobra -->
		<div class="col-md-1">
		</div>
		<!-- sublogo -->
		<div class="col-md-5 aproxima">
			<img src="Imagens/A+.png" class="img-responsive" alt="Responsive image">
		</div>
		<!-- formulário -->
		<div class="col-md-4 desce">
			<p class="texto"> Acesse sua conta </p>
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
			<p align="right"> <a href="minhaNota.php"> Ou clique aqui para consultar sua nota </a> </p>
			<div class="alert alert-danger" role="alert" id="mensagemErro" style="display:none"> </div>			
		</div>
		<!-- sobra -->
		<div class="col-md-2">
		</div>
	</div>
	
	<!-- rodapé -->
	<?php include ("rodape.php") ?>
	
</body>
</html>