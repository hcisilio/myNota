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
				// enquanto a função esta sendo processada, você
				// pode exibir na tela uma
				// msg de carregando							
			},
			success: function(result) {
				// pego o id da div que envolve o select com
				// name="id_modelo" e a substituiu
				// com o texto enviado pelo php, que é um novo
				//select com dados da marca x
				//$('#ajax_alunos').html(txt);
				if (!result) {
					$("#login").show("slow");
					return false;
				}
				else {
					window.location.href = result;
				}				
			},
			error: function(txt) {
				
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
			<form action="../Controladores/controlador.php" method="post" onsubmit="JavaScript:return logar()">
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
			  	<input type="button" class="btn btn-default" id="btnSubmit" value="Login" onclick="logar()">
			</form>	
			<div class="alert alert-danger" role="alert" id="login" style="display:none">
				Usuário ou senha inválidos
			</div>			
		</div>
		<!-- sobra -->
		<div class="col-md-2">
				<input type="button" value="teste" onclick="login()">
		</div>
	</div>
	<div id="rodape">
		<div id="miolo">
			<p>I CS - Cisilio's Sistemas &copy;2014 - Todos os direitos reservados I <a href="#"></a> </p>			
		</div>
	</div>	
</body>
</html>