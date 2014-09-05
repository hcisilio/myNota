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
	function teste(){
		window.location.href = "homeDiretor.php";
	}	
	</script>
</head>
<body>
	<div id="row">
		<div class="col-md-12 topo">
		
		</div>
	</div>
	<div id="row">
		<!-- logotipo -->
		<div class="col-md-5">
		
		</div>
		<!-- formulário -->
		<div class="col-md-5">
			<form action="../Controladores/controlador.php" method="post">
				<input type="hidden" name="classe" id="classe" value="Professor">
				<input type="hidden" name="metodo" id="metodo" value="login"> 
				<div class="input-group abaixo">
			 		<span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>			 		
					<input class="form-control" name="id" id="id" type="text" placeholder="Login">
			  	</div>
			  	<div class="input-group abaixo">
			 		<span class="input-group-addon"><span class="glyphicon"><img src="Imagens/glyphicons_044_keys.png" style="width: 14px; height: 14px;"></span></span>			 		
					<input class="form-control" name="senha" id="senha" type="password" placeholder="Senha">
			  	</div>
			  	<div class="naDireita">	
			  		<input type="button" class="btn btn-primary" id="btnSubmit" value="Login" onclick="logar()">
			  	</div>
			</form>	
			<div class="alert alert-danger" role="alert" id="login" style="display:none">
				Usuário ou senha inválidos
			</div>			
		</div>
		<!-- sobra -->
		<div class="col-md-2">
		</div>
	</div>
	<div id="rodape">
		<div id="miolo">
			<p>I CS - Cisilio's Sistemas &copy;2014 - Todos os direitos reservados I <a href="#"></a> </p>			
		</div>
	</div>	
</body>
</html>